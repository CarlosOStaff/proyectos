<?php

$usuarios_activos = "SELECT u.img_perfil,u.id 
                    AS user_id,u.nombre,u.apellido,u.ciudad_id,u.email,c.nombre_ciudad
                    FROM users u
                    JOIN cities c
                    ON u.ciudad_id = c.id
                    WHERE rol_id = 2
                    AND u.email_verified_at IS NOT NULL";
$result = $mysqli->query($usuarios_activos);