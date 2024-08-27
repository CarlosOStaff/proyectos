<!DOCTYPE html>
<html lang="es">

<head>
    <title>Proyecto - Libreria</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../Css/modal.css" />
</head>

<body>
    <div class="container">
        <h2 class="text-center fst-italic fw-bold mt-3 mb-3">Registrate para poder ver nuestros catalogos de libros</h2>
        <div class="row justify-content-center align-items-center">
            <div class="col-xl-6 shadow-lg mt-4 p-4 rounded-4">

                <div class="">
                    <a href="..\Home\index.php">Volver al inicio</a>
                    <div class="card-body">
                        <h3 class="card-title mb-4 text-center fst-italic fw-bold">Ingresa tus datos personales</h3>

                        <form action="..\..\Auth\register.php" method="POST" id="frm"
                            onsubmit="return validarPasswords()">
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input"
                                    class="col-sm-3 col-form-label fst-italic fw-bold text-end">Nombre:</label>
                                <div class="col-sm-9">
                                    <input type="text" required name="nombre" class="form-control"
                                        id="horizontal-firstname-input" placeholder="Joaquin">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-firstname-input"
                                    class="col-sm-3 col-form-label fw-bold fst-italic text-end">Apellidos:</label>
                                <div class="col-sm-9">
                                    <input type="text" name="apellido" required class="form-control"
                                        id="horizontal-firstname-input" placeholder="Villa Garcia">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-email-input"
                                    class="col-sm-3 col-form-label fw-bold fst-italic text-end">Email:</label>
                                <div class="col-sm-9">
                                    <input type="email" name="email" required class="form-control"
                                        id="horizontal-email-input" placeholder="Ingresa tu correo electronico">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input"
                                    class="col-sm-3 col-form-label fw-bold fst-italic text-end">Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" required name="password" id="password" class="form-control"
                                        placeholder="Ingresa tu contraseña">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="horizontal-password-input"
                                    class="col-sm-3 col-form-label fw-bold fst-italic text-end">Confirmar
                                    Password:</label>
                                <div class="col-sm-9">
                                    <input type="password" required name="confirmar_password" id="confirmar_password"
                                        class="form-control mt-3" placeholder="Ingresa tu contraseña">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <label for="formrow-inputState"
                                    class="col-sm-3 col-form-label text-end fst-italic fw-bold">Ciudades:</label>
                                <div class="col-sm-9">
                                    <select name="ciudad_id" id="ciudad_id" class="form-select">
                                        <option value="">Selecciona una ciudad</option>
                                        <?php
                                        require_once('..\..\BD\conexion.php');

                                        $query = "SELECT * FROM cities";
                                        $result = $mysqli->query($query);

                                        if ($result === false) {
                                            echo '<option value="">Error en la consulta: ' . htmlspecialchars($mysqli->error) . '</option>';
                                        } elseif ($result->num_rows === 0) {
                                            echo '<option value="">No se encontraron ciudades</option>';
                                        } else {
                                            while ($row = $result->fetch_assoc()) {
                                                echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['nombre_ciudad']) . '</option>';
                                            }
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="row justify-content-end mt-3 mx-1">
                                    <div class="col-sm-9">
                                        <div>
                                            <button type="submit"
                                                class="btn btn-primary w-md fst-italic fw-bold">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
                <script type="text/javascript">
                    function validarPasswords() {
                        var pass = document.getElementById("password").value;
                        var repass = document.getElementById("confirmar_password").value;

                        if (pass != repass) {
                            alert("Las contraseñas no coinciden");
                            return false; // Evita el envío del formulario
                        }
                        return true; // Permite el envío del formulario
                    }
                </script>
            </div>
        </div>
    </div>
    <?php include '../Layouts/modal.php'; ?>

</body>

</html>