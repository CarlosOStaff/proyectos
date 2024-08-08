<?php
session_start();

// Verificar si la sesión está vacía
if (!isset($_SESSION['admin']) && !isset($_SESSION['cliente'])) {
    echo "La sesión se ha cerrado correctamente.";
} else {
    echo "La sesión no se ha cerrado correctamente.";
}
