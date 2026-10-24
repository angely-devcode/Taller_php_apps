<?php

require_once '../clases/Estadistica.php';

/* Se inicializan las variables donde se guardaran los resultados */
$promedio = null;
$media = null;
$moda = null;

/* Se comprueba si se ha enviado el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Se obtiene el texto ingresado por el usuario */
    $input = $_POST['numeros'];

    /* Se separan los numeros usando las comas como referencia */
    $arrayEst = explode(',', $input);


    $numeros = [];

    /* Se establece que los datos son validos inicialmente */
    $datosValidos = true;

    /* Se revisa cada valor de la lista por separado */
    foreach ($arrayEst as $val) {

        /* Se eliminan los espacios que hay al principio y al final */
        $val = trim($val);

        /* Se comprueba si el valor esta vacio o no es un numero */
        if ($val == '' || !is_numeric($val)) {

            /* Se indica que se ha encontrado un dato no valido */
            $datosValidos = false;
        } else {

            /* Se convierte el valor en un numero decimal y se guarda */
            $numeros[] = (float)$val;
        }
    }


    if (count($numeros) > 0) {
        $est = new Estadistica();

        /* Se calcula el promedio de los numeros ingresados. */
        $promedio = $est->calcularPromedio($numeros);

        /* Se calcula la mediana de los numeros ingresados. */
        $media = $est->calcularMedia($numeros);

        /* Se calcula la moda de los numeros ingresados. */
        $moda = $est->calcularModa($numeros);
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Estadística Básica</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/estadistica.css">
</head>

<body>
    <div class="card">
        <h1>Promedio, Medina y Moda</h1>
        <form method="POST">
            <p>Ingrese números separados por comas (ej: 4, 8, 15, 16, 23, 42):</p>
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