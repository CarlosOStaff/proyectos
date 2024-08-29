<?php
include '../../BD/conexion.php';
include '../Layouts/menu_cliente.php';
include '../../Controladores/Cliente/misLibros.php';
if (!isset($_SESSION['cliente'])) {
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
    <link rel="stylesheet" href="../Layouts/modal.php">
</head>

<body>
    <h3 class="text-center fst-italic fw-bold mt-3 mb-3">Libros que he prestado</h3>
    <div class="container">
        <div class="row mx-auto mt-4 justify-content-center align-items-center">
            <?php
            while ($row = $result->fetch_assoc()): ?>
                <div class="col-lg-6">
                    <div class="col-xl-12 shadow-lg p-3 mb-5 h-50 mw-100 w-100">
                        <div class="card-body m-2 d-flex">
                            <img class="img-top img-fluid mb-3 mx-auto d-block rounded" src="../../Recursos/img/portadaLibros/<?php echo $row['imagen'] ?>" alt="Card image cap">
                            <div class="card-body mx-2">
                                <div class="card-body p-2">
                                    <h5 class="card-title fst-italic fw-bold"><?php echo $row['titulo_libro'] ?></h5>
                                    <p class="card-text"><?php echo $row['descripcion'] ?></p>
                                    <p class="card-text"><small class="text-muted fst-italic"><strong>Categoria: <?php echo $row['nombre_categoria'] ?></strong></small></p>
                                    <p class="card-text"><small class="text-muted fst-italic fw-bold"><strong>Fecha de prestamo: <?php echo $row['fecha_prestamo'] ?></strong></small></p>
                                    <form action="../../Controladores/Cliente/devolverLibro.php/libro_id=<?php echo $row['id'] ?>" method="POST">
                                        <button type="submit" name="libroId" value=' <?php echo $row['id'] ?> ' class="btn btn-success waves-effect waves-light w-sm fst-italic fw-bold">
                                            <i class="mdi mdi-pencil d-block font-size-16"></i> Devolver
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endwhile ?>
        </div>
    </div>
    <?php include '../Layouts/modal.php' ?>
</body>
<?php include '../Layouts/footer.php'; ?>

</html>