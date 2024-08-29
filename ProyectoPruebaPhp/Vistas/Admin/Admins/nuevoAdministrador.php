<?php
require_once '../../../BD/conexion.php';

include '../../Layouts/menu_admin.php';
include '../../../Controladores/Catalogos/ciudades.php';

if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesión';
    header('Location: ../../../Auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Administrador</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../../Css/modal.css">
</head>

<body>
    <div class="container pb-5">
        <h2 class="card-title text-center pt-5 fst-italic m-5">Nuevo Administrador</h2>
        <div class="row mx-auto justify-content-center">
            <div class="col-xl-6 p-5 pt-2 rounded-5 bg-white">
                <div class="">
                    <form action="../../../Controladores/Admin/nuevoadmin.php" enctype="multipart/form-data" method="POST" id="frm" onsubmit="return validarPasswords()">
                        <div class="row">
                            <div class="col-sm-3 text-center">
                                <!-- Vista previa de la nueva imagen -->
                                <img id="img-preview" class="img-fluid rounded mt-2 mb-4 mx-auto"
                                    src="../../../Recursos/img/users/perfil/default_img.png" alt="Vista previa de la nueva imagen"
                                    style="display: block; max-height: 200px;">
                            </div>
                            <div class="col-sm-9">
                                <label for="img_perfil" class="col-form-label fst-italic fw-bold mt-3">Selecciona una imagen de perfil</label>
                                <input class="form-control" id="img_perfil" required name="img_perfil" type="file" onchange="previewImage()">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <label for="horizontal-firstname-input-nombre" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Nombre:</label>
                            <div class="col-sm-9">
                                <input type="text" name="nombre" required class="form-control" id="horizontal-firstname-input-nombre" placeholder="Enter Your ">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-firstname-input-apellido" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Apellido:</label>
                            <div class="col-sm-9">
                                <input type="text" name="apellido" required class="form-control" id="horizontal-firstname-input-apellido" placeholder="Enter Your ">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="horizontal-email-input" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" name="email" required class="form-control" id="horizontal-email-input" placeholder="Enter Your Email ID">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="password" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="password" required class="form-control" id="password" placeholder="Enter Your Password">
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="confirmar_password" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Validar Password:</label>
                            <div class="col-sm-9">
                                <input type="password" name="confirmar_password" required class="form-control mt-3" id="confirmar_password" placeholder="Enter Your Password">
                                <div id="error_confirmar_password" style="color: red; display: none;">Las contraseñas no coinciden.</div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <label for="ciudad_id" class="col-sm-3 col-form-label text-center fst-italic fw-bold">Ciudades:</label>
                            <div class="col-sm-9">
                                <select name="ciudad_id" id="ciudad_id" required class="form-select">
                                    <option value="">Selecciona una ciudad</option>
                                    <?php while ($row = $result->fetch_assoc()): ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['nombre_ciudad'] ?></option>;
                                    <?php endwhile ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                <button type="submit" class="btn btn-primary w-md fst-italic fw-bold">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    <?php include '../../Layouts/modal.php'; ?>

    <script defer type="text/javascript">
        function validarPasswords() {
            var pass = document.getElementById("password").value;
            var repass = document.getElementById("confirmar_password").value;

            if (pass !== repass) {
                alert("Las contraseñas no coinciden");
                return false; // Evita el envío del formulario
            }
            return true; // Permite el envío del formulario
        }

        document.getElementById("frm").onsubmit = function() {
            return validarPasswords();
        };
    </script>

    <script>
        function previewImage() {
            const file = document.getElementById('img_perfil').files[0];
            const imgPreview = document.getElementById('img-preview');

            if (file) {
                const reader = new FileReader();

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                    imgPreview.style.display = 'block';
                };

                reader.readAsDataURL(file);
            } else {
                imgPreview.src = '../../../Recursos/img/users/perfil/default_img.png'; // Vuelve a la imagen por defecto si no se selecciona ninguna
                imgPreview.style.display = 'block';
            }
        }
    </script>

</body>
<?php include '../../Layouts/footer.php'; ?>

</html>