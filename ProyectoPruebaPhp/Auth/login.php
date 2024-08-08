<?php
require_once('..\BD\conexion.php');

$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE email = '$email'";
$result = $mysqli->query($query);
$row = $result->fetch_array(MYSQLI_ASSOC);
var_dump($row);
if ($result->num_rows > 0) {
    if (password_verify($password, $row['password'])) {
        if (!is_null($row['email_verified_at'])) {
            if ($row['rol_id'] === 1) {
                $_SESSION['admin'] = $row;
                header("Location: ..\Vistas\Admin\index.html");
                exit();
            } else {
                $_SESSION['cliente'] = $row;
                header("Location: ..\Vistas\Cliente\index.html");
                exit();
            }
        } else {
            $_SESSION['message'] = 'Correo no verificado';
        }
    } else {
        $_SESSION['message'] = 'Correo o contraseña inválidos';
    }
} else {
    $_SESSION['message'] = 'Usuario no encontrado';
}

header("Location: ../Vistas/Auth/login.php");
exit();
