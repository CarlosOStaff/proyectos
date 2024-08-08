<?php
$mysqli = new mysqli('127.0.0.1', 'root', '', 'prueba', 3306);
if ($mysqli->connect_error) {
    echo "Fallo al conectar a Mysql: (" . $mysqli->connect_error . ")" . $mysqli->connect_error;
}
