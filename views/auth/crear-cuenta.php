<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Crear cuenta</h1>
        <p class="descripcion-pagina">Ingresa los siguientes datos para crear tu cuenta en ConfiDent.</p>
        <?php 
            include_once __DIR__ . "/../templates/alertas.php";
        ?>

        <form class="formulario" method="POST" action="/crear-cuenta">
            <div class="campo">
                <label for="nombre">Nombres</label>
                <input type="text" id="nombre" placeholder="Nombres" name="nombre" value="<?php echo s($usuario->nombre); ?>">
            </div>
            <div class="campo">
                <label for="apellido">Apellidos</label>
                <input type="text" id="apellido" placeholder="Apellidos" name="apellido" value="<?php echo s($usuario->apellido); ?>">
            </div>
            <div class="campo">
                <label for="telefono">Numero de telefono</label>
                <input type="tel" id="telefono" placeholder="Telefono" name="telefono" value="<?php echo s($usuario->telefono); ?>">
            </div>
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="email" id="correo" placeholder="Tu correo" name="correo" value="<?php echo s($usuario->correo); ?>">
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>

            <input type="submit" class="boton" value="Crear cuenta">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Inicia sesion</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>