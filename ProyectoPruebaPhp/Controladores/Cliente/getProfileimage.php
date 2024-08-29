<?php
session_start();
header('Content-Type: application/json');

if (isset($_SESSION['cliente'])) {
    $user = $_SESSION['cliente'];
    if (isset($user['img_perfil'])) {
        echo json_encode(['img_perfil' => $user['img_perfil']]);
    } else {
        echo json_encode(['img_perfil' => 'default.jpg']);
    }
} else {
    echo json_encode(['img_perfil' => 'default.jpg']);
}