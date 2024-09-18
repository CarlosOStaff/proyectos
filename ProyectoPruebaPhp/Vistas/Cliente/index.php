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
    <link rel="stylesheet" href="../../Css/cssCliente/slider.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-4 fst-italic elegantshadow">Bienvenido <?php echo $name['nombre'] ?> </h1>
        <div>
            <h3 class="rainbow text-center mb-3 fst-italic">Visualiza nuestro catálogo de libros disponibles</h3>
            <main>
                <ul class='slider'>
                    <?php
                    include('../../Controladores/Cliente/lista_libros.php');
                    if ($result): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <li class='item' style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
url('../../Recursos/img/portadaLibros/<?php echo $row['imagen'] ?>')">
                                <div class='content'>
                                    <h2 class='title'><?php echo $row['titulo_libro'] ?></h2>
                                    <p class='description'><?php echo $row['descripcion'] ?> </p>
                                    <form action="../../Controladores/Cliente/prestarLibro.php/libro=<?php echo $row['id'] ?>" method="POST">
                                        <button type="submit" class="btn btn-outline-success" name="libroId" value="<?php echo $row['id'] ?>" aria-label="Prestar libro" title="Prestar libro">
                                            <i class="fas fa-book"></i> Pedir Prestado
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endwhile ?>
                    <?php endif ?>
                </ul>
                <nav class='nav'>
                    <ion-icon class='btn prev' name="arrow-back-outline"></ion-icon>
                    <ion-icon class='btn next' name="arrow-forward-outline"></ion-icon>
                </nav>
            </main>
            <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
            <script src="../../Js/slider.js"></script>
        </div>
    </div>
</body>
<?php
include '../Layouts/modal.php';
include '../Layouts/footer.php';
?>

</html>