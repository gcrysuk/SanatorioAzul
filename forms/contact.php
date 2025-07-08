<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Ajustá la ruta según dónde esté tu composer.json

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $mail = new PHPMailer(true);

  try {
    // Configuración del servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com'; // o el servidor SMTP que uses
    $mail->SMTPAuth = true;
    $mail->Username = 'TU_CORREO@gmail.com'; // tu correo real
    $mail->Password = 'CONTRASEÑA_O_CLAVE_DE_APP'; // contraseña o clave de app
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Remitente y destinatario
    $mail->setFrom($_POST['email'], $_POST['name']);
    $mail->addAddress('gabrielcrysuk@gmail.com'); // destinatario

    // Contenido
    $mail->isHTML(true);
    $mail->Subject = $_POST['subject'];
    $mail->Body    = "
            <h3>Nuevo mensaje desde tu sitio web</h3>
            <p><strong>Nombre:</strong> " . htmlspecialchars($_POST['name']) . "</p>
            <p><strong>Email:</strong> " . htmlspecialchars($_POST['email']) . "</p>
            <p><strong>Mensaje:</strong><br>" . nl2br(htmlspecialchars($_POST['message'])) . "</p>
        ";

    $mail->send();
    echo 'Mensaje enviado correctamente.';
  } catch (Exception $e) {
    echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
  }
}
