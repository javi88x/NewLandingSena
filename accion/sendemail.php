<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 4;                               // Enable verbose debug output

// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
	!isset($_POST['identificacion']) ||
	!isset($_POST['telefono']) ||
	!isset($_POST['email']) ||
	!isset($_POST['carreras'])){

	echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
	echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
	die();
}

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.office365.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'envios@uninpahu.edu.co';                 // SMTP username
$mail->Password = 'Gaco5970';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->From = 'envios@uninpahu.edu.co';
$mail->FromName = 'UNINPAHU Degris';
$mail->addAddress('handres@degrisdigital.com', 'Andres Degris');     // Add a recipient
$mail->addAddress('com@uninpahu.edu.co');               // Name is optional

$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Informacion Landing Principal';
$mail->Body    .= "<b>Nombre:</b> " . $_POST['nombre'] . "\n";
$mail->Body    .= "<b>Identificación:</b> " . $_POST['identificacion'] . "\n";
$mail->Body    .= "<b>E-mail:</b> " . $_POST['email'] . "\n";
$mail->Body    .= "<b>Teléfono:</b> " . $_POST['telefono'] . "\n";
$mail->Body    .= "<b>Carrera de interes:</b> " . $_POST['carreras'] . "\n\n";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
header ("Location: ../gracias.html");
}
?>
