<h1 class="nombre-pagina ">Servicios</h1>
<p class="descripcion-pagina">Administracion de servicios</p>

<?php
    include_once __DIR__ . '/../templates/barraServicios.php'
?>
<ul class="servicios">
    <?php
        foreach($servicios as $servicio) {
    ?>
    <li>
        <p>Nombre:<span><?php echo $servicio->nombre; ?></span></p>  
        <p>Precio: Q.<span><?php echo $servicio->precio; ?></span></p>

        <div class="acciones">
            <div class="boton-normal"><a class="a-blanco" href="/servicios/actualizar?Id=<?php echo $servicio->Id; ?>">Actualizar</a></div>
            
            <form action="/servicios/eliminar" method="POST">
                <input type="hidden" name="Id" value="<?php echo $servicio->Id; ?>">
                <input type="submit" value="Borrar" class="boton-eliminar">
            </form>
        </div>
    </li>
    <?php } ?>
</ul>

