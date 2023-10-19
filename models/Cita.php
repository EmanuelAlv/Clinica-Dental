<?php

namespace Model;

class Cita extends ActiveRecord {
    // base de datos 
    protected static $tabla = 'citas';
    protected static $columnasDB = ['Id','fecha', 'hora', 'usuarioId'];

    public $Id;
    public $fecha;
    public $hora;
    public $usuarioId;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? 0;
        $this->fecha = $args['fecha'] ?? '';
        $this->hora = $args['hora'] ?? '';
        $this->usuarioId = $args['usuarioId'] ?? '';
    }
}