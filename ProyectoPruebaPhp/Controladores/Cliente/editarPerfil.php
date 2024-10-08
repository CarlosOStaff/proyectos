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
$at = (new DateTime())->format('Y-m-d H:i:s');


if ($_SESSION['cliente']) {
    $user = $_SESSION['cliente'];
    $user = $user['id'];
    if ($password) {
        if ($password === $password_confirm) {
            $password = password_hash($password, PASSWORD_BCRYPT);

            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $img_name = $nombre . '_' . $apellido . '.' . $ext;
            $img_path = $ruta_img . $img_name;
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
        if (empty($img['name'])) {
            $profileUpdate = "UPDATE users SET nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', updated_at = '$at' WHERE id = '$user'";
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
        } else {
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $img_name = $nombre . '_' . $apellido . '_' . $email . '.' . $ext;
            $img_path = $ruta_img . $img_name;
            if (file_exists($ruta_img . $img_name)) {
                unlink($ruta_img . $img_name);
                move_uploaded_file($img['tmp_name'], $img_path);

                $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', updated_at = '$at' WHERE id = '$user'";
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
            } else {
                move_uploaded_file($img['tmp_name'], $img_path);

                $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', updated_at = '$at' WHERE id = '$user'";
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
    }
} else {
    $_SESSION['message'] = "Dede de iniciar sesion";
    header('Location: ../../Vistas/Auth/login.php');
    exit();
}
