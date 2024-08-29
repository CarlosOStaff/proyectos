<?php
session_start();
require_once '../../../BD/conexion.php';
header('Content-Type: application/json');

if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    $userId = $user['id'];
    $img = "SELECT img_perfil FROM users WHERE id = '$userId'";
    $result = $mysqli->query($img);
    $row = $result->fetch_assoc();
    if (isset($row['img_perfil'])) {
        echo json_encode([
            'img_perfil' => $row['img_perfil']
        ]);
    } else {
        echo json_encode([
            'img_perfil' => 'default.jpg'
        ]);
    }
} else {
    echo json_encode([
        'img_perfil' => 'default.jpg'
    ]);
}
