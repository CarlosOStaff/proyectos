<?php
require_once '../../BD/conexion.php';

$user_delete = $_POST['user_delete'];
$query = "DELETE FROM users WHERE id = '$user_delete'";
$result = $mysqli->query($query);
if ($result) {
    $_SESSION['message'] = "Usuario eliminado con exito";
    header("Location: ../../Vistas/Admin/Admins/admisActivos");
    exit();
} else {
    $_SESSION['message'] = "Error al eliminar al usuario";
    header("Location: ../../Vistas/Admin/Admins/admisActivos");
    exit();
}
