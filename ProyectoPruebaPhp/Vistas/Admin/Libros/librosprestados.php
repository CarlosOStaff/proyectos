<?php
include('../../Layouts/menu_admin.php');
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
</head>

<body>
    <div class="container p-5">
        <h2 class="card-title text-center mt-4 fst-italic">Libros que se han prestado</h2>
        <div class="row mx-auto mt-4 justify-content-center align-items-center">
            <?php include('../../../Controladores/Admin/libros/librosprestados.php');
            while ($row = $result->fetch_assoc()):
            ?>
            <div class="col-lg-6">
                <div class="col-xl-12 shadow-lg p-3 mb-5 h-50 mw-100">
                    <div class="card-body m-2 d-flex">
                        <img class="img-top img-fluid mb-3 mx-auto d-block rounded img-fluid mw-100 w-100 h.auto"
                            src="../../../Recursos/img/portadaLibros/<?php echo $row['imagen']?>" alt="Card image cap">
                        <div class="card-body mx-2">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['titulo_libro'] ?></h5>
                                <p class="card-text"><?php echo $row['descripcion']?></p>
                                <strong><span>Fecha de prestamo: <?php echo $row['fecha_prestamo']?></span></strong>
                                <strong><span>Categoria: <?php echo $row['nombre_categoria']?></span></strong>
                                <p class="">Usuario que presto el libro: <strong><?php echo $row['nombre_del_usuario']?></strong></p>
                            </div>
                        </div>
                        <!-- end card -->
                    </div>
                    <br>
                </div>
            </div>
            <?php endwhile ?>
            <!-- end col -->
        </div>
    </div>
</body>

</html>