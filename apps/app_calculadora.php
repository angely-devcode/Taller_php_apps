<?php
require_once '../clases/Calculadora.php';
$calculadora = new Calculadora();

/* Se preparan las variables para guardar el resultado y los posibles errores */
$resultado = null;
$error = null;

/* Se comprueba si se ha enviado el formulario para calcular */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'calcular') {

    /* Se obtienen los numros ingresados y se convierten a decimales */
    $num1 = isset($_POST['num1']) && $_POST['num1'] !== '' ? (float)$_POST['num1'] : null;
    $num2 = isset($_POST['num2']) && $_POST['num2'] !== '' ? (float)$_POST['num2'] : null;

    /* Se obtiene el tipo de operacion seleccionada */
    $operacion = $_POST['operacion'] ?? '';

    /* Se revisa si alguno de los números está vacío */
    if ($num1 === null || $num2 === null) {
        $error = "Por favor, ingresa ambos números.";
    } else {

        /* Se envían los valores a la clase para realizar el cálculo */
        $res = $calculadora->calcular($num1, $num2, $operacion);

        /* Se comprueba si la respuesta es un número */
        if (is_numeric($res)) {
            $resultado = $res;
        } else {
            /* Se guarda el mensaje recibido cuando ocurre un error */
            $error = $res;
        }
    }
}

/* Se comprueba si se ha enviado la solicitud para borrar el historial */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accion']) && $_POST['accion'] === 'borrar') {
    $calculadora->borrarHistorial();
}

/* Se obtiene la lista de operacoines guardadas */
$historial = $calculadora->getHistorial();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/calculadora.css">
</head>

<body>
    <div class="card">
        <h1>Calculadora</h1>

        <form action="app_calculadora.php" method="POST">
            <input type="hidden" name="accion" value="calcular">

            <div>
                <label for="num1">Primer Número:</label>
                <input type="number" step="any" id="num1"
                    name="num1" placeholder="Ejemplo: 12.5" required>
            </div>

            <div>
                <label for="num2">Segundo Número:</label>
                <input type="number" step="any" id="num2"
                    name="num2" placeholder="Ejemplo: 5" required>
            </div>

            <div class="operaciones">
                <label>Selecciona una operación:</label>

                <div class="botones-operacion">
                    <button type="submit" name="operacion"
                        value="suma">+</button>

                    <button type="submit" name="operacion"
                        value="resta">−</button>

                    <button type="submit" name="operacion"
                        value="multiplicacion">x</button>

                    <button type="submit" name="operacion"
                        value="division">÷</button>

                    <button type="submit" name="operacion"
                        value="porcentaje">%</button>
                </div>
            </div>
        </form>

        <?php if ($resultado !== null): ?>
            <div>
                <h2>Resultado: <?php echo htmlspecialchars((string)$resultado); ?></h2>
            </div>
        <?php endif; ?>

        <?php if ($error !== null): ?>
            <div>
                <p><strong>Error:</strong> <?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>

        <hr>

        <h2>Historial de Operaciones</h2>

        <?php if (!empty($historial)): ?>
            <ul>
                <?php foreach ($historial as $operacionGuardada): ?>
                    <li><?php echo htmlspecialchars($operacionGuardada); ?></li>
                <?php endforeach; ?>
            </ul>

            <form action="app_calculadora.php" method="POST">
                <input type="hidden" name="accion" value="borrar">
                <button type="submit">Borrar Historial</button>
            </form>
        <?php else: ?>
            <p>No hay operaciones en el historial.</p>
        <?php endif; ?>

        <br><a href="../index.php">Volver al menú principal</a>
    </div>
</body>

</html>