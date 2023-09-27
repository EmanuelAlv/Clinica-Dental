<?php

namespace Controllers;

use MVC\Router;

class LoginController {
    public static function login(Router $router) {
        $router->render('auth/login');
    }
    public static function logout() {
        echo "Desde el logout";
    }
    public static function olvide() {
        echo "Olvide mi contrasena";
    }
    public static function recuperar() {
        echo "Desde recuperar mi contrasena";
    }
    public static function crear() {
        echo "Desde crear cuenta";
    }
}