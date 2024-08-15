<?php
session_start();
require_once('../../BD/Conexion.php');

$nombre = $_POST['nombre'];
$img = $_FILES['img_perfil'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$ciudad_id = $_POST['ciudad_id'];
$password = $_POST['password'];
$password_confirm = $_POST['confirmar_password'];
$ruta_img = "../../Recursos/img/users/perfil/";

if ($_SESSION['cliente']) {
    $user = $_SESSION['cliente'];
    $user = $user['id'];
    if ($password) {
        if ($password === $password_confirm) {
            $password = password_hash($password, PASSWORD_BCRYPT);

            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            // Crea el nuevo nombre de la imagen
            $img_name = $nombre . '_' . $apellido . '.' . $ext;
            // Define la ruta completa para la imagen
            $img_path = $ruta_img . $img_name;
            // Mueve la imagen al directorio
            if (file_exists($ruta_img . $img_name)) {
                unlink($ruta_img . $img_name);
                move_uploaded_file($img['tmp_name'], $img_path);

                $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', password = '$password' WHERE id = '$user'";
                $result_profileUpdate = $mysqli->query($profileUpdate);
                if ($result_profileUpdate === true) {
                    $_SESSION['message'] = "Datos actualizados correctamente";
                    header('Location: ../../Vistas/Cliente/profile.php');
                    exit();
                } else {
                    $_SESSION['message'] = "Error al actualizar datos";
                    header('Location: ../../Vistas/Cliente/profile.php');
                    exit();
                }
            }
        } else {
            $_SESSION['message'] = "Las contraseñas no coinciden";
            header('Location: ../../Vistas/Cliente/profile.php');
            exit();
        }
    } else {
        $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
        // Crea el nuevo nombre de la imagen
        $img_name = $nombre . '_' . $apellido . '.' . $ext;
        // Define la ruta completa para la imagen
        $img_path = $ruta_img . $img_name;
        // Mueve la imagen al directorio

        if(file_exists($ruta_img . $img_name)){
            unlink($ruta_img . $img_name);
            move_uploaded_file($img['tmp_name'], $img_path);

            $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email' WHERE id = '$user'";
        $result_profileUpdate = $mysqli->query($profileUpdate);
        if ($result_profileUpdate === true) {
            $_SESSION['message'] = "Datos actualizados correctamente";
            header('Location: ../../Vistas/Cliente/profile.php');
            exit();
        } else {
            $_SESSION['message'] = "Error al actualizar datos";
            header('Location: ../../Vistas/Cliente/profile.php');
            exit();
        }
        }
    }
} else {
    $_SESSION['message'] = "Dede de iniciar sesion";
    header('Location: ../../Vistas/Auth/login.php');
    exit();
}
