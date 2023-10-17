<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Login</h1>
        <p class="descripcion-pagina">Inicia sesion con tus datos.</p>
        <?php 
            include_once __DIR__ . "/../templates/alertas.php";
        ?>
        <form class="formulario" method="POST" action="/login">
            <div class="campo">
                <label for="correo">Correo</label>
                <input type="email" id="correo" placeholder="Tu correo" name="correo" value="<?php echo s($auth->correo); ?>">
            </div>
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>

            <input type="submit" class="boton" value="Iniciar sesión">
        </form>

        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>
    </div>
</div>
