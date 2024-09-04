<?php
session_start();
require_once('../BD/conexion.php');

if (isset($_POST['token']) && isset($_POST['email'])) {
    $token = $_POST['token'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['confirm_password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password_reset_token = '$token'";
    $result = $mysqli->query($query);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($result->num_rows > 0) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $passwordUpdate = "UPDATE users SET password = '$password' WHERE email = '$email' AND password_reset_token = '$token'";
        $result = $mysqli->query($passwordUpdate);
        $_SESSION['message'] = 'Contraseña actualizada, inicia sesión en el siguiente enlace: <a href="login.php">Iniciar sesión</a>';
        header("Location: ../Vistas/Auth/cambiarpassword.php");
        session_destroy();
        exit();
    }
} else {
    $_SESSION['message'] = 'Token o correo electrónico inválidos.';
    header("Location: ../Vistas/Auth/cambiarpassword.php");
    exit();
}
