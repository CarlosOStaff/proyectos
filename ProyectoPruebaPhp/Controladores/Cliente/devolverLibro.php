<?php
require_once('../../BD/conexion.php');
session_start();

$user = $_SESSION['cliente'];
$user = $user['id'];
if (isset($_POST['libroId'])) {

    $libro_id = $_POST['libroId'];
    $query = "SELECT id,user_id, libro_id FROM loans WHERE user_id = '$user' AND libro_id = '$libro_id';";
    $result = $mysqli->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        $prestamo_id = $row['id'];
        $at = (new DateTime())->format('Y-m-d H:i:s');
        $fecha_prestamo = new DateTime();
        $fecha_prestamo_format = $fecha_prestamo->format('Y-m-d');

        $bookreturn  = "INSERT INTO book_returns (user_id,prestamo_id,fecha_devolucion,created_at,updated_at) 
        VALUES ('$user','$prestamo_id','$fecha_prestamo_format','$at','$at')";
        $result_bookreturn = $mysqli->query($bookreturn);
        if ($result_bookreturn) {
            $deleteloan = "DELETE FROM loans WHERE user_id = '$user' AND libro_id = '$libro_id'";
            $result_deleteloan = $mysqli->query($deleteloan);
            if ($result_deleteloan) {
                $_SESSION['message'] = "Libro devuelto con exito";
                header("Location: ../../../Vistas/Cliente/misLibros.php");
                exit();
            } else {
                $_SESSION['message'] = "Error al realizar esta accion";
                header("Location: ../../../Vistas/Cliente/misLibros.php");
                exit();
            }
        } else {
            $_SESSION['message'] = "Error al realizar esta accion";
            header("Location: ../../../Vistas/Cliente/misLibros.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "Error al intentar devolver el libro";
        header("Location: ../../../Vistas/Cliente/misLibros.php");
        exit();
    }
} else {
    $_SESSION['message'] = "No se encontro el libro";
    header("Location: ../../../Vistas/Cliente/misLibros.php");
    exit();
}
