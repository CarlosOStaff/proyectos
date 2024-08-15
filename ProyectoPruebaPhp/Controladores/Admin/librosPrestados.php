<?php
$libros_prestados = "SELECT count(id) AS total FROM loans";
$result=$mysqli->query($libros_prestados);
$row = $result->fetch_assoc();