<?php

namespace Model;

class CitaServicio extends ActiveRecord {
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['Id','citaId', 'servicioId', 'comentarios'];

    public $Id;
    public $citaId;
    public $servicioId;
    public $comentarios;

    public function __construct($args = [])
    {
        $this->Id = $args['Id'] ?? 0;
        $this->citaId = $args['citaId'] ?? '';
        $this->servicioId = $args['servicioId'] ?? '';
        $this->comentarios = $args['comentarios'] ?? '';
    }
}