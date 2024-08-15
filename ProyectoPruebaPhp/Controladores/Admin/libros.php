<?php 
$libros = "SELECT count(id) AS total FROM books";
$result = $mysqli->query($libros);
$row = $result->fetch_assoc();