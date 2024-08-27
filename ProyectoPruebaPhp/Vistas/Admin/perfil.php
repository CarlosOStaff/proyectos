<?php
include '../Layouts/menu_admin.php';
require_once '../../BD/conexion.php';
include '../../Controladores/Admin/perfilAdmin/perfil.php';
include '../../Controladores/Catalogos/ciudades.php';
if (!isset($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../../Css/modal.css">

</head>
<body>
<div class="container">
    <div class="row mx-auto  justify-content-center align-items-center">
        <div class="col-lg-12">
            <h2 class="card-title pt-5 text-center fst-italic m-5">Información personal</h2>
            <div class="card-body col-md-10 mx-auto">
                <form action="../../Controladores/Admin/perfilAdmin/actualizarperfil.php" method="POST" enctype="multipart/form-data">
                    <div class="shadow-lg p-4 rounded-5">
                        <table class="table mb-0 align-items-center table-borderless">
                            <tbody>
                                <?php while ($row = $result_perfil->fetch_assoc()): ?>
                                    <tr>
                                        <th scope="row" class="text-end">Elije una imagen de perfil</th>
                                        <td>
                                            <!-- Imagen actual -->
                                            <?php if ($row['img_perfil']): ?>
                                                <img id="current-img"
                                                    class="img-fluid rounded mt-2 mb-4 mx-auto mh-100 h-50 w-25"
                                                    src="../../Recursos/img/users/perfil/<?php echo $row['img_perfil'] ?>"
                                                    alt="Imagen actual de perfil">
                                            <?php endif ?>
                                            <!-- Vista previa de la nueva imagen -->
                                            <img id="img-preview"
                                                class="img-fluid rounded mt-2 mb-4 mx-auto mh-100 h-50 w-25" src=""
                                                alt="Vista previa de la nueva imagen" style="display: none;">
                                            <input class="form-control" id="img_perfil" name="img_perfil" type="file"
                                                onchange="previewImage()">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">Nombre :</th>
                                        <td>
                                            <input class="form-control" name="nombre" type="text"
                                                value="<?php echo $row['nombre'] ?>" id="example-text-input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">Apellido :</th>
                                        <td>
                                            <input class="form-control" name="apellido" type="text"
                                                value="<?php echo $row['apellido'] ?>" id="example-text-input">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">Ciudad :</th>
                                        <td>
                                            <select name="ciudad_id" class="form-select">
                                                <option value="<?php echo $row['ciudad_id'] ?>"><?php echo $row['nombre_ciudad'] ?></option>
                                                <?php while ($ciudad = $result->fetch_assoc()): ?>
                                                    <option value="<?php echo $ciudad['id'] ?>"><?php echo $ciudad['nombre_ciudad'] ?></option>
                                                <?php endwhile ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="text-end">E-mail :</th>
                                        <td>
                                            <input class="form-control" name="email" type="text" value="<?php echo $row['email'] ?>"
                                                id="example-text-input">
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                                <tr>
                                    <th scope="row" class="text-end"></th>
                                    <td>
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
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="text-center">
                                        <button type="submit" class="btn btn-success waves-effect waves-light">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include '../Layouts/modal.php'; ?>

<?php include '../Layouts/footer.php'; ?>
<script>
    function previewImage() {
        const file = document.getElementById('img_perfil').files[0];
        const imgPreview = document.getElementById('img-preview');
        const currentImg = document.getElementById('current-img');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(event) {
                imgPreview.src = event.target.result;
                imgPreview.style.display = 'block';
                if (currentImg) {
                    currentImg.style.display = 'none';
                }
            };

            reader.readAsDataURL(file);
        } else {
            imgPreview.src = '';
            imgPreview.style.display = 'none';
            if (currentImg) {
                currentImg.style.display = 'block';
            }
        }
    }
</script>
</body>
</html>
