<?php
    $user=$_SESSION['cliente'];
    $user = $user['id'];
    $query = "SELECT s.id,s.libro_id,s.fecha_prestamo,b.imagen,b.id,
                            b.titulo_libro,b.descripcion,ct.nombre_categoria 
                            FROM loans s 
                            JOIN books b ON s.libro_id = b.id 
                            JOIN categories ct ON b.categoria_id = ct.id 
                            WHERE s.user_id = '$user'
                            ORDER BY b.id;";
    $result = $mysqli->query($query);
