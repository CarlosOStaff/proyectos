<?php
require_once('../../../BD/conexion.php');
$admin = $_SESSION['admin'];

$admin_id = $admin['id'];

$libros = "SELECT b.imagen,b.id,b.titulo_libro,b.descripcion,b.contenido,b.fecha_publicacion,c.nombre_categoria
                        FROM books b
                        JOIN categories c
                        ON b.categoria_id = c.id
                        ORDER BY id ASC;";
$result = $mysqli->query($libros);