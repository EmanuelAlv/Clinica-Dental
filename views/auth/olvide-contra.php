<div class="contenedor-app">
    <div class="imagen"></div>
    <div class="app">
        <h1 class="nombre-pagina">Recuperar contraseña</h1>
        <p class="descripcion-pagina">Recupera tu contraseña. Ingresa tu correo electronico.</p>

        <form class="formulario" action="/olvide" method="POST">
            <div class="campo">
                <label for="email">Correo</label>
                <input type="email" id="email" placeholder="Tu correo" name="email">
            </div>

            <input type="submit" class="boton" value="Recuperar">
        </form>

        <div class="acciones">
            <a href="/login">¿Ya tienes una cuenta? Inicia sesion</a>
            <a href="/crear-cuenta">¿Aún no tienes cuenta? Crea una</a>
        </div>
    </div>
</div>
