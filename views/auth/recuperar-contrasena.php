<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Recuperar contraseña</h1>
        <p class="descripcion-pagina">Ingresa a continuacion tu nueva contraseña</p>
        <?php 
            include_once __DIR__ . "/../templates/alertas.php";
        ?>
        <?php 
            if($error) return;
        ?>
        <form class="formulario" method="POST">
            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>

            <input type="submit" class="boton" value="Restablecer">
        </form>

        <div class="acciones">
            <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
            <a href="/login">¿Ya tienes una cuenta? Inicia Sesion</a>
        </div>
    </div>
</div>
