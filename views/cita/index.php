<div class="contenedor-principal">
    <h1 class="nombre-pagina">Crear nueva cita</h1>
    <p class="descripcion-pagina text-center">Hola <?php echo $nombre?></p>
    <p class="descripcion-pagina text-center">Completa el formulario para agendar tu cita.</p>
    <nav class="tabs">
        <button type="button" data-paso="1">Servicios</button>
        <button type="button" data-paso="2">Datos y fecha</button>
        <button type="button" data-paso="3">Resumen</button>
    </nav> 
    <div id="app" class="contenedor-secciones">
        <div id="paso-1" class="seccion">
            <h2>Servicios</h2>
            <p class="text-center">Elige los servicios que deseas para tu cita.</p>
            <div id="servicios" class="listado-servicios"></div>
        </div>
        <div id="paso-2" class="seccion">
            <h2>Tus Datos y Cita</h2>
            <p class="text-center">Ingresa tus datos y fecha para tu cita.</p>
            <form class="formulario">
                <div class="campo">
                    <label for="nombre">Nombre del paciente</label>
                    <input id="nombre" type="text" placeholder="Nombre del paciente" value="<?php echo $nombre?>">
                </div>
                <div class="campo">
                    <label for="fecha">Fecha</label>
                    <input id="fecha" type="date" min="<?php echo date('Y-m-d', strtotime('+1 day'))?>">
                </div>
                <div class="campo">
                    <label for="hora">Hora</label>
                    <input id="hora" type="time" >
                </div>
                <input type="hidden" id="Id" value="<?php echo $Id ?>" >
            </form>
        </div>
        <div id="paso-3" class="seccion contenido-resumen">
            <h2>Resumen</h2>
            <p class="text-center">Verifica que la informacion de tu cita sea correcta</p>
        </div>
    </div>
    <div class="paginacion">
        <button id="anterior" class="boton">&laquo; Anterior</button>
        <button id="siguiente" class="boton">Siguiente &raquo;</button>
    </div>
    <?php
        include_once __DIR__ . '/../templates/barra.php';
    ?>
</div>
<?php
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='build/js/app.js'></script>
    ";
?>