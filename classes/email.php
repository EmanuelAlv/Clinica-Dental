<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email,$nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('info@confident.gt');
        $mail->addAddress('info@confident.gt','confident.gt');
        $mail->Subject = 'Confirma tu cuenta ConfiDent';
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
                    <h2>¡Gracias por registrarte!</h2>
                    <p>Por favor confirma tu correo electrónico para que puedas comenzar a disfrutar de todos los servicios de ConfiDent</p>
                    <a href='".$_ENV['APP_URL']."/confirmar-cuenta?token=". $this->token ."'><button>Verificar</button></a>
                    <p>Si tú no te registraste en ConfiDent, por favor ignora este correo electrónico.</p>
                    <div><p></p></div>
                    <p><span>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span></p>
                </body>
            </html>";

        $mail->Body = $contenido;

        // Envio del correo
        $mail->send();

    }

    public function enviarInstrucciones(){
        // crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USERNAME'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('info@confident.gt');
        $mail->addAddress('info@confident.gt','confident.gt');
        $mail->Subject = 'Restablecer contraseña';
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
                    <p>Has solicitado restablecer tu contraseña.</p>
                    <a href='".$_ENV['APP_URL']."/recuperar?token=". $this->token ."'><button>Restablecer</button></a>
                    <p>Si tú no solicitaste restablecer tu contraseña, por favor ignora este correo electrónico.</p>
                    <div><p></p></div>
                    <p><span>Este correo electrónico fue enviado desde una dirección solamente de notificaciones que no puede aceptar correo electrónico entrante. Por favor no respondas a este mensaje.</span></p>
                </body>
            </html>";

        $mail->Body = $contenido;

        // Envio del correo
        $mail->send();
    }
}