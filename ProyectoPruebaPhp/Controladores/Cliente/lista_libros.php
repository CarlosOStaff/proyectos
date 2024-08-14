<?php

$user = $_SESSION['cliente'];
$user = $user['id'];
$query = "SELECT b.id, b.imagen, b.titulo_libro, b.descripcion, b.categoria_id, c.nombre_categoria
FROM books b
JOIN categories c ON b.categoria_id = c.id
WHERE b.id NOT IN (
    SELECT b.id
    FROM loans l
    JOIN books b ON l.libro_id = b.id
    WHERE l.user_id = $user
)
ORDER BY b.id";
$result = $mysqli->query($query);