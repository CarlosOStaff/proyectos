<?php
include('../../Layouts/menu_admin.php');
if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../Auth/login.php');
    exit();
}
?>

<div class="container">
<?php include('../../Layouts/modal.php'); ?>

    <h2 class="card-title text-center pt-5 fst-italic m-5">Libros disponibles</h2>

    <div class="row mx-auto mt-4 justify-content-center align-items-center d-flex">
        <?php
        include('../../../Controladores/Admin/libros/libros.php');
        while ($row = $result->fetch_assoc()): ?>
            <div class="col-lg-6">
                <div class="col-xl-12 shadow-lg p-3 mb-5 mx-2 h-50 mw-100">
                    <div class="card-body m-3 d-flex col-4">
                        <img class="img-top img-fluid mb-3 mx-auto d-block rounded img-fluid mw-100 w-100 h.auto"
                            src="../../../Recursos/img/portadaLibros/<?php echo $row['imagen'] ?>" alt="Card image cap">
                        <div class="card-body mx-2">
                            <h5 class="card-title fst-italic"><?php echo $row['titulo_libro'] ?></h5>
                            <p class="card-text"><?php echo $row['descripcion']?></p>
                            <strong><span class="fst-italic">Fecha de publicacion:
                                    <?php echo $row['fecha_publicacion']?></span></strong>
                            <strong><span class="fst-italic">Categoria: <?php echo $row['nombre_categoria'] ?></span></strong>
                            <div class="d-flex">
                                <form action="editarLibro.php" method="GET" class="mt-3 mx-2">
                                    <button type="submit" name="id" value="<?php echo $row['id'] ?>"
                                        class="fw-bold fst-italic btn btn-success waves-effect waves-light">
                                        <i class="far fa-edit"></i> Editar
                                    </button>
                                </form>
                                <form action="../../../Controladores/Admin/libros/eliminarLibro.php" method="POST" class="mt-3 mx-2">
                                    <button type="submit" id="btnEliminar" name="btnEliminar" value="<?php echo $row['id'] ?>"
                                        class="fw-bold fst-italic btn btn-danger waves-effect waves-light">
                                        <i class="far fa-trash-alt"></i> Eliminar
                                    </button>
                                </form>
                                <button type="button" value="<?php $row['id']?>"
                                    class="btn-preview mt-3 mx-2 fw-bold fst-italic btn btn-success waves-effect waves-light">
                                    <i class="far fa-eye"></i> Preview
                                </button>
                            </div>
                            <div>
                            </div>
                        </div>
                    </div>
                    <!-- end card -->
                </div>
            </div>
        <?php endwhile ?>
        <!-- end col -->
    </div>
</div>
<?php include('../../Layouts/footer.php'); ?>
