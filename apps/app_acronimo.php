<?php
require_once '../clases/Acronimo.php';

/* Se inicializa la variable que guardará el acrónimo generado */
$resultado = '';

/* Se comprueba si se ha enviado el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* Se obtiene el texto ingresado por el usuario */
    $texto = $_POST['texto'] ?? '';

    /* Se crea un objeto de la clase Acronimo */
    $obj = new Acronimo();

    /* Se envía el texto al método que genera el acrónimo */
    $resultado = $obj->generar($texto);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Acrónimo</title>
    <link rel="stylesheet" href="../css/estilos.css">
    <link rel="stylesheet" href="../css/acronimo.css">
</head>

<body>
    <div class="card">
        <h1>Convierte una frase en acrónimo</h1>
        <form method="POST">
            <label>Ingrese el texto:</label>
            <input type="text" name="texto" required placeholder="Ej: Objeto Volador No Identificado">
            <button type="submit">Generar Acrónimo</button>
        </form>

        <?php if ($resultado != ''): ?>
            <div class="resultado">
                <strong>Acrónimo Generado:</strong> <?php echo $resultado; ?>
            </div>
        <?php endif; ?>

        <br><a href="../index.php">Volver al menú principal</a>
    </div>
</body>

</html>