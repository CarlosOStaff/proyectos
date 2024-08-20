<?php
session_start();
require_once('../../../BD/conexion.php');

$user_id = $_POST['user_id'];

    $userDelete = "DELETE FROM users WHERE id = '$user_id'";
    $resultDelete = $mysqli->query($userDelete);
    if($resultDelete){
        $_SESSION['message'] = "Usuario eliminado correctamente";
        header("Location: ../../../Vistas/Admin/usuariosActivos/usuariosActivos.php");
        exit();
    }else {
        $_SESSION['message'] = "Error al tratar de eliminar al usuario";
        header("Location: ../../../Vistas/Admin/usuariosActivos/usuariosActivos.php");
        exit();
    }

