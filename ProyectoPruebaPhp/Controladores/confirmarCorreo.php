<?php
session_start();
require_once('../BD/conexion.php');

$token = $_REQUEST['token'];
$email = $_REQUEST['email'];

$query = "SELECT * FROM users WHERE email = '$email' AND validated_token = '$token'";
$result = $mysqli->query($query);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    $now = new DateTime();
    $now_at = $now->format('Y-m-d H:i:s');


    $email_verified = "UPDATE users SET email_verified_at = '$now_at', validated_token = NULL WHERE email = '$email'";
    $result_email = $mysqli->query($email_verified);

    $_SESSION['message'] = "Correo confirmado correctamente";
    header('Location: ../Vistas/Auth/login.php');
    exit();
} else {
    $_SESSION['message'] = "Error al confirmar el correo";
    header('Location: ../Vistas/Auth/login.php');
    exit();
}
