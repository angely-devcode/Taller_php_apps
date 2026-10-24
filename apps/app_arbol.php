<?php
require_once '../clases/Arbol.php';

/* Se inicializan las variables para guardar los errores y el resultado */
$mensajeError = '';
$resultadoHTML = '';
$metodoUsado = null;

/* Se comprueba si el formulario ha sido enviado */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Se crea una función para convertir el texto ingresado en un arreglo */
    function convertirAArreglo($cadena)
    {
        /* Se eliminan los espacios al inicio y al final del texto */
        $cadena = trim($cadena);

        /* Se devuelve un arreglo vacío si no se ha ingresado texto */
        if (empty($cadena)) {
            return [];
        }

        /* Se separan los elementos cuando hay comas o espacios */
        $elementos = preg_split('/[\s,]+/', $cadena);

        /* Se organizan los elementos y se eliminan los valores vacíos */
        return array_values(array_filter($elementos));
    }

    /* Se convierten los recorridos ingresados en arreglos */
    $preorden = convertirAArreglo($_POST['preorden'] ?? '');
    $inorden = convertirAArreglo($_POST['inorden'] ?? '');
    $postorden = convertirAArreglo($_POST['postorden'] ?? '');

    /* Se cuenta cuántos recorridos contienen datoos */
    $ingresados = 0;

    if (!empty($preorden)) $ingresados++;
    if (!empty($inorden)) $ingresados++;
    if (!empty($postorden)) $ingresados++;

    /* Se verifica que se hayan ingresado al menos dos recorridos */
    if ($ingresados < 2) {
        $mensajeError = "Debes ingresar al menos dos recorridos para construir el árbol.";
    } else {
        /* Se crea el árbol y se prepara el texto de los recorridos utilizados */
        $arbol = new Arbol();
        $detallesArreglos = "";

        /* Si existen preorden e inorden, se utilizan para construir el árbol */
        if (!empty($preorden) && !empty($inorden)) {
            $arbol->raiz = $arbol->construirPreIn($preorden, $inorden);
            $metodoUsado = "Preorden e Inorden";

            /* Se agregan los recorridos utilizados al resumen */
            $detallesArreglos .= "<li><strong>Preorden:</strong> " . implode(", ", $preorden) . "</li>";
            $detallesArreglos .= "<li><strong>Inorden:</strong> " . implode(", ", $inorden) . "</li>";
        }

        /* Si no se cumple la condición anterior, se revisa si hay inorden y postorden */ elseif (!empty($inorden) && !empty($postorden)) {
            $arbol->raiz = $arbol->construirInPost($inorden, $postorden);
            $metodoUsado = "Inorden y Postorden";

            /* Se agregan los recorridos utilizados al resumen */
            $detallesArreglos .= "<li><strong>Inorden:</strong> " . implode(", ", $inorden) . "</li>";
            $detallesArreglos .= "<li><strong>Postorden:</strong> " . implode(", ", $postorden) . "</li>";
        }

        /* Si no hay inorden, se utilizan preorden y postorden */ elseif (!empty($preorden) && !empty($postorden)) {
            $arbol->raiz = $arbol->construirPrePost($preorden, $postorden);
            $metodoUsado = "Preorden y Postorden";

            /* Se agregan los recorridos utilizados al resumen */
            $detallesArreglos .= "<li><strong>Preorden:</strong> " . implode(", ", $preorden) . "</li>";
            $detallesArreglos .= "<li><strong>Postorden:</strong> " . implode(", ", $postorden) . "</li>";
        }

        /* Se comprueba si se ha creado una raíz para el árbol */
        if ($arbol->raiz !== null) {

            /* Se prepara el mensaje con el método de construcción utilizado */
            $resultadoHTML = "<p>Árbol construido exitosamente usando <strong>$metodoUsado</strong>:</p>";

            /* Se agregan los recorridos y el título de la estructura */
            $resultadoHTML .= "<ul>" . $detallesArreglos . "</ul>";
            $resultadoHTML .= "<h3>Estructura del Árbol:</h3>";

            /* Se obtiene la representacion HTML del árbol */
            $resultadoHTML .= $arbol->imprimirArbolHTML();
        } else {
            /* Se muestra un mensaje si no se pudo construir el árbol */
            $mensajeError = "No se pudo construir el árbol. Verifica que los recorridos sean válidos y consistentes.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Árbol Binario</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/arbol.css">
</head>

<body>
    <div class="card">
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
            <div class="arbol-visual">
                <div class="arbol-resumen">
                    <?php echo $resultadoHTML; ?>
                </div>
            </div>
        <?php endif; ?>

        <br><a href="../index.php">Volver al menú principal</a>
    </div>
</body>

</html>