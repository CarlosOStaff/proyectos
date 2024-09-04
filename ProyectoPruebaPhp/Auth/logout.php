<?php
session_start();
$sessionId = $_SESSION['session_id'];
$_SESSION = array();
session_destroy();
header("Location: http://proyectos.test/ProyectoPruebaPhp/Vistas/Home/index.php");
exit();
