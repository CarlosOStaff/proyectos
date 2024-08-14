<?php
session_start();
require_once('../../BD/conexion.php');

// Verifica que el usuario está autenticado
if (!isset($_SESSION['cliente'])) {
    die('Error: Usuario no autenticado.');
}

$user = $_SESSION['cliente'];
$user_id = $user['id'];
if (isset($_POST['libroId'])) {
    $libro_id = $_POST['libroId'];
    $fecha_prestamo = new DateTime();
    $at = (new DateTime())->format('Y-m-d H:i:s');
    $fecha_prestamo_format = $fecha_prestamo->format('Y-m-d');

    $query = "INSERT INTO loans (user_id, libro_id, fecha_prestamo, fecha_devolucion, created_at, updated_at) VALUES ('$user_id', '$libro_id', '$fecha_prestamo_format', NULL, '$at', '$at')";
    $result = $mysqli->query($query);
    if($result){
        $_SESSION['message']='Libro prestado exitosamente';
        header("Location: ../../../Vistas/Cliente/index.php");
        exit();
    }else{
        $_SESSION['message']='Error al solicitar el libro';
        header("Location: ../../../Vistas/Cliente/index.php");
        exit();
    }
}
