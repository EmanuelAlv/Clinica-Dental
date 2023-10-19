<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function landing(Router $router) {
        $router->render('pages/landing-page');
    }
    public static function inicio(Router $router) {
        $router->render('pages/inicio');
    }
    public static function login(Router $router) {
        $alertas = [];
        $auth = new Usuario();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            // debuguear($auth);
            if(empty($alertas)){ //Si el arreglo de alartas esta vacio eso quiere decir que todos los datos estan completos
                $usuario = Usuario::buscarCorreo($auth->correo);
                // debuguear($usuario);
                if($usuario){
                    // verificar pasword
                    $usuario->validarPasswordAndVerificado($auth->password);
                    //Autenticar usuario
                    session_start(); 
                    $_SESSION['id'] = $usuario->Id;
                    $_SESSION['nombre'] = $usuario->nombre." ".$usuario->apellido;
                    $_SESSION['correo'] = $usuario->correo;
                    $_SESSION['login'] = true;
                    //Redireccionamiento
                    if($usuario->admin === "1") {
                        $_SESSION['admin'] = $usuario->admin ?? null;
                        header('location: /admin');
                    }else {
                        header('location: /cita');
                    }
                    debuguear($usuario->admin);
                }else{
                    Usuario::setAlerta('error', 'Usuario no encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas,
            'auth' => $auth
        ]);
    }
    public static function logout() {
        session_start();
        // debuguear($_SESSION);
        $_SESSION = [];
        // debuguear($_SESSION);
        header('location: /');
    }
    public static function olvide(Router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $auth = new Usuario($_POST);
            $alertas = $auth->validarCorreo();
            if(empty($alertas)){
                $usuario = Usuario::buscarCorreo($auth->correo);
                if($usuario && $usuario->confirmado === "1"){
                    //Generar nuevo token de un uso
                    $usuario->crearToken();
                    $usuario->guardar2();

                    //envio del correo
                    $correo = new Email($usuario->correo, $usuario->nombre, $usuario->token);
                    $correo->enviarInstrucciones();
                    //alerta
                    Usuario::setAlerta('exito','Revisa la bandeja de entrada de tu correo');
                    // debuguear($usuario);
                }else{
                    Usuario::setAlerta('error', 'El usuario no existe o no esta confirmado');
                    
                }
                // debuguear($usuario);
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('auth/olvide-contra', [
            'alertas' => $alertas
        ]);
    }
    public static function recuperar(Router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        $usuario = Usuario::where2('token', $token);
        // debuguear($usuario);
        if(empty($usuario)){
            Usuario::setAlerta('error','token no valido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //leer nueva contrasena
            $password = new Usuario($_POST);
            $alertas = $password->validarPassword();
            // debuguear($password);
            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar2();
                if($resultado){
                    header('location: /login');
                }
                debuguear($usuario);
            }
        }
        $alertas =Usuario::getAlertas();
        $router->render('auth/recuperar-contrasena', [
            'alertas'=>$alertas,
            'error'=>$error
        ]);
    }
    public static function crear(Router $router) {
        $usuario = new Usuario;

        // Alertas Vacias
        $alertas =  [];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario->sincronizar($_POST);
            $alertas = $usuario->validarNuevaCuenta();

            // Revisar que alertas este vacio para continuar con el formulario
            if(empty($alertas)){
                // echo 'pasaste la validacion';
                // Verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();

                if($resultado->num_rows) {
                    $alertas = Usuario::getAlertas();
                }else{
                    // hashear contrasena
                    $usuario->hashPassword();

                    // Generar token unico
                    $usuario->crearToken();

                    // Enviar el correo
                    $correo = new Email($usuario->correo, $usuario->nombre, $usuario->token);

                    $correo->enviarConfirmacion();

                    // Crear usuario
                    $resultado = $usuario->guardar();
                    // debuguear($usuario);
                    if($resultado){
                        header('Location: /mensaje');
                    }
                    
                }
            }
            
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario, //compartimos la variable usuario en la vista crear-cuenta donde la mostraremos
            'alertas' => $alertas
        ]);
    }

    public static function confirmar(Router $router) {
        $alertas = [];
        $token = s($_GET['token']); //Conseguimos el token de la url enviada al correo
        $usuario = Usuario::where2('token', $token);
        // debuguear($usuario);
        if(empty($usuario)){ //validacion si el usuario existe
            //Si no existe mostramos un mensaje de error
            Usuario::setAlerta('error', 'Token no valido');
        } else {
            //Si esiste modificamos el campo de confirmado del usuario
            $usuario->confirmado = "1";
            //Limpiamos el campo de token una vez validado el usuario
            $usuario->token = '';
            //Guardamos en la base de datos las modificaciones hechas
            $usuario->guardar2();
            // debuguear($usuario);
            Usuario::setAlerta('exito', 'Usuario confirmado con exito.');
        }
        
        $alertas = Usuario::getAlertas();//cargamos las alertas antes de renderizar la vista de confirmar cuenta
        $router->render('auth/confirmar-cuenta', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router) {
        $router->render('auth/mensaje');
    }
}