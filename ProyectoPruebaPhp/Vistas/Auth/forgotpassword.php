<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Recuperar Contraseña - Librería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../Css/modal.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4 rounded-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Recuperar Contraseña</h4>
                        <p class="text-center mb-4">Introduce tu correo electrónico para recibir instrucciones sobre cómo recuperar tu contraseña.</p>
                        <form action="../../Auth/forgotpassword.php" method="POST">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="emailInput" name="email" required placeholder="Tu correo electrónico">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            </div>
                        </form>
                        <div class="text-center mt-3">
                            <a href="login.php">Volver al inicio de sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include('../Layouts/modal.php');
    ?>
</body>

</html>