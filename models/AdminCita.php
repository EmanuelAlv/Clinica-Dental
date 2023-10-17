<?php

namespace Model;

class AdminCita extends ActiveRecord {
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['Id','hora', 'cliente', 'correo', 'telefono', 'servicio', 'precio'];

    public $Id;
    public $hora;
    public $cliente;
    public $correo;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? 0;
        $this->hora = $args['hora'] ?? '';
        $this->cliente = $args['cliente'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->servicio = $args['servicio'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

}