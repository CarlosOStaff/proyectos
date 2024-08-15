<?php
$usuarios_activos = "SELECT count(id) AS total_activos FROM users WHERE rol_id = 2 
                        AND email_verified_at IS NOT NULL";
$result = $mysqli->query($usuarios_activos);
$row = $result->fetch_assoc();