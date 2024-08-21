<?php
require_once('../../../BD/conexion.php');
$id = intval($_POST['id']);
$titulo_libro = $_POST['titulo_libro'];
$descripcion = $_POST['descripcion'];
$categoria_id = $_POST['categoria_id'];
$fecha_publicacion = $_POST['fecha_publicacion'];
$contenido = $_POST['contenido'];
$imagen = $_FILES['imagen'];
$ruta_img = "../../../Recursos/img/portadaLibros/";

if (empty($imagen['tmp_name'])) {
    $libro = "UPDATE books 
        SET titulo_libro = '$titulo_libro', 
        descripcion = '$descripcion', contenido = '$contenido', 
        fecha_publicacion = '$fecha_publicacion', 
        categoria_id = '$categoria_id'
        WHERE id = '$id'";
    $libro_result = $mysqli->query($libro);
    if ($libro_result) {
        $_SESSION['message'] = "Datos actualizados correctamente";
        header("Location: ../../../Vistas/Admin/Libros/libros.php");
        exit();
    } else {
        $_SESSION['message'] = "Error al intentaar actualizar los datos";
        header("Location: ../../../Vistas/Admin/Libros/libros.php");
        exit();
    }
} else {
    $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
    $img_name = $titulo_libro . '_' . $fecha_publicacion . '.' . $ext;
    $img_path = $ruta_img . $img_name;
    if (file_exists($ruta_img . $img_name)) {

        unlink($ruta_img . $img_name);
        move_uploaded_file($imagen['tmp_name'], $img_path);
        $libro_img = "UPDATE books SET imagen = '$img_name',titulo_libro = '$titulo_libro', 
            descripcion = '$descripcion', contenido = '$contenido', 
            fecha_publicacion = '$fecha_publicacion', 
            categoria_id = '$categoria_id'
            WHERE id = '$id'";
        $libro_img_result = $mysqli->query($libro_img);
        if ($libro_img_result) {
            $_SESSION['message'] = "Datos actualizados correctamente";
            header("Location: ../../../Vistas/Admin/Libros/libros.php");
            exit();
        } else {
            $_SESSION['message'] = "Error al intentaar actualizar los datos";
            header("Location: ../../../Vistas/Admin/Libros/libros.php");
            exit();
        }
    }else{
        move_uploaded_file($imagen['tmp_name'], $img_path);
        $libro_img = "UPDATE books SET imagen = '$img_name',titulo_libro = '$titulo_libro', 
            descripcion = '$descripcion', contenido = '$contenido', 
            fecha_publicacion = '$fecha_publicacion', 
            categoria_id = '$categoria_id'
            WHERE id = '$id'";
        $libro_img_result = $mysqli->query($libro_img);
        if ($libro_img_result) {
            $_SESSION['message'] = "Datos actualizados correctamente";
            header("Location: ../../../Vistas/Admin/Libros/libros.php");
            exit();
        } else {
            $_SESSION['message'] = "Error al intentaar actualizar los datos";
            header("Location: ../../../Vistas/Admin/Libros/libros.php");
            exit();
        }
    }
}
