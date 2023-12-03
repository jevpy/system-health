<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';


function phpmailer($correo, $password)
{
  //Create an instance; passing `true` enables exceptions
  $mail = new PHPMailer(true);

  try {
    //Server settings
    $mail->SMTPDebug = 2; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'admin'; //SMTP username
    $mail->Password = 'admin'; //SMTP password
    $mail->SMTPSecure = 'tls'; //Enable implicit TLS encryption
    $mail->Port = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('admin@gmail.com', 'Essalud');
    $mail->addAddress($correo); //Add a recipient
    // $mail->addAddress('pieroayalav@gmail.com'); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Subject = 'Contraseña asignada';
    $mail->Body = "Esta es tu contraseña: {$password}";

    $mail->send();
    return 'Enviado correctamente';
  } catch (Exception $e) {
    header("Location: errorEmail.php");
    die();
  }
}

