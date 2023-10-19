<?php

namespace Controllers;
use Model\Cita;
use Model\Usuario;
use Model\CitaServicio;
use Model\Servicio;
use Classes\EmailCitas;

class APIController {
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }
    public static function guardar() {
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();
        $id = $resultado['id'];
        $usuario = Usuario::where2('Id', $id);

        //Almacena la cita y los servicios
        $idServicios = explode(",", $_POST['servicios']);
        foreach($idServicios as $idServicio) {
            $args = [
                'citaId' => $id,
                'servicioId' => $idServicio,
                'comentarios' => ''
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }
        echo json_encode(['resultado' => $resultado]);
        $correo = new EmailCitas($usuario->correo, $usuario->nombre, $cita->fecha, $cita->hora);
        $correo->enviarConfirmacionCita();
        // $auth = new Usuario($_POST);
        

        // $respuesta = [
        //     'cita' => $cita
        // ];
        // echo json_encode($resultado);
    }

    public static function eliminar(){

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $Id = $_POST['Id'];
            $cita = Cita::find($Id);
            $cita->eliminar();
            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}