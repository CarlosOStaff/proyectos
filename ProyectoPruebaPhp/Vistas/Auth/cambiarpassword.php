<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Cambiar Contraseña - Librería</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../Css/modal.css"> <!-- Asegúrate de que el archivo modal.css esté correctamente configurado -->
</head>

<body>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg p-4 rounded-4">
                    <div class="card-body">
                        <h4 class="card-title mb-4 text-center">Cambiar Contraseña</h4>
                        <p class="text-center mb-4">Introduce tu nueva contraseña y confírmala.</p>

                        <!-- Formulario de cambio de contraseña -->
                        <form action="../../Auth/passwordupdate.php" method="POST" onsubmit="return validarPasswords()" id="frm">
                            <input type="hidden" name="token" value="<?php echo isset($_GET['token']) ? htmlspecialchars($_GET['token']) : ''; ?>">
                            <input type="hidden" name="email" value="<?php echo isset($_GET['email']) ? htmlspecialchars($_GET['email']) : ''; ?>">

                            <div class="mb-3">
                                <label for="newPassword" class="form-label">Nueva Contraseña</label>
                                <input type="password" class="form-control" id="newPassword" name="password" required placeholder="Introduce tu nueva contraseña">
                            </div>

                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirmPassword" name="confirm_password" required placeholder="Confirma tu nueva contraseña">
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary w-100">Cambiar Contraseña</button>
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
    <script>
        function validarPasswords() {
            var pass = document.getElementById("newPassword").value;
            var repass = document.getElementById("confirmPassword").value;

            if (pass !== repass) {
                alert("Las contraseñas no coinciden");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>