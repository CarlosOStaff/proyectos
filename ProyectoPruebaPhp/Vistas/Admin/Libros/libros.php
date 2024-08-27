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
    <link rel="stylesheet" href="../../../Css/libropreview.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
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
                                <p class="card-text"><?php echo $row['descripcion'] ?></p>
                                <strong><span class="fst-italic">Fecha de publicacion:
                                        <?php echo $row['fecha_publicacion'] ?></span></strong>
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
                                    <button type="button" onclick="openModal(<?php echo $row['id']; ?>)" class="btn-preview mt-3 mx-2 fw-bold fst-italic btn btn-success waves-effect waves-light">
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
            <div class="modal fade" id="bookModal" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="bookModalLabel">Detalles del Libro</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="fw-bold fst-italic">Titulo del libro</label>
                            <h5 id="modalBookTitle"></h5>
                            <label class="fw-bold fst-italic">Contenido</label>
                            <p id="modalBookContenido"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                function openModal(bookId) {
                    // Realizar una solicitud para obtener los detalles del libro
                    fetch(`../../../Controladores/Admin/libros/getBookDetails.php?id=${bookId}`)
                        .then(response => response.json())
                        .then(data => {
                            // Actualizar el contenido del modal
                            document.getElementById('modalBookTitle').textContent = data.title;
                            document.getElementById('modalBookContenido').textContent = data.content;

                            // Mostrar el modal usando Bootstrap
                            var myModal = new bootstrap.Modal(document.getElementById('bookModal'));
                            myModal.show();
                        })
                        .catch(error => console.error('Error fetching book details:', error));
                }
            </script>


        </div>
    </div>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <?php include('../../Layouts/footer.php'); ?>
</body>

</html>