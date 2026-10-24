<?php

require_once '../clases/Conjuntos.php';

/* Se inicializan las variables donde se guardan los resultados */
$resultadoUnion = null;
$resultadoInterseccion = null;
$resultadoDiferenciaAB = null;
$resultadoDiferenciaBA = null;

/* Se comprueba si se ha enviado el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Se obtienen los valores escritos para cada conjunto */
    $textoConjuntoA = $_POST['conjuntoA'];
    $textoConjuntoB = $_POST['conjuntoB'];

    /* Se separan los elementos de cada conjunto usando las comas */
    $elementosA = explode(',', $textoConjuntoA);
    $elementosB = explode(',', $textoConjuntoB);

    /* Se crean las listas vacias donde se guardan los numeros */
    $conjuntoA = [];
    $conjuntoB = [];

    /*
        Se recorre la lista de elementos del conjunto A
        para limpiar los espacios y convertir cada valor en un numro entero
    */
    foreach ($elementosA as $elemento) {

        /* Se eliminan los espacios al principio y al final del elemento */
        $elemento = trim($elemento);

        /* Se convierte el elemento en un numero entero y se agrega al conjunto A */
        $conjuntoA[] = (int)$elemento;
    }

    /*
        Se recorre la lista de elementos del conjunto B
        para limpiar los espacios y convertir cada valor en un numero entero
    */
    foreach ($elementosB as $elemento) {

        /* Se eliminan los espacios al principio y al final del elemento */
        $elemento = trim($elemento);

        /* Se convierte el elemento en un numero entero y se agrega al conjunto B */
        $conjuntoB[] = (int)$elemento;
    }

    $operaciones = new Conjuntos();

    /* Se obtiene la union de los dos conjuntos */
    $resultadoUnion = $operaciones->union($conjuntoA, $conjuntoB);

    /* Se obtienen los elementos que aparecen en ambos conjuntos */
    $resultadoInterseccion = $operaciones->interseccion($conjuntoA, $conjuntoB);

    /* Se obtienen los elementos que estan en A pero no en B */
    $resultadoDiferenciaAB = $operaciones->diferencia($conjuntoA, $conjuntoB);

    /* Se obtienen los elementos que estan en B pero no en A */
    $resultadoDiferenciaBA = $operaciones->diferencia($conjuntoB, $conjuntoA);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Conjuntos</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/conjuntos.css">
</head>

<body>
    <div class="card">
        <h1>Operaciones con conjuntos</h1>

        <form method="POST">
            <label>Conjunto A (separado por comas):</label>
            <input type="text" name="conjuntoA" required placeholder="1, 2, 3, 4">

            <label>Conjunto B (separado por comas):</label>
            <input type="text" name="conjuntoB" required placeholder="3, 4, 5, 6">

            <button type="submit">Calcular</button>
        </form>

        <?php
        /* Se comprueba si se han calculado los resultados */
        if ($resultadoUnion !== null) {
        ?>
            <div class="resultado">
                <p><strong>Conjunto A:</strong> {<?php echo $textoConjuntoA; ?>}</p>
                <p><strong>Conjunto B:</strong> {<?php echo $textoConjuntoB; ?>}</p>
                <p><strong>Unión (A ∪ B):</strong> {<?php echo implode(', ', $resultadoUnion); ?>}</p>
                <p><strong>Intersección (A ∩ B):</strong> {<?php echo implode(', ', $resultadoInterseccion); ?>}</p>
                <p><strong>Diferencia (A - B):</strong> {<?php echo implode(', ', $resultadoDiferenciaAB); ?>}</p>
                <p><strong>Diferencia (B - A):</strong> {<?php echo implode(', ', $resultadoDiferenciaBA); ?>}</p>
            </div>
        <?php
        }
        ?>

        <br>
        <a href="../index.php">Volver al menú principal</a>
    </div>
</body>

</html>