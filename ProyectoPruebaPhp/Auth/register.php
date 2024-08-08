<?php
session_start();
require_once('../BD/conexion.php');

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];
$pass = $_POST['password'];
$ciudad = $_POST['ciudad_id'];

echo $nombre . ' ' . $apellido . ' ' . $email . ' ' . $pass . ' ' . $ciudad;
