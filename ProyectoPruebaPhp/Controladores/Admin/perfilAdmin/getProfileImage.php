<?php
session_start();
require_once '../../../BD/conexion.php';
header('Content-Type: application/json');

// Verifica si el usuario está autenticado
if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    $userId = $user['id'];
    $img = "SELECT img_perfil FROM users WHERE id = '$userId'";
    $result = $mysqli->query($img);
    $row = $result->fetch_assoc();
    // Asegúrate de que 'img_perfil' sea una clave válida en el array de sesión
    if (isset($row['img_perfil'])) {
        echo json_encode([
            'img_perfil' => $row['img_perfil']
        ]);
    } else {
        echo json_encode([
            'img_perfil' => 'default.jpg' // Valor por defecto si no se encuentra la imagen
        ]);
    }
} else {
    echo json_encode([
        'img_perfil' => 'default.jpg' // Valor por defecto si el usuario no está autenticado
    ]);
}
