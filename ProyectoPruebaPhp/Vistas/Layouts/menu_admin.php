<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../Css/menu_cliente.css">
    <link rel="stylesheet" href="../../Css/modal.css">

</head>

<body>

    <body class="d-flex flex-column vh-100 col-xl-12">
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
            <div class="container-fluid">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white fw-bold" href="#">Usuarios activos</a>
                    </li>
                    <li class="nav-item">
                        <a href="../../Auth/Logout.php" class="nav-link text-white fw-bold">Logout</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto text-center">
                <?php
                session_start();
                $user = $_SESSION['admin'];
                var_dump($user['img_perfil']);
                echo '<li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle text-white fw-bold" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="../../Recursos/img/users/perfil/' . $user['img_perfil'] . '"
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

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateProfileImage() {
                fetch('')
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('profileImage').src = '../../Recursos/img/users/perfil/' + data.img_perfil;
                    })
                    .catch(error => console.error('Error:', error));
            }
            // Actualizar la imagen del perfil cada 5 segundos
            setInterval(updateProfileImage, 5000);
        });
    </script>
    </body>

</html>