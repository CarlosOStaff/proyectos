<?php
session_start();
$sessionId = $_SESSION['session_id'];
$_SESSION = array();
session_destroy();
header("Location: ../Vistas/Home/index.php");
exit();
