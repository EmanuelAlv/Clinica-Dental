<?php

namespace Model;

class Servicio extends ActiveRecord {
    //Base de datos
    protected static $tabla = 'servicios';
    protected static $columnasDB = ['Id', 'nombre', 'precio'];

    public $Id;
    public $nombre;
    public $precio;

    public function __construct($args = []) {
        $this->Id = $args['Id'] ?? 0;
        $this->nombre = $args['nombre'] ?? '';
        $this->precio = $args['precio'] ?? '';
    }

}