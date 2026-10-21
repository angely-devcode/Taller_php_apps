<?php
require_once '../clases/Arbol.php';

$mensajeError = '';
$resultadoHTML = '';

// Procesar el formulario al enviar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Función para convertir la cadena ingresada ("A, B, C" o "A B C") en un arreglo
    function convertirAArreglo($cadena) {
        $cadena = trim($cadena);
        if (empty($cadena)) {
            return [];
        }
        // Separar por comas o por espacios
        $elementos = preg_split('/[\s,]+/', $cadena);
        return array_values(array_filter($elementos));
    }

    $preorden = convertirAArreglo($_POST['preorden'] ?? '');
    $inorden = convertirAArreglo($_POST['inorden'] ?? '');
    $postorden = convertirAArreglo($_POST['postorden'] ?? '');

    // Contar cuántos recorridos ingresó el usuario
    $ingresados = 0;
    if (!empty($preorden)) $ingresados++;
    if (!empty($inorden)) $ingresados++;
    if (!empty($postorden)) $ingresados++;

    if ($ingresados < 2) {
        $mensajeError = "Debes ingresar al menos dos recorridos para construir el árbol.";
    } else {
        $arbol = new Arbol();

        // Si ingresa los tres recorridos o (Preorden + Inorden) -> Usar Preorden + Inorden
        if (!empty($preorden) && !empty($inorden)) {
            $arbol->raiz = $arbol->construirPreIn($preorden, $inorden);
            $metodoUsado = "Preorden e Inorden";
        } 
        // Inorden + Postorden
        elseif (!empty($inorden) && !empty($postorden)) {
            $arbol->raiz = $arbol->construirInPost($inorden, $postorden);
            $metodoUsado = "Inorden y Postorden";
        } 
        // Preorden + Postorden
        elseif (!empty($preorden) && !empty($postorden)) {
            $arbol->raiz = $arbol->construirPrePost($preorden, $postorden);
            $metodoUsado = "Preorden y Postorden";
        }

        if ($arbol->raiz !== null) {
            $resultadoHTML = "<p>Árbol construido exitosamente usando <strong>$metodoUsado</strong>:</p>";
            $resultadoHTML .= $arbol->imprimirArbolHTML();
        } else {
            $mensajeError = "No se pudo construir el árbol. Verifica que los recorridos sean válidos y consistentes.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Construcción de Árbol Binario</title>
</head>
<body>

    <h1>Construcción de Árbol Binario</h1>
    <p>Ingresa al menos dos recorridos separados por comas o espacios (Ejemplo: A, B, C, D o A B C D).</p>

    <?php if (!empty($mensajeError)): ?>
        <div>
            <p><strong>Error:</strong> <?php echo htmlspecialchars($mensajeError); ?></p>
        </div>
    <?php endif; ?>

    <form action="app_arbol.php" method="POST">
        <div>
            <label for="preorden">Preorden:</label><br>
            <input type="text" id="preorden" placeholder="Ej: A, B, C, D" name="preorden">
        </div>
        <br>
        <div>
            <label for="inorden">Inorden:</label><br>
            <input type="text" id="inorden" name="inorden" placeholder="Ej: D, B, E, A">
        </div>
        <br>
        <div>
            <label for="postorden">Postorden:</label><br>
            <input type="text" id="postorden" name="postorden" placeholder="Ej: H, I, L, C">
        </div>
        <br>
        <button type="submit">Construir Árbol</button>
    </form>

    <?php if (!empty($resultadoHTML)): ?>
        <hr>
        <h2>Resultado del Árbol</h2>
        <div>
            <?php echo $resultadoHTML; ?>
        </div>
    <?php endif; ?>

</body>
</html>




