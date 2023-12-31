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
        $this -> Id = $args['Id'] ?? 0;
        $this -> nombre = $args['nombre'] ?? '';
        $this -> apellido = $args['apellido'] ?? '';
        $this -> correo = $args['correo'] ?? '';
        $this -> password = $args['password'] ?? '';
        $this -> telefono = $args['telefono'] ?? '';
        $this -> admin = $args['admin'] ?? 0;
        $this -> confirmado = $args['confirmado'] ?? 0;
        $this -> token = $args['token'] ?? '';
    }

    // Mensajes de validacion para la creacion de una cuenta
    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->apellido) {
            self::$alertas['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe ser mayor a 6 caracteres';
        }

        return self::$alertas;
    }

    // 
    public function validarLogin(){
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        return self::$alertas;
    }

    //Validar correo
    public function validarCorreo(){
        if(!$this->correo) {
            self::$alertas['error'][] = 'El correo es obligatorio';
        }
        return self::$alertas;
    }

    //Validar password
    public function validarPassword(){
        if(!$this->password) {
            self::$alertas['error'][] = 'La contraseña es obligatoria';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'La contraseña debe contener por lo menos 6 caracteres';
        }
        return self::$alertas;
    }

    // Revisa si el usaurio ya existe
    public function existeUsuario() {
        $query = "SELECT * FROM ". self::$tabla . " WHERE correo = '". $this->correo ."' LIMIT 1";
        $resultado = self::$db->query($query);
        if($resultado->num_rows) {
            self::$alertas['error'][]= 'El usuario ya esta registrado';
        }
        return$resultado;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    public function crearToken() {
        $this->token = uniqid();
    }

    public function validarPasswordAndVerificado($password){
        $resultado = password_verify($password, $this->password);
        // debuguear($resultado);
        if(!$resultado || !$this->confirmado){
            self::$alertas['error'] = ['Contrasena incorrecta o cuenta no confirmada'];
        }else {
            return true;
        }

    }
}