<?php
include '../../Layouts/menu_admin.php';
require_once '../../../BD/conexion.php';
if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../../../Auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Css/modal.css">
    <link rel="stylesheet" href="../../../Css/cssAdmin/usuariosactivos.css">
</head>

<body>
    <div class="container">
        <h2 class=" p-5 text-center fst-italic m-5" data-shadow-text="Bienvenido, aqui puedes visualizar los usuarios activos">Bienvenido, aqui puedes visualizar los usuarios activos</h42>
            <div class="row mx-auto mt-4 justify-content-center align-items-center">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-middle table-nowrap mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="align-middle h5">Id</th>
                                            <th class="align-middle h5">img</th>
                                            <th class="align-middle h5">Nombre</th>
                                            <th class="align-middle h5">Apellido</th>
                                            <th class="align-middle h5">Ciudad</th>
                                            <th class="align-middle h5">Emial</th>
                                            <th class="align-middle h5"></th>
                                        </tr>
                                    </thead>
                                    <?php
                                    include('../../../Controladores/Admin/UsuariosActivos/usuariosactivos.php');
                                    while ($row = $result->fetch_assoc()): ?>
                                        <tbody>
                                            <tr>
                                                <td class="h6"><h4><?php echo $row['user_id'] ?></h4></td>
                                                <td class="h6">
                                                    <img src="../../../Recursos/img/users/perfil/<?php echo $row['img_perfil'] ?>" alt="Imagen de perfil"
                                                        class="profile-img mw-50 mh-50 w-100 h-100 rounded-circle">
                                                </td>
                                                <td class="h6"><h4><?php echo $row['nombre'] ?></h4></td>
                                                <td class="h6"><h4>
                                                    <?php echo $row['apellido'] ?> </h4></td>
                                                <td class="h6">
                                                <h4><?php echo $row['nombre_ciudad'] ?></h4>
                                                </td>
                                                <td class="h6"><h4>
                                                    <?php echo $row['email'] ?></h4>
                                                </td>
                                                <td>
                                                    <form action="../../../Controladores/Admin/UsuariosActivos/eliminarusuario.php" method="post">
                                                        <button name="user_id" value="<?php echo $row['user_id'] ?>" type="submit" 
                                                        class="btn btn-outline-danger waves-effect waves-light d-flex">
                                                            <i class="fas fa-trash mt-1 mx-1"></i> Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        </tbody>
                                    <?php endwhile; ?>
                                </table>
                            </div>
                            <!-- end table-responsive -->
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <?php include '../../Layouts/modal.php'; ?>

</body>
<?php include '../../Layouts/footer.php'; ?>
</html>
