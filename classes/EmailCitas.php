<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class EmailCitas {
    public $email;
    public $nombre;
    public $fecha;
    public $hora;

    public function __construct($email, $nombre, $fecha, $hora)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }
    public function enviarConfirmacionCita(){
        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '32552e426296a9';
        $mail->Password = '33614ab750d62e';

        $mail->setFrom('info@confident.gt');
        $mail->addAddress('cliente@confident.gt','confident.gt');
        $mail->Subject = 'Información de tu cita';
        // Set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "
            <html>
                <style>
                    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500;700&display=swap');
                    h1 {
                        color: #046e8f;
                    }
                    h2 {
                        font-size: 25px;
                        font-weight: 500;
                        line-height: 25px;
                    }
                
                    body {
                        font-family: 'Poppins', sans-serif;
                        background-color: #ffffff;
                        max-width: 400px;
                        margin: 0 auto;
                        padding: 20px;
                    }
                
                    p {
                        line-height: 18px;
                        color: #183446;
                    }
                
                    a {
                        position: relative;
                        z-index: 0;
                        display: inline-block;
                        margin: 20px 0;
                    }
                
                    a button {
                        padding: 0.7em 2em;
                        font-size: 16px !important;
                        font-weight: 500;
                        background: #046e8f;
                        color: #ffffff;
                        border: none;
                        text-transform: uppercase;
                        cursor: pointer;
                    }
                    p span {
                        font-size: 12px;
                        color: #929292;
                    }
                    div p{
                        border-bottom: 1px solid #000000;
                        border-top: none;
                        margin-top: 40px;
                    }
                </style>
                <body>
                    <h1>ConfiDent</h1>
                    <h2>Hola ".$this->nombre.".</h2>
                    <p>Tu cita ha sido agendada con exito para la fecha ".$this->fecha." a las ".$this->hora." horas.</p>
                    <p>Nos estaremos comunicando contigo por telefono para confirmar la cita.</p>
                    <div><p></p></div>
                    <p><span>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span></p>
                </body>
            </html>";

        $mail->Body = $contenido;

        // Envio del correo
        $mail->send();
    }
}