<?php
require_once('../../../BD/conexion.php');
$libro = $_GET['id'];

$libro = "SELECT b.id,b.titulo_libro,b.descripcion,
                        b.contenido,b.fecha_publicacion,
                        b.categoria_id,c.nombre_categoria
                        FROM books b
                        JOIN categories c
                        ON b.categoria_id = c.id
                        WHERE b.id = '$libro'";
$result = $mysqli->query($libro);
