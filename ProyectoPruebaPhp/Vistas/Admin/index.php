<?php
include('../Layouts/menu_admin.php');
include('../../BD/conexion.php');

if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../Auth/login.php');
    exit();
}
$user = $_SESSION['admin'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <h1 class="text-center fst-italic pt-5 m-5">Bienvenido <?php echo $user['nombre'] ?></h1>
    <div class="container">
        <div class="row mx-auto mt-4 justify-content-center align-items-center">

            <div class="col-md-3 shadow-lg p-4 mb-5 bg-body rounded">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-center h3 text-dark fst-italic">Usuarios activos</p>
                            <?php
                            include('../../Controladores/Admin/usauriosActivos.php');
                            echo '<h4 class="mb-2 text-center h1 fst-italic">' . $row['total_activos'] . '</h4>';
                            ?>
                            <a href="usuariosActivos\usuariosActivos.php"
                                class="btn btn-primary waves-effect waves-light btn-sm d-flex justify-content-center fst-italic fw-bold mt-4">Ver
                                más</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-center h3 text-dark fst-italic">Libros</p>
                            <?php
                            include('../../Controladores/Admin/libros.php');
                            echo '<h4 class="mb-2 text-center h1 fst-italic">' . $row['total'] . '</h4>';
                            ?>
                            <a href="Libros/libros.php"
                                class="btn btn-primary waves-effect waves-light btn-sm d-flex justify-content-center fst-italic fw-bold mt-4">Ver
                                más</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="card-body">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <p class="text-center h3 text-dark fst-italic">Libros prestados</p>
                            <?php
                            include('../../Controladores/Admin/librosPrestados.php');
                            echo '<h4 class="mb-2 text-center h1 fst-italic">' . $row['total'] . '</h4>';
                            ?>
                            <a href="Libros/librosprestados.php"
                                class="btn btn-primary waves-effect waves-light btn-sm d-flex justify-content-center font-size-15 fw-bold mt-4">Ver
                                más</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row mx-auto mt-4 justify-content-center align-items-center">
            <h3 class="text-center fst-italic fw-bold mb-3">Opciones de administrador</h3>
            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="text-center">
                    <div class="card-body">
                        <div class="avatar-lg mx-auto mb-4">
                            <i class="fas fa-user fa-3x"></i>
                        </div>
                        <h5 class="mb-1"><a href="Admins/nuevoAdministrador.php" class="text-dark fst-italic">Nuevo
                                Administrador</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="text-center">
                    <div class="card-body">
                        <div class="avatar-lg mx-auto mb-4">
                            <i class="fas fa-users fa-3x"></i>
                            </span>
                        </div>
                        <h5 class="font-size-15 mb-1"><a href="Admins/admisActivos.php"
                                class="text-dark fst-italic">Administradores
                                activos</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="text-center">
                    <div class="card-body">
                        <div class="avatar-lg mx-auto mb-4">
                            <i class="fas fa-book fa-3x"></i>
                            </span>
                        </div>
                        <h5 class="font-size-15 mb-1"><a href="#"
                                class="text-dark fst-italic">Nuevo
                                libro</a></h5>
                    </div>
                </div>
            </div>

            <div class="col-md-3 shadow-lg p-4 mb-5 mx-4">
                <div class="text-center">
                    <div class="card-body">
                        <div class="avatar-lg mx-auto mb-4">
                            <i class="fas fa-chart-pie fa-3x"></i>
                            </span>
                        </div>
                        <h5 class="font-size-15 mb-1"><a href="#" class="text-dark fst-italic">Estadisticas</a>
                        </h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>