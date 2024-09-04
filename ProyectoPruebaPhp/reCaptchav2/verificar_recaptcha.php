<?php
require '../Claves/claves.php';

// La respuesta del reCAPTCHA
$response = $_POST['g-recaptcha-response'];

// La IP del usuario
$remote_ip = $_SERVER['REMOTE_ADDR'];

// URL para la verificación del reCAPTCHA
$verify_url = 'https://www.google.com/recaptcha/api/siteverify';

// Datos a enviar para la verificación
$data = array(
    'secret' => $claves['secretKey'],
    'response' => $response,
    'remoteip' => $remote_ip
);

// Iniciar cURL
$ch = curl_init($verify_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Ejecutar la solicitud
$verification_response = curl_exec($ch);
curl_close($ch);

// Decodificar la respuesta JSON
$response_data = json_decode($verification_response);
