<?php

namespace Controllers;

use Model\AdminCita;
use MVC\Router;

class AdminController {
    public static function index (Router $router){
        session_start();
        $fecha = $_GET['fecha'] ?? date('Y-m-d');
        $fechas = explode('-', $fecha);
        if(!checkdate($fechas[1], $fechas[2], $fechas[0])){
            header('Location: /404');
        }
        //Consulta a la base de datos
        $consulta = "SELECT citas.Id, citas.hora, CONCAT(usuarios.nombre, ' ', usuarios.apellido) AS cliente, ";
        $consulta .= " usuarios.correo, usuarios.telefono, servicios.nombre AS servicio, servicios.precio, citasservicios.comentarios";
        $consulta .= " FROM citas  ";
        $consulta .= " LEFT OUTER JOIN usuarios ";
        $consulta .= " ON citas.usuarioId = usuarios.Id  ";
        $consulta .= " LEFT OUTER JOIN citasservicios ";
        $consulta .= " ON citas.Id = citasservicios.citaId ";
        $consulta .= " LEFT OUTER JOIN servicios ";
        $consulta .= " ON citasservicios.servicioId = servicios.Id ";
        $consulta .= " WHERE fecha =  '${fecha}' ;";

        $citas = AdminCita::SQL($consulta);
        // debuguear($citas);


        $router->render('admin/index',[
            'nombre' => $_SESSION['nombre'],
            'citas' => $citas,
            'fecha' => $fecha
        ]);
    }
}