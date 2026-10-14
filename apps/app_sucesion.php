<?php
require_once '../clases/Sucesion.php';
$resultado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $num = $_POST['numero'];
    $num = (int)$num;
    $operacion = $_POST['operacion'];
    $obj = new Sucesion();

    if ($operacion === 'fibonacci') {
        $res = $obj->calcularFibonacci($num);
        $textoSerie = implode(', ', $res); /**Une los elementos con una coma y un espacio entre ellos */
        $resultado = "Serie Fibonacci: " . $textoSerie;
    } elseif($operacion === 'factorial') {
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
    <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
    <div class="card">
        <h2>Selecciona una opción y conoce su sucesión Fibonacci o su factorial.</h2>
        <form method="POST">
            <label>Número:</label>
            <input type="number" name="numero" min="1" required>
            <label>Operación:</label>
            <select name="operacion">
                <option value="fibonacci">Sucesión de Fibonacci</option>
                <option value="factorial">Factorial de un número</option>
            </select>
            <button type="submit">Calcular</button>
        </form>

        <?php if ($resultado != ''): ?>
            <div class="resultado"><?php echo $resultado; ?></div>
        <?php endif; ?>
        <br><a href="../index.php">Volver al menú</a>
    </div>
</body>
</html>