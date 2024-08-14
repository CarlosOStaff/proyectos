<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="../../Css/menu_cliente.css">
    <link rel="stylesheet" href="../../Css/modal.css">
</head>

<body class="overflow-x-hidden">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link text-white fst-italic fw-bold" href="../Cliente/index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fst-italic fw-bold" href="../Cliente/misLibros.php">Mis
                        libros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fst-italic fw-bold" href="../../Auth/logout.php">Logout</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto text-center">
                <?php
                session_start();
                $user = $_SESSION['cliente'];
                var_dump( $user['img_perfil']);
                echo '<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white fw-bold" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../Recursos/img/users/perfil/'.$user['img_perfil'].'"
                            class="mh-25 mw-25 h-25 w-25 mx-1 px-3 rounded-circle" id="profileImage">' . $user['nombre'] . '
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../Cliente/profile.php">Mi cuenta</a></li>
                    </ul>
                </li>';
                ?>
            </ul>
        </div>
    </nav>
</body>

</html>