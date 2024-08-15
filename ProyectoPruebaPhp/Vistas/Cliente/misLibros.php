<?php
include('../Layouts/menu_cliente.php');
include('../../BD/conexion.php');
include('../../Controladores/Cliente/misLibros.php');
?>
<h3 class="text-center fst-italic fw-bold mt-3 mb-3">Libros que he prestado</h3>
<div class="container">
    <div class="row mx-auto mt-4 justify-content-center align-items-center">
        <?php
        while ($row = $result->fetch_assoc()) {
            echo '<div class="col-lg-6">';
            echo '<div class="col-xl-12 shadow-lg p-4 mb-5 mx-2 h-50 mw-100">';
            echo '<div class="card-body m-3 d-flex">';
            echo '<img class="img-top img-fluid mb-3 mx-auto d-block rounded" src="../../Recursos/img/portadaLibros/' . ($row['imagen']) . '" alt="Card image cap">';
            echo '<div class="card-body mx-4">';
            echo '<h5 class="card-title fst-italic fw-bold">' . ($row['titulo_libro']) . '</h5>';
            echo '<p class="card-text">' . ($row['descripcion']) . '</p>';
            echo '<p class="card-text"><small class="text-muted fst-italic"><strong>Categoria: ' . ($row['nombre_categoria']) . '</strong></small></p>';
            echo '<p class="card-text"><small class="text-muted fst-italic fw-bold"><strong>Fecha de prestamo: ' . ($row['fecha_prestamo']) . '</strong></small></p>';
            echo '<form action="../../Controladores/Cliente/devolverLibro.php/libro_id='.$row['id'].'" method="POST">';
            echo '<button type="submit" name="libroId" value='.$row['id'].' class="btn btn-success waves-effect waves-light w-sm fst-italic fw-bold">';
            echo '<i class="mdi mdi-pencil d-block font-size-16"></i> Devolver';
            echo '</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
        ?>
    </div>
</div>
<?php include('../Layouts/modal.php')?>