<?php
require_once '../clases/Acronimo.php';
$resultado = '';

if($_SERVER['REQUEST_METHOD']=== 'POST'){ /**Se compueba el envío del formulario */
    $texto = $_POST['texto'] ?? ''; /**Guardar el texto del usuario en $texto */
    $obj = new Acronimo();
    $resultado = $obj -> generar ($texto);
}
?>
<!DOCTYPE html>
<html lang="es">
    <head>
    <meta charset"UTF-8">
    <title>Acrónimo</title>
    <link rel="stylesheet" href="../css/estilo.css">
    </head>
    <body>
        <div class="card">
            <h2>Convierte una frase en acrónimo</h2>
            <form method="POST">
                <label>Ingrese el texto:</label>
                <input type="text" name="texto" required placeholder="Ej: Objeto Volador No Identificado">
                <button type="submit">Generar Acrónimo</button>
            </form>
            <?php if($resultado!= ''): ?>
                <div class="resultado">
                    <strong>Resultado:</strong> <?php echo $resultado; ?>
                </div>
                <?php endif; ?>
                <br><a href="../index.php">Volver al menú principal</a>
        </div>
    </body>
</html>