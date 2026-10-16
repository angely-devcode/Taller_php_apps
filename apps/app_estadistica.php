<?php
require_once '../clases/Estadistica.php';
$promedio = null;
$media = null;
$moda = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $input = $_POST['numeros'];

    // Convertir string separado por comas a un array de números
    $arrayEst = explode(',', $input);

    $numeros = [];
    $datosValidos = true;

    foreach ($arrayEst as $val) {
        $val = trim($val);
        if ($val == '' || !is_numeric($val)) {
        $datosValidos = false;
        } else {
        $numeros[] = (float)$val;
    }
    }

    if (count($numeros) > 0) {
        $est = new Estadistica();
        $promedio = $est->calcularPromedio($numeros);
        $media = $est->calcularMedia($numeros);
        $moda = $est->calcularModa($numeros);
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Estadística Básica</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="card">
        <h2>Promedio, Media y Moda</h2>
        <form method="POST">
            <label>Ingrese números separados por comas (ej: 4, 8, 15, 16, 23, 42):</label>
            <input type="text" name="numeros" required>
            <button type="submit">Calcular</button>
        </form>

        <?php if ($promedio !== null): ?>
            <div class="resultado">
                <p><strong>Números ingresados:</strong> <?php echo $input; ?></p>
                <p><strong>Promedio:</strong> <?php echo round($promedio, 2); ?></p>
                <p><strong>Mediana:</strong> <?php echo $media; ?></p>
                <p><strong>Moda:</strong> <?php echo $moda; ?></p>
            </div>
        <?php endif; ?>
        <br><a href="../index.php">Volver al menú</a>
    </div>
</body>
</html>