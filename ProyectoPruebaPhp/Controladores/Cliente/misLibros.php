<?php
if (isset($_SESSION['cliente'])) {
    $user = $_SESSION['cliente'];
    if (isset($user['id'])) {
        $userId = $user['id'];
        $query = "SELECT s.id, s.libro_id, s.fecha_prestamo, b.imagen, b.id,
                            b.titulo_libro, b.descripcion, ct.nombre_categoria 
                            FROM loans s 
                            JOIN books b ON s.libro_id = b.id 
                            JOIN categories ct ON b.categoria_id = ct.id 
                            WHERE s.user_id = '$userId'
                            ORDER BY b.id;";
        $result = $mysqli->query($query);
    } else {
        echo "El ID del usuario no está disponible.";
    }
} else {
    echo "La sesión del cliente no está iniciada.";
}
