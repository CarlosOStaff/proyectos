<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'prueba', 3306);
if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
