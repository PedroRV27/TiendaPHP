<?php
namespace lib;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Email {

  public static function send($asunto, $contenido, $para, $nombre) {
    try {
        // Iniciar almacenamiento en búfer de salida
        ob_start();

        // Validar dirección de correo electrónico
        if (!filter_var($para, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Dirección de correo electrónico no válida.');
        }

        // Instancia de PHPMailer
        $mail = new PHPMailer(true);

        // Configuración SMTP
        $mail->isSMTP();
        $mail->SMTPDebug = 0;  // Desactivar depuración en producción
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;  
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;  // Usar TLS
        $mail->SMTPAuth = true;
        $mail->Username = 'pedrorovi27@gmail.com';
        $mail->Password = 'vddl noiy vpqb ibnw';

        // Quien envía este mensaje
        $mail->setFrom('pedrorovi27@gmail.com', 'Mi tiendita');

        // Destinatario
        $mail->addAddress($para, $nombre);

        // Asunto del correo
        $mail->Subject = $asunto;

        // Contenido
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Body = sprintf('<h1>El mensaje es:</h1><br><p>%s</p>', $contenido);

        // Enviar el correo
        if (!$mail->send()) {
            throw new Exception('Mailer Error: ' . $mail->ErrorInfo);
        }

        // Limpiar el búfer de salida y descartar la salida
        
    } catch (Exception $e) {
        // Limpiar el búfer de salida en caso de excepción
        
        echo 'Error enviando correo: ' . $e->getMessage();
    }
}

}