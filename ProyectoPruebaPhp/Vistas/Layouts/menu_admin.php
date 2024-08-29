<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../Css/menu_cliente.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="d-flex flex-column vh-100 col-xl-12">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="../../../Vistas/Admin/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold" href="http://localhost:3000/Vistas/Admin/usuariosActivos/usuariosActivos.php">Usuarios activos</a>
                </li>
                <li class="nav-item">
                    <a href="http://localhost:3000//Auth/logout.php" class="nav-link text-white fw-bold">Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto text-center">
                <?php
                session_start();
                if (isset($_SESSION['admin'])) {
                    $user = $_SESSION['admin'];
                    if (isset($user['nombre'])) {
                        echo '<li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle text-white fw-bold" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="http://localhost:3000/Recursos/img/users/perfil/' . ($user['img_perfil']) . '"
                                    class="mh-25 mw-25 h-25 w-25 mx-1 px-3 rounded-circle" id="profileImage">' . $user['nombre'] . '
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="http://localhost:3000/Vistas/Admin/perfil.php">Mi cuenta</a></li>
                            </ul>
                        </li>';
                    } else {
                        echo '<li class="nav-item"><a class="nav-link text-white fw-bold" href="#">Perfil no disponible</a></li>';
                    }
                } else {
                    echo '<li class="nav-item"><a class="nav-link text-white fw-bold" href="#">No autenticado</a></li>';
                }
                ?>
            </ul>
        </div>
    </nav>

    <script>
        $(document).ready(function() {
            function updateProfileImage() {
                $.ajax({
                    url: '../../Controladores/Admin/perfilAdmin/getProfileImage.php', // Ruta al archivo PHP que devuelve la imagen
                    method: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        $('#profileImage').attr('src', 'http://localhost:3000/Recursos/img/users/perfil/' + data.img_perfil);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }
            // Actualizar la imagen del perfil cada 5 segundos
            setInterval(updateProfileImage, 5000);
            // Actualizar la imagen del perfil inmediatamente cuando se carga la página
            updateProfileImage();
        });
    </script>
</body>

</html>