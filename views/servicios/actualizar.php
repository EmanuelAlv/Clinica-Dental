<h1 class="nombre-pagina ">Actualizar servicio</h1>
<p class="descripcion-pagina">Modifica los valores en el formulario</p>

<?php
    include_once __DIR__ . '/../templates/barraServicios.php';
    include_once __DIR__ . '/../templates/alertas.php';
?>

<form method="POST" class="formulario">
    <?php 
    include_once __DIR__ . '/formulario.php'
    ?>
    <input type="submit" class="boton" value="Actualizar">
</form>