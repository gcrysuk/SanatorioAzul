<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload de Composer
require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host       = 'smtp.tu-servidor.com';        // ej: smtp.gmail.com
    $mail->SMTPAuth   = true;
    $mail->Username   = 'tu_correo@example.com';       // tu email
    $mail->Password   = 'tu_contraseña';               // tu contraseña de app o email
    $mail->SMTPSecure = 'tls';                         // o 'ssl'
    $mail->Port       = 587;                           // 587 para TLS, 465 para SSL

    // Configurar remitente y destinatario
    $mail->setFrom('tu_correo@example.com', 'Tu nombre');
    $mail->addAddress('destinatario@example.com', 'Nombre destinatario');

    // Contenido del mensaje
    $mail->isHTML(true);
    $mail->Subject = $_POST['asunto'];
    $mail->Body    = "Nombre: " . htmlspecialchars($_POST['nombre']) . "<br>" .
        "Email: " . htmlspecialchars($_POST['email']) . "<br>" .
        "Mensaje: <br>" . nl2br(htmlspecialchars($_POST['mensaje']));

    // Enviar
    $mail->send();
    echo 'Mensaje enviado correctamente.';
} catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
}
