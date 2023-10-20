<div class="adminBackground">
    <h1 class="nombre-pagina">Panel de administracion</h1>
    <?php 
        include_once __DIR__ . '/../templates/barraServicios.php'
    ?>
    <p class="descripcion-pagina text-center">Hola <?php echo $nombre?></p>
    <h3>Buscar citas</h3>
    <div class="busqueda">
        <form class="formulario" action="">
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $fecha?>">
            </div>
        </form>
    </div>
    <?php
        if(count($citas) === 0){
            echo "<h3>No hay citas para este dia</h3>";
        }
    ?>
    <div class="citas-admin">
        <ul class="citas">
            <?php
                $idCita = 0;
                foreach($citas as $key => $cita){
                    if($idCita !== $cita->Id){
                        $total = 0;
            ?>
                        <li>
                            <h3>Cita No. <?php echo $cita->Id?></h3>
                            <!-- <p>ID: <span><?php echo $cita->Id?></span></p> -->
                            <p>Hora: <span><?php echo $cita->hora?></span></p>
                            <p>Cliente: <span><?php echo $cita->cliente?></span></p>
                            <p>Correo: <span><?php echo $cita->correo?></span></p>
                            <p>Telefono: <span><?php echo $cita->telefono?></span></p>
                            <form class="form-boton" action="/api/eliminar" method="POST">
                                <label for="cometarios">Comentarios:</label>
                                <input id="cometarios" type="text" name="comentarios" value="<?php echo $cita->comentarios ?>">
                                <input type="submit" class="boton" value="Guardar">
                            </form>
                            <h3>Servicios:</h3>
                            <?php
                                $idCita = $cita->Id;
                    } //Fin del IF 
                                $total += $cita->precio;
                            ?>
                <p class="servicio">- <?php echo $cita->servicio . " " . $cita->precio;?></p>
                <?php
                    $actual = $cita->Id;
                    $proximo = $citas[$key + 1]->Id ?? 0;
                    if(esUltimo($actual, $proximo)){ ?>
                        <p class="total">Total: <span>Q.<?php echo $total?></span></p>
                        <form class="form-boton" action="/api/eliminar" method="POST">
                            <input type="hidden" name="Id" value="<?php echo $cita->Id; ?>">
                            <input type="submit" class="boton-eliminar" value="Eliminar">
                        </form>
                <?php
                    }
                ?>
            <?php } //Fin del foreach ?>
        </ul>
    </div>

    <?php
        include_once __DIR__ . '/../templates/barra.php';
        $script = "<script src = 'build/js/buscador.js'></script>"
    ?>
</div>