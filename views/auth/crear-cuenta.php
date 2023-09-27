<h1 class="nombre-pagina">Crear cuenta</h1>
<p class="descripcion-pagina">Ingresa los siguientes datos para crear tu cuenta en ConfiDent.</p>

<form class="formulario" method="POST" action="/crear-cuenta">
    <div class="campo">
        <label for="nombre">Nombres</label>
        <input type="text" id="nombre" placeholder="Nombres" name="nombre">
    </div>
    <div class="campo">
        <label for="apellido">Apellidos</label>
        <input type="text" id="apellido" placeholder="Apellidos" name="apellido">
    </div>
    <div class="campo">
        <label for="telefono">Numero de telefono</label>
        <input type="tel" id="telefono" placeholder="Telefono" name="telefono">
    </div>
    <div class="campo">
        <label for="email">Correo</label>
        <input type="email" id="email" placeholder="Tu correo" name="email">
    </div>
    <div class="campo">
        <label for="password">Contraseña</label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password">
    </div>

    <input type="submit" class="boton" value="Crear cuenta">
</form>

<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia sesion</a>
    <a href="/olvide">¿Olvidaste tu contraseña?</a>
</div>