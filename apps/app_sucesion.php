<?php

require_once '../clases/Sucesion.php';

/*
    Crea una variable vacia para guardar el resultado
    que se mostrará despues de realizar el calculo.
*/
$resultado = '';

/*
    Comprobamos si el usuario ha enviado el formulario
    presionando el boton Calcular.
*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /*
        Toma el numero que el usuario escribio
        en el campo llamado "numero".
    */
    $num = $_POST['numero'];

    /*
        Convierte el numero recibido a un numero entero.
    */
    $num = (int)$num;

    /*
        Recupera la operacion que el usuario selecciono:
        Fibonacci o factorial.
    */
    $operacion = $_POST['operacion'];

    $obj = new Sucesion();

    /*
        Si el usuario selecciono Fibonacci,
        llama a la funcion calcularFibonacci
        y le envia el numero que escribio.
    */
    if ($operacion === 'fibonacci') {

        $res = $obj->calcularFibonacci($num);

        /*
            Une los numeros de la lista en un solo texto.
            Coloca una coma y un espacio entre cada numero con implode.
        */
        $textoSerie = implode(', ', $res);

        /*
            Guarda el texto que mostraremos en pantalla,
            incluyendo el nombre de la sucesion.
        */
        $resultado = "Serie Fibonacci: " . $textoSerie;

        /*
        Si el usuario selecciono factorial,
        llama a la funcion calcularFactorial
        y le envia el numero que escribio.
    */
    } elseif ($operacion === 'factorial') {

        $res = $obj->calcularFactorial($num);

        $resultado = "Factorial: " . $res;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">

    <title>Fibonacci / Factorial</title>

    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/sucesion.css">
</head>

<body>

    <div class="card">

        <h1>Sucesión Fibonacci o Factorial de un número</h1>

        <p>
            Escribe un número y conoce su sucesión Fibonacci
            o su factorial:
        </p>

        <form method="POST">

            <label>Número:</label>

            <input type="number" name="numero" min="0" required>

            <label>Operación:</label>

            <select name="operacion">
                <option value="fibonacci">
                    Sucesión de Fibonacci
                </option>

                <option value="factorial">
                    Factorial de un número
                </option>
            </select>

            <button type="submit">Calcular</button>

        </form>

        <?php if ($resultado != ''): ?>

            <div class="resultado">
                <?php echo $resultado; ?>
            </div>

        <?php endif; ?>

        <br>

        <a href="../index.php">Volver al menú principal</a>

    </div>

</body>

</html>