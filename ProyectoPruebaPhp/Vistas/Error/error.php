<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>

<body>
    <h1>Error</h1>
    <?php
    if (isset($_SESSION['message'])) {
        echo '<p>' . htmlspecialchars($_SESSION['message']) . '</p>';
        // Limpiar el mensaje después de mostrarlo
        unset($_SESSION['message']);
    }
    ?>
    <a href="..\index.php">Volver a intentar</a>
</body>

</html>