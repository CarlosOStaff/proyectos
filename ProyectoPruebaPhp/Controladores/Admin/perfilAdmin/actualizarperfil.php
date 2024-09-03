<?php
session_start();
require_once '../../../BD/conexion.php';
$user = $_SESSION['admin'];
$user = $user['id'];

$img = $_FILES['img_perfil'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$ciudad_id = $_POST['ciudad_id'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmar_password = $_POST['confirmar_password'];
$ruta_img = "../../../Recursos/img/users/perfil/";
$at = (new DateTime())->format('Y-m-d H:i:s');


if ($password) {
    if ($password === $confirmar_password) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        if (empty($img['tmp_name'])) {
            $profileUpdate = "UPDATE users SET nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', password = '$password', updated_at = '$at' WHERE id = '$user'";
            $result_profileUpdate = $mysqli->query($profileUpdate);
            if ($result_profileUpdate) {
                $_SESSION['message'] = "Datos actualizados correctamente";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            } else {
                $_SESSION['message'] = "Error al guardar";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            }
        } else {
            $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
            $img_name = $nombre . '_' . $apellido . '_' . $email . '.' . $ext;
            $img_path = $ruta_img . $img_name;
            if (file_exists($ruta_img . $img_name)) {
                unlink($ruta_img . $img_name);
                move_uploaded_file($img['tmp_name'], $img_path);
                $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', password = '$password',updated_at = '$at' WHERE id = '$user'";
                $result_profileUpdate = $mysqli->query($profileUpdate);
                if ($result_profileUpdate) {
                    $_SESSION['message'] = "Datos actualizados correctamente";
                    header("Location: ../../../Vistas/Admin/perfil.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error al guardar los datos";
                    header("Location: ../../../Vistas/Admin/perfil.php");
                    exit();
                }
            } else {
                move_uploaded_file($img['tmp_name'], $img_path);
                $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', password = '$password', updated_at = '$at' WHERE id = '$user'";
                $result_profileUpdate = $mysqli->query($profileUpdate);
                if ($result_profileUpdate) {
                    $_SESSION['message'] = "Datos actualizados correctamente";
                    header("Location: ../../../Vistas/Admin/perfil.php");
                    exit();
                } else {
                    $_SESSION['message'] = "Error al guardar";
                    header("Location: ../../../Vistas/Admin/perfil.php");
                    exit();
                }
            }
        }
    } else {
        $_SESSION['message'] = "Las contraseñas no coinciden";
        header("Location: ../../../Vistas/Admin/perfil.php");
        exit();
    }
} else {
    if (empty($img['tmp_name'])) {
        $profileUpdate = "UPDATE users SET nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email',updated_at = '$at' WHERE id = '$user'";
        $result_profileUpdate = $mysqli->query($profileUpdate);
        if ($result_profileUpdate) {
            $_SESSION['message'] = "Datos actualizados correctamente";
            header("Location: ../../../Vistas/Admin/perfil.php");
            exit();
        } else {
            $_SESSION['message'] = "Error al guardar";
            header("Location: ../../../Vistas/Admin/perfil.php");
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
            if ($result_profileUpdate) {
                $_SESSION['message'] = "Datos actualizados correctamente";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            } else {
                $_SESSION['message'] = "Error al guardar los datos";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            }
        } else {
            move_uploaded_file($img['tmp_name'], $img_path);
            $profileUpdate = "UPDATE users SET img_perfil = '$img_name' ,nombre = '$nombre', apellido = '$apellido',ciudad_id ='$ciudad_id' ,email = '$email', updated_at = '$at' WHERE id = '$user'";
            $result_profileUpdate = $mysqli->query($profileUpdate);
            if ($result_profileUpdate) {
                $_SESSION['message'] = "Datos actualizados correctamente";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            } else {
                $_SESSION['message'] = "Error al guardar los datos";
                header("Location: ../../../Vistas/Admin/perfil.php");
                exit();
            }
        }
    }
}
