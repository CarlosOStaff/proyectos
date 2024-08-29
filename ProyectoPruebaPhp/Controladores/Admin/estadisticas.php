<?php

$query = "SELECT c.nombre_categoria, 
                    COUNT(b.id) 
                    as total_libros 
                    FROM categories c 
                    LEFT JOIN books b 
                    ON c.id = b.categoria_id 
                    GROUP BY c.nombre_categoria";
$result = $mysqli->query($query);
