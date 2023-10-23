<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\citaController;
use Controllers\AdminController;
use Controllers\LoginController;
use Controllers\ServicioController;
use MVC\Router;

$router = new Router();
// Landing Page
$router->get('/', [LoginController::class, 'landing']);

// Landing inicio
// $router->get('/inicio', [LoginController::class, 'inicio']);

// iniciar sesion
$router->get('/login', [LoginController::class, 'login']); //En el segundo parametro de la funcion get estamos pasando un controlador llamado LoginController en la carpeta de controllers
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar contrasena
$router->get('/olvide', [LoginController::class, 'olvide']);
$router->post('/olvide', [LoginController::class, 'olvide']);
$router->get('/recuperar', [LoginController::class, 'recuperar']);
$router->post('/recuperar', [LoginController::class, 'recuperar']);

//Crear cuenta
$router->get('/crear-cuenta', [LoginController::class, 'crear']);
$router->post('/crear-cuenta', [LoginController::class, 'crear']);

// Confirmar cuenta
$router->get('/confirmar-cuenta', [LoginController::class, 'confirmar']);
$router->get('/mensaje', [LoginController::class, 'mensaje']);

// AREA PRIVADA
$router->get('/cita', [citaController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API de citas
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'guardar']);
$router->post('/api/eliminar', [APIController::class, 'eliminar']);

// CRUD de servicios
$router->get('/servicios', [ServicioController::class, 'index']);
$router->get('/servicios/crear', [ServicioController::class, 'crear']);
$router->post('/servicios/crear', [ServicioController::class, 'crear']);
$router->get('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/actualizar', [ServicioController::class, 'actualizar']);
$router->post('/servicios/eliminar', [ServicioController::class, 'eliminar']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();