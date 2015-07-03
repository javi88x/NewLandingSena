<?php

$url = 'https://api.sendgrid.com/';
$user = 'javi88x';
$pass = 'live3156942208';


// Aquí se deberían validar los datos ingresados por el usuario
if(!isset($_POST['nombre']) ||
	!isset($_POST['telefono']) ||
	!isset($_POST['email']) ||
	!isset($_POST['carreras'])){

	echo "<b>Ocurrió un error y el formulario no ha sido enviado. </b><br />";
	echo "Por favor, vuelva atrás y verifique la información ingresada<br />";
	die();
}


$params = array(
    'api_user'  => "$user",
    'api_key'   => "$pass",
    'to'        => "ingfranciscodonado@gmail.com", // set TO address to have the contact form's email content sent to
    'subject'   => "Datos formulario inscripciones", // Either give a subject for each submission, or set to $subject
    'html'      => "<html><head><title> Datos formulario inscripciones</title><body>
    Nombre: $nombre\n<br>
    Teléfono: $telefono\n<br>
    Email: $email\n<br>
    Carrera: $carreras\n<br>
    <body></title></head></html>", // Set HTML here.  Will still need to make sure to reference post data names
    'text'      => "
    Nombre: $name\n
    Telefono: $telefono\n
    Email: $email\n
    Carrera de ineteres: $carreras\n",
    'from'      => "francisco@degrisdigital.com", // set from address here, it can really be anything
  );


$request =  $url.'api/mail.send.json';

// Generate curl request
$session = curl_init($request);
// Tell curl to use HTTP POST
curl_setopt ($session, CURLOPT_POST, true);
// Tell curl that this is the body of the POST
curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
// Tell curl not to return headers, but do return the response
curl_setopt($session, CURLOPT_HEADER, false);
// Tell PHP not to use SSLv3 (instead opting for TLS)
curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

// obtain response
$response = curl_exec($session);
curl_close($session);
header ("Location: ../gracias.html");

// print everything out
print_r($response);

?>