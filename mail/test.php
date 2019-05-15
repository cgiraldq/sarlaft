<?php

/* @var $this MvcUsersController */
/* @var $data MvcUsers */
$correo="Cristian.C.Giraldo@asesor.une.com.co";
$host = '200.13.249.167';
$user = 'registroune@une.net.co';
$pass='9000923859';

$mensaje="prueba 2 de envio de correo.";

require_once('./phpmailer/class.phpmailer.php');


$mail             = new PHPMailer();
$body             = 'hola 2';

$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = $host;
$mail->SMTPAuth   = true;
$mail->Username   = $user; // SMTP account username
$mail->Password   = $pass;        // SMTP account password
$mail->SetFrom($user, 'First Last');
$mail->Subject    = "PHPMailer Test Subject via smtp, basic with authentication";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
$mail->MsgHTML($body);
$address = $correo;

$mail->AddAddress($address, "David Holguin");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>
