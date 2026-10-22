<?php
require_once '../clases/Calculadora.php';

$calculadora = new Calculadora();
$resultado = null;
$error = null;

// Procesar cuando el usuario presiona "Calcular"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'calcular') {
    $num1 = isset($_POST['num1']) && $_POST['num1'] !== '' ? (float)$_POST['num1'] : null;
    $num2 = isset($_POST['num2']) && $_POST['num2'] !== '' ? (float)$_POST['num2'] : null;
    $operacion = $_POST['operacion'] ?? '';

    if ($num1 === null || $num2 === null) {
        $error = "Por favor, ingresa ambos números.";
    } else {
        $res = $calculadora->calcular($num1, $num2, $operacion);
        
        if (is_numeric($res)) {
            $resultado = $res;
        } else {
            $error = $res; // Si devuelve un mensaje de error (ej. división por cero)
        }
    }
}

// Procesar cuando el usuario presiona "Borrar Historial"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'borrar') {
    $calculadora->borrarHistorial();
}

$historial = $calculadora->getHistorial();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Calculadora con POO</title>
</head>
<body>

    <h1>Calculadora PHP</h1>

    <!-- Formulario Principal -->
    <form action="app_calculadora.php" method="POST">
        <input type="hidden" name="accion" value="calcular">

        <div>
            <label for="num1">Primer Número:</label><br>
            <input type="number" step="any" id="num1" name="num1" placeholder="Ejemplo: 12.5" required>
        </div>
        <br>
        <div>
            <label for="operacion">Operación:</label><br>
            <select id="operacion" name="operacion">
                <option value="suma">Suma (+)</option>
                <option value="resta">Resta (-)</option>
                <option value="multiplicacion">Multiplicación (×)</option>
                <option value="division">División (÷)</option>
                <option value="porcentaje">Porcentaje (%)</option>
            </select>
        </div>
        <br>
        <div>
            <label for="num2">Segundo Número:</label><br>
            <input type="number" step="any" id="num2" name="num2" placeholder="Ejemplo: 5" required>
        </div>
        <br>
        <button type="submit">Calcular</button>
    </form>

    <!-- Mostrar Resultado o Errores -->
    <?php if ($resultado !== null): ?>
        <div>
            <h2>Resultado: <?php echo htmlspecialchars($resultado); ?></h2>
        </div>
    <?php endif; ?>

    <?php if ($error !== null): ?>
        <div>
            <p><strong>Error:</strong> <?php echo htmlspecialchars($error); ?></p>
        </div>
    <?php endif; ?>

    <hr>

    <!-- Sección de Historial -->
    <h2>Historial de Operaciones</h2>

    <?php if (!empty($historial)): ?>
        <ul>
            <?php foreach ($historial as $operacionGuardada): ?>
                <li><?php echo htmlspecialchars($operacionGuardada); ?></li>
            <?php endforeach; ?>
        </ul>

        <!-- Formulario para borrar el historial -->
        <form action="app_calculadora.php" method="POST">
            <input type="hidden" name="accion" value="borrar">
            <button type="submit">Borrar Historial</button>
        </form>
    <?php else: ?>
        <p>No hay operaciones en el historial.</p>
    <?php endif; ?>

    <br><a href="../index.php">Volver al menú principal</a>

</body>
</html>