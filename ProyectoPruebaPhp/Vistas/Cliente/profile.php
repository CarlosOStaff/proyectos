<?php
include('../Layouts/menu_cliente.php');
require_once('../../BD/conexion.php'); 

$user = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto - Librería PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="row mt-0" style="display: flex; justify-content: center; padding-top: 3vw;">
        <div class="col-xl-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4 fst-italic fw-bold">Mis datos</h4>
                    <form action="update_user.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-firstname-input" class="form-label fst-italic fw-bold">
                                        Selecciona una imagen de perfil
                                    </label>
                                    <!-- Vista previa de la imagen actual -->
                                    <?php if (!empty($user['img_perfil'])): ?>
                                        <img id="current-img" class="img-fluid rounded mt-2 mb-4 mx-auto mh-100 h-50 w-25"
                                            src="/img/users/perfil/<?php echo htmlspecialchars($user['img_perfil']); ?>"
                                            alt="Imagen actual de perfil">
                                    <?php else: ?>
                                        <p>No hay imagen de perfil</p>
                                    <?php endif; ?>
                                    <!-- Vista previa de la nueva imagen -->
                                    <img id="img-preview" class="img-fluid rounded mt-2 mb-4 mx-auto mh-100 h-50 w-25"
                                        src="" alt="Vista previa de la nueva imagen" style="display: none;">
                                    <input class="form-control" id="img_perfil" name="img_perfil" type="file" onchange="previewImage()">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-firstname-input" class="form-label fst-italic fw-bold">Nombre(s)</label>
                                        <input type="text" name="nombre" class="form-control" id="formrow-firstname-input"
                                            placeholder="Mario" value="<?php echo htmlspecialchars($user['nombre']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-lastname-input" class="form-label fst-italic fw-bold">Apellidos</label>
                                        <input type="text" name="apellido" class="form-control" id="formrow-lastname-input"
                                            placeholder="Perez" value="<?php echo htmlspecialchars($user['apellido']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-email-input" class="form-label fst-italic fw-bold">Email</label>
                                        <input type="email" class="form-control" name="email" id="formrow-email-input"
                                            placeholder="Enter Your Email ID" value="<?php echo htmlspecialchars($user['email']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputCity" class="form-label fst-italic fw-bold">Ciudad</label>
                                        <select id="formrow-inputCity" name="ciudad_id" class="form-select">
                                            <option selected value="">Seleccionar...</option>
                                            <?php
                                            include ('../../Controladores/Catalogos/ciudades.php');
                                            if ($result) {
                                                while ($row = $result->fetch_assoc()) {
                                                    echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre_ciudad']) . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label fst-italic fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control" id="formrow-password-input" placeholder="Enter Your Password">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="confirmar_password" class="form-label fst-italic fw-bold">Confirmar Password</label>
                                        <input type="password" name="confirmar_password" id="confirmar_password" class="form-control" placeholder="Ingresa tu contraseña">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md fst-italic fw-bold">
                                    <i class="fas fa-save"></i> Guardar
                                </button>
                            </div>
                    </form>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
    </div>
    </div>

    <script>
        function previewImage() {
            const file = document.getElementById('img_perfil').files[0];
            const preview = document.getElementById('img-preview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>