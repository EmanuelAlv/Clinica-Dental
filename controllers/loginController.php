<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
    }
    public static function logout() {
        echo "Desde el logout";
    }
    public static function olvide(Router $router) {
        $router->render('auth/olvide-contra', [

        ]);
    }
    public static function recuperar() {
        echo "Desde recuperar mi contrasena";
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
                    $correo = new Email($usuario->nombre, $usuario->correo, $usuario->token);
                    debuguear($correo);
                    $correo->enviarConfirmacion();
                    // no esta registrado
                    
                }
            }
            
        }
        $router->render('auth/crear-cuenta', [
            'usuario' => $usuario, //compartimos la variable usuario en la vista crear-cuenta donde la mostraremos
            'alertas' => $alertas
        ]);
    }
}