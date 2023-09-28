<?php

namespace Model;

class Usuario extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['Id', 'nombre', 'apellido', 'correo', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $Id;
    public $nombre;
    public $apellido;
    public $correo;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []) {
        $this -> Id = $args['Id'] ?? null;
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> correo = $args['correo'] ?? '';
        $this -> password = $args['password'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';
        $this -> admin = $args['admin'] ?? null;
        $this -> confirmado = $args['confirmado'] ?? null;
        $this -> token = $args['token'] ?? '';
    }
}