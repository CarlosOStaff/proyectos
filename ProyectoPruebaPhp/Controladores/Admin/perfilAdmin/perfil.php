<?php
$admin = $_SESSION['admin'];
$admin = $admin['id'];

$query = "SELECT s.img_perfil,s.id, s.nombre, s.apellido, s.ciudad_id, s.email,c.id, c.nombre_ciudad 
        FROM users s JOIN cities c ON s.ciudad_id = c.id WHERE s.id = '$admin'";

$result_perfil = $mysqli->query($query);