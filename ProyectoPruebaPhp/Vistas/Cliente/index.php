<?php
include '../Layouts/menu_cliente.php';
include '../../BD/conexion.php';
$name = $_SESSION['cliente'];
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
    <link rel="stylesheet" href="../../Css/cssCliente/index.css">
    <link rel="stylesheet" href="../../Css/car-text.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4 fst-italic elegantshadow">Bienvenido <?php echo $name['nombre'] ?> </h1>
        <div class="row mx-auto mt-4 justify-content-center align-items-center">
            <h3 class="rainbow text-center mb-3 fst-italic">Visualiza nuestro catálogo de libros disponibles</h3>
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered table-dark">
                        <thead>
                            <tr>
                                <th scope="col" class="fs-5 text-center">#</th>
                                <th scope="col" class="fs-5 text-center">Portada</th>
                                <th scope="col" class="fs-5 text-center w-25">Título del libro</th>
                                <th scope="col" class="fs-5 text-center">Descripción</th>
                                <th scope="col" class="fs-5 text-center">Categoría</th>
                                <th scope="col" class="fs-5 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            <?php
                            include('../../Controladores/Cliente/lista_libros.php');
                            if ($result): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>

                                    <tr>
                                        <td class="fs-4" name="libro"><?php echo $row['id'] ?></td>
                                        <td><img src="../../Recursos/img/portadaLibros/<?php echo $row['imagen'] ?>" alt="" class="img-fluid mw-100 w-100 h-auto"></td>
                                        <td class="fs-5">
                                            <div class="d-flex justify-content-center align-items-center h-100 my-5" style=""><?php echo $row['titulo_libro'] ?></div>
                                        </td>
                                        <td class="fs-5 card-body">
                                            <p class="card-text"><?php echo $row['descripcion'] ?></p>
                                        </td>
                                        <td class="fs-5">
                                            <div class="d-flex justify-content-center align-items-center h-100 my-5" style=""><?php echo $row['nombre_categoria'] ?></div>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center align-items-center h-100 my-5">
                                                <form action="../../Controladores/Cliente/prestarLibro.php/libro=<?php echo $row['id'] ?>" method="POST">
                                                    <button type="submit" class="btn btn-success w-100" name="libroId" value="<?php echo $row['id'] ?>" aria-label="Prestar libro" title="Prestar libro">
                                                        <i class="fas fa-book"></i> Pedir Prestado
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
                            <?php endif ?>
                        </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-center mt-3 pager" id="myPager"></ul>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../../Js/paginacion.js"></script>
</body>
<?php
include '../Layouts/modal.php';
include '../Layouts/footer.php';
?>

</html>