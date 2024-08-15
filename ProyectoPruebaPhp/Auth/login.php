<?php
session_start();
require_once('../BD/conexion.php');

$email = $_POST['email'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
$row = $result->fetch_array();
if ($result->num_rows > 0) {
    if (password_verify($password, $row['password'])) {
        if (!is_null($row['email_verified_at'])) {
            if ($row['rol_id'] == 1) {
                $_SESSION['admin'] = $row;
                $sessionId = $_SESSION['session_id'] = session_id();
                header("Location: ../Vistas/Admin/index.html");
                exit();
            } else {
                $_SESSION['cliente'] = $row;
                $sessionId = $_SESSION['session_id'] = session_id();
                header("Location: ../Vistas/Cliente/index.php");
                exit();
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

// Redirige a la página de login después de establecer el mensaje en la sesión
header("Location: ../Vistas/Auth/login.php");
exit();
