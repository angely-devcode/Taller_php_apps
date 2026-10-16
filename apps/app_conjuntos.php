<?php
require_once '../clases/Conjuntos.php';
$resultadoUnion = null;
$resultadoInterseccion = null;
$resultadoDiferenciaAB = null;
$resultadoDiferenciaBA = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $textoConjuntoA = $_POST['conjuntoA'];
    $textoConjuntoB = $_POST['conjuntoB'];

    $elementosA = explode(',', $textoConjuntoA);
    $elementosB = explode(',', $textoConjuntoB);

    $conjuntoA = [];
    $conjuntoB = [];

    foreach ($elementosA as $elemento) {
        $elemento = trim($elemento);
        $conjuntoA[] = (int)$elemento;
    }

    foreach ($elementosB as $elemento) {
        $elemento = trim($elemento);
        $conjuntoB[] = (int)$elemento;
    }

    $operaciones = new Conjuntos();

    $resultadoUnion = $operaciones->union($conjuntoA, $conjuntoB);
    $resultadoInterseccion = $operaciones->interseccion($conjuntoA, $conjuntoB);
    $resultadoDiferenciaAB = $operaciones->diferencia($conjuntoA, $conjuntoB);
    $resultadoDiferenciaBA = $operaciones->diferencia($conjuntoB, $conjuntoA);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Conjuntos</title>
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="card">
        <h2>Operaciones con conjuntos</h2>

        <form method="POST">
            <label>Conjunto A (separado por comas):</label>
            <input type="text" name="conjuntoA" required placeholder="1, 2, 3, 4">

            <label>Conjunto B (separado por comas):</label>
            <input type="text" name="conjuntoB" required placeholder="3, 4, 5, 6">

            <button type="submit">Calcular</button>
        </form>

        <?php
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
        <a href="../index.php">Volver al menú</a>
    </div>
</body>
</html>

    