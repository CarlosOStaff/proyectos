<?php
session_start();
require_once '../../../BD/conexion.php';

$titulo_libro = $_POST['titulo_libro'];
$descripcion = $_POST['descripcion'];
$contenido = $_POST['contenido'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$etiqueta_id = $_POST['etiqueta_id'];
$categoria_id = $_POST['categoria_id'];
$img = $_FILES['imagen'];
$ruta_img = "../../../Recursos/img/portadaLibros/";

$ext = pathinfo($img['name'], PATHINFO_EXTENSION);
$img_name = $titulo_libro . '_' . $fecha_publicacion . '.' . $ext;
$img_path = $ruta_img . $img_name;

move_uploaded_file($img['tmp_name'], $img_path);

$query = "INSERT INTO books (imagen,titulo_libro,descripcion,contenido,fecha_publicacion,categoria_id) 
VALUES ('$img_name','$titulo_libro','$descripcion','$contenido','$fecha_publicacion','$categoria_id')";
$result = $mysqli->query($query);
if ($result) {
    $book_id = $mysqli->insert_id;
    $querytag = "INSERT INTO book_tag (book_id, tag_id) VALUES ('$book_id','$etiqueta_id')";
    $resulttag = $mysqli->query($querytag);

    if ($resulttag) {
        $_SESSION['message'] = "Se han guardado los datos correctamente";
        header("Location: ../../../Vistas/Admin/Libros/nuevoLibro.php");
        exit();
    } else {
        $_SESSION['message'] = "Error al guardar la etiqueta";
        header("Location: ../../../Vistas/Admin/Libros/nuevoLibro.php");
        exit();
    }
} else {
    $_SESSION['message'] = "Error al guardar el libro";
    header("Location: ../../../Vistas/Admin/Libros/nuevoLibro.php");
    exit();
}
