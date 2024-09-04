<?php
session_start();
require_once('../BD/conexion.php');
require_once '../reCaptchav2/verificar_recaptcha.php';

$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if ($result->num_rows > 0) {
    if (password_verify($password, $row['password'])) {
        if (!is_null($row['email_verified_at'])) {
            if ($row['rol_id'] == 1) {
                /*Valida que la respuesta del captcha sea true*/
                if ($response_data->success) {
                    $_SESSION['admin'] = $row;
                    header("Location: ../Vistas/Admin/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = 'Completa el captcha';
                }
            } else {
                if ($response_data->success) {
                    $_SESSION['cliente'] = $row;
                    header("Location: ../Vistas/Cliente/index.php");
                    exit();
                } else {
                    $_SESSION['message'] = 'Completa el captcha';
                }
            }
        } else {
            $_SESSION['message'] = 'Correo no verificado';
        }
    } else {
        $_SESSION['message'] = 'Contraseña inválida';
    }
} else {
    $_SESSION['message'] = 'Usuario no encontrado';
}

header("Location: ../Vistas/Auth/login.php");
exit();
