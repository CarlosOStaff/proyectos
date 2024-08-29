<?php
include '../Layouts/menu_cliente.php';
require_once '../../BD/conexion.php';
include('../../Controladores/Cliente/showperfil.php');
if (!isset($_SESSION['cliente'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../Auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proyecto - Librería PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Include FontAwesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4 mb-4">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4 fst-italic fw-bold">Mis datos</h4>
                        <form action="../../Controladores/Cliente/editarPerfil.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="img_perfil" class="form-label fst-italic fw-bold">
                                    Selecciona una imagen de perfil
                                </label>
                                <!-- Vista previa de la imagen actual -->
                                <?php if (!empty($user['img_perfil'])): ?>
                                    <img id="current-img" class="img-fluid rounded mt-2 mb-4 mx-auto h-50 w-25"
                                        src="../../Recursos/img/users/perfil/<?php echo htmlspecialchars($user['img_perfil']); ?>"
                                        alt="Imagen actual de perfil">
                                <?php else: ?>
                                    <p>No hay imagen de perfil</p>
                                <?php endif; ?>
                                <!-- Vista previa de la nueva imagen -->
                                <img id="img-preview" class="img-fluid rounded mt-2 mb-4 mx-auto h-50 w-25"
                                    src="" alt="Vista previa de la nueva imagen" style="display: none;">
                                <input class="form-control" id="img_perfil" name="img_perfil" type="file"
                                    onchange="previewImage()">
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombre" class="form-label fst-italic fw-bold">Nombre(s)</label>
                                        <input type="text" name="nombre" class="form-control" id="nombre"
                                            placeholder="Mario" value="<?php echo htmlspecialchars($user['nombre']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="apellido" class="form-label fst-italic fw-bold">Apellidos</label>
                                        <input type="text" name="apellido" class="form-control" id="apellido"
                                            placeholder="Perez" value="<?php echo htmlspecialchars($user['apellido']); ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label fst-italic fw-bold">Email</label>
                                        <input type="email" name="email" class="form-control" id="email"
                                            placeholder="Enter Your Email ID" value="<?php echo htmlspecialchars($user['email']); ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="ciudad_id" class="form-label fst-italic fw-bold">Ciudad</label>
                                        <select id="ciudad_id" name="ciudad_id" class="form-select">
                                            <option value="">Seleccionar...</option>
                                            <?php
                                            include('../../Controladores/Catalogos/ciudades.php');
                                            if ($result) {
                                                while ($row = $result->fetch_assoc()) {
                                                    $selected = ($user['ciudad_id'] == $row['id']) ? 'selected' : '';
                                                    echo '<option value="' . htmlspecialchars($row['id']) . '" ' . $selected . '>' . htmlspecialchars($row['nombre_ciudad']) . '</option>';
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
                                        <label for="password" class="form-label fst-italic fw-bold">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your Password">
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
            const currentImg = document.getElementById('current-img');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Hide the current image if a new file is selected
                    if (currentImg) {
                        currentImg.style.display = 'none';
                    }
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                if (currentImg) {
                    currentImg.style.display = 'block';
                }
            }
        }
    </script>
</body>
<?php include '../Layouts/modal.php'; ?>
<?php include '../Layouts/footer.php'; ?>
</html>