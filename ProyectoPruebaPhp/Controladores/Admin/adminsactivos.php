<?php
require_once __DIR__ . '/../../BD/conexion.php';
$userID = $_SESSION['admin'];
$userID = $userID['id'];

$query = "SELECT  u.img_perfil,u.id,u.nombre,
                        u.apellido,u.email_verified_at,u.email
                        FROM users u
                        JOIN cities c
                        ON u.ciudad_id = c.id
                        WHERE rol_id = 1
                        AND u.id != '$userID'";
$result = $mysqli->query($query);
