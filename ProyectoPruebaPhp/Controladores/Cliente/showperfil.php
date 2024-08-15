<?php
$session = $_SESSION['cliente'];
$session = intval($session['id']);
$user = "SELECT * FROM users WHERE id = '$session'";
$result = $mysqli->query($user);
$user = $result->fetch_assoc();