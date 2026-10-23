<?php
require_once '../clases/Binarios.php';
$resultado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $numero = $_POST['numero'];
    $numero = (int)$numero;

    $convertidor = new Binario();
    $resultado = $convertidor->convertirBinario($numero);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Decimal a Binario</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/binarios.css">
</head>
<body>
    <div class="card">
        <h1>Convierte un número decimal a binario</h1>

        <form method="POST">
            <label>Número entero:</label>
            <input type="number" name="numero" min="0" step="1" required>

            <button type="submit">Convertir</button>
        </form>

        <?php
        if ($resultado !== '') {
        ?>
            <div class="resultado">
                <strong>Número ingresado:</strong>
                <?php echo $numero; ?>
                <br>
                <strong>Resultado binario:</strong>                
                <?php echo $resultado; ?>
            </div>
        <?php
        }
        ?>

        <br><a href="../index.php">Volver al menú principal</a>
    </div>
</body>
</html>