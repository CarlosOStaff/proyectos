<?php
include '../../Layouts/menu_admin.php';
include '../../../Controladores/Admin/adminsactivos.php';
if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../../Auth/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Css/modal.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center p-5 fst-italic m-5">Lista de administradores activos</h1>
        <div class="row mx-auto justify-content-center align-items-stretch">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col-xl-3 col-sm-6 shadow-lg p-4 mb-5 mx-4">
                    <div class="h-100 text-center">
                        <div class="card-body d-flex flex-column justify-content-between">
                            <img id="current-img" class="img-fluid rounded mt-2 mb-4 mx-auto mh-100 h-50 w-50"
                                src="../../../Recursos/img/users/perfil/<?php echo $row['img_perfil'] ?>" alt="Imagen actual de perfil">
                            <h5 class="h3 mb-1 fst-italic"><a class="text-dark"><?php echo $row['nombre'] ?></a></h5>
                            <p class="text-muted fw-bold d-inline-block text-truncate"><?php echo $row['apellido'] ?></p>
                            <p class="text-muted fw-bold  d-inline-block text-truncate"><?php echo $row['email'] ?></p>
                            <?php if (is_null($row['email_verified_at'])): ?>
                                <a class="text-dark fst-italic">Necesario confirmar cuenta</a>
                            <?php endif ?>
                            <div class="mt-auto">
                                <form action="../../../Controladores/Admin/eliminaradmin.php" method="post">
                                    <button name="user_delete" value="<?php echo $row['id'] ?>" type="submit" class="btn btn-outline-danger waves-effect waves-light mt-3">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile ?>
        </div>
    </div>
    <?php include '../../Layouts/modal.php'; ?>
</body>
<?php include '../../Layouts/footer.php'; ?>
</html>