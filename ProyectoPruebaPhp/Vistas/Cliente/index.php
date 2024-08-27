<?php
include('../Layouts/menu_cliente.php');
include('../../BD/conexion.php');
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
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4">Bienvenido <?php echo $name['nombre'] ?> </h1>
        <div class="row mx-auto mt-4 justify-content-center align-items-center">
            <h3 class="text-center mb-3">Visualiza nuestro catálogo de libros disponibles</h3>
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
                            if ($result) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<tr>';
                                    echo '<td class="fs-4" name ="libro">' . $row['id'] . '</td>';
                                    echo '<td class=""><img src="../../Recursos/img/portadaLibros/' . $row['imagen'] . '" alt="" class="img-fluid mw-100 w-100 h-auto"></td>';
                                    echo '<td class="fs-5">' . $row['titulo_libro'] . '</td>';
                                    echo '<td class="fs-5">' . $row['descripcion'] . '</td>';
                                    echo '<td class="fs-5">' . $row['nombre_categoria'] . '</td>';
                                    echo '<td>';
                                    echo '<form action="../../Controladores/Cliente/prestarLibro.php/libro=' . $row['id'] . '" method="POST">';
                                    echo '<button type="submit" class="btn btn-success m-2" name="libroId" value=' . $row['id'] . ' aria-label="Prestar libro" title="Prestar libro">';
                                    echo '<i class="fas fa-book"> Pedir Prestado</i>';
                                    echo '</button>';
                                    echo '</form>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                            }
                            ?> </tbody>
                    </table>
                </div>
                <ul class="pagination justify-content-center mt-3 pager" id="myPager"></ul>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $.fn.pageMe = function(opts) {
            var $this = this,
                defaults = {
                    perPage: 4,
                    showPrevNext: true,
                    hidePageNumbers: false
                },
                settings = $.extend(defaults, opts);

            var listElement = $this;
            var perPage = settings.perPage;
            var children = listElement.children();
            var pager = $('.pager');

            if (typeof settings.childSelector != "undefined") {
                children = listElement.find(settings.childSelector);
            }

            if (typeof settings.pagerSelector != "undefined") {
                pager = $(settings.pagerSelector);
            }

            var numItems = children.length;
            var numPages = Math.ceil(numItems / perPage);

            pager.data("curr", 0);

            if (settings.showPrevNext) {
                $('<li class="page-item"><a href="#" class="page-link prev_link">«</a></li>').appendTo(pager);
            }

            var curr = 0;
            while (numPages > curr && (settings.hidePageNumbers == false)) {
                $('<li class="page-item"><a href="#" class="page-link page_link">' + (curr + 1) + '</a></li>').appendTo(pager);
                curr++;
            }

            if (settings.showPrevNext) {
                $('<li class="page-item"><a href="#" class="page-link next_link">»</a></li>').appendTo(pager);
            }

            pager.find('.page_link:first').addClass('active');
            pager.find('.prev_link').hide();
            if (numPages <= 1) {
                pager.find('.next_link').hide();
            }
            pager.children().eq(1).addClass("active");

            children.hide();
            children.slice(0, perPage).show();

            pager.find('li .page_link').click(function() {
                var clickedPage = $(this).html().valueOf() - 1;
                goTo(clickedPage, perPage);
                return false;
            });
            pager.find('li .prev_link').click(function() {
                previous();
                return false;
            });
            pager.find('li .next_link').click(function() {
                next();
                return false;
            });

            function previous() {
                var goToPage = parseInt(pager.data("curr")) - 1;
                goTo(goToPage);
            }

            function next() {
                goToPage = parseInt(pager.data("curr")) + 1;
                goTo(goToPage);
            }

            function goTo(page) {
                var startAt = page * perPage,
                    endOn = startAt + perPage;

                children.css('display', 'none').slice(startAt, endOn).show();

                if (page >= 1) {
                    pager.find('.prev_link').show();
                } else {
                    pager.find('.prev_link').hide();
                }

                if (page < (numPages - 1)) {
                    pager.find('.next_link').show();
                } else {
                    pager.find('.next_link').hide();
                }

                pager.data("curr", page);
                pager.children().removeClass("active");
                pager.children().eq(page + 1).addClass("active");
            }
        };

        $(document).ready(function() {
            $('#myTable').pageMe({
                pagerSelector: '#myPager',
                showPrevNext: true,
                hidePageNumbers: false,
                perPage: 4
            });
        });
    </script>
</body>

</html>

<?php
include('../Layouts/modal.php');
include('../Layouts/footer.php'); ?>