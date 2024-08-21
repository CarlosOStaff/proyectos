<?php
require_once('../../../BD/conexion.php');

$libros_prestados = "SELECT l.id,l.libro_id,l.fecha_prestamo,b.imagen,b.id,
                        b.titulo_libro,b.descripcion,ct.nombre_categoria,u.nombre AS nombre_del_usuario 
                        FROM loans l 
                        JOIN books b ON l.libro_id = b.id 
                        JOIN categories ct ON b.categoria_id = ct.id 
                        JOIN users u ON l.user_id = u.id
                        ORDER BY b.id";
$result = $mysqli->query($libros_prestados);