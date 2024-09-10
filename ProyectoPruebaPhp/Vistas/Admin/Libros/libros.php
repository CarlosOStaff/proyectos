<?php
include '../../Layouts/menu_admin.php';
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
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="../../../Css/modal.css">
    <link rel="stylesheet" href="../../../Css/car-text.css">
    <link rel="stylesheet" href="../../../Css/cssAdmin/libros.css">

</head>

<body>
    <div class="container">

        <h2 class="title text-center pt-5 fst-italic m-5">Libros disponibles</h2>

        <div class="row mx-auto mt-4 justify-content-center align-items-center d-flex">
            <?php
            include('../../../Controladores/Admin/libros/libros.php');
            $books = [];
            while ($row = $result->fetch_assoc()):
                $books[] = $row;
            ?>
                <div class="col-lg-6">
                    <div class="cardBody col-xl-12 shadow-lg p-3 mb-5 mx-2 h-50 mw-100">
                        <div class="card-body py-3 d-flex col-10">
                            <img class="img-top img-fluid mb-3 mx-auto d-block rounded img-fluid mw-100 w-100 h-auto"
                                src="../../../Recursos/img/portadaLibros/<?php echo $row['imagen'] ?>" alt="Card image cap">
                            <div class="card-body m-3">
                                <h5 class="card-title fst-italic"><?php echo $row['titulo_libro'] ?></h5>
                                <p class="card-text"><?php echo $row['descripcion'] ?></p>
                                <strong><span class="fst-italic">Fecha de publicacion:
                                        <?php echo $row['fecha_publicacion'] ?></span></strong>
                                <strong><span class="fst-italic">Categoria: <?php echo $row['nombre_categoria'] ?></span></strong>
                                <div class="d-flex">
                                    <form action="editarLibro.php" method="GET" class="mt-3 mx-2">
                                        <button type="submit" name="id" value="<?php echo $row['id'] ?>"
                                            class="fw-bold fst-italic btn btn-outline-success waves-effect waves-light">
                                            <i class="far fa-edit"></i> Editar
                                        </button>
                                    </form>
                                    <form action="../../../Controladores/Admin/libros/eliminarLibro.php" method="POST" class="mt-3 mx-2">
                                        <button type="submit" id="btnEliminar" name="btnEliminar" value="<?php echo $row['id'] ?>"
                                            class="fw-bold fst-italic btn btn-outline-danger waves-effect waves-light">
                                            <i class="far fa-trash-alt"></i> Eliminar
                                        </button>
                                    </form>
                                    <button type="button" value="<?php echo $row['id']; ?>" class="btn-preview mt-3 mx-2 fw-bold fst-italic btn btn-outline-success waves-effect waves-light">
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
        </div>
    </div>
    <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="bookModalLabel">Detalles del Libro</h5>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="fw-bold fst-italic">Titulo del libro</label>
                    <h5 id="modalBookTitle"></h5>
                    <label class="fw-bold fst-italic">Contenido</label>
                    <p id="modalBookContenido"></p>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger fw-bolder" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        var books = <?php echo json_encode($books); ?>;
        $('.btn-preview').click(function() {
            var bookId = $(this).val();
            var selectedBook = books.find(book => book.id == bookId);

            if (selectedBook) {
                $('#modalBookTitle').text(selectedBook.titulo_libro);
                $('#modalBookContenido').text(selectedBook.descripcion);
                $('#bookModal').modal('show');
            }
        });
    </script>
    </div>
    </div>
    <?php include '../../Layouts/modal.php'; ?>

</body>
<?php include '../../Layouts/footer.php'; ?>
</html>