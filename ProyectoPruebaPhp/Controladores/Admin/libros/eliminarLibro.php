<?php
require_once('../../../BD/conexion.php');
$libroId = $_POST['btnEliminar'];

$query = "DELETE FROM books WHERE id = '$libroId'";
$result = $mysqli->query($query);
if ($result) {
    $_SESSION['message'] = "Libro eliminado correctamente";
    header("Location: ../../../Vistas/Admin/Libros/libros.php");
    exit();
} else {
    $_SESSION['message'] = "Error al eliminar el libro";
    header("Location: ../../../Vistas/Admin/Libros/libros.php");
    exit();
}
