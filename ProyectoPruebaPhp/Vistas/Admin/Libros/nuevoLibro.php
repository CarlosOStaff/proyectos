<?php
require_once '../../../BD/conexion.php';
include '../../Layouts/menu_admin.php';
include '../../../Controladores/Catalogos/etiquetas.php';
include '../../../Controladores/Catalogos/categorias.php';
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
    <link rel="stylesheet" href="../../../Css/modal.css">
</head>

<body>
    <div class="mt-5 pt-5">
        <div class="container bg-body col-lg-10 p-3 mt-5 mb-5 pb-4">
            <h2 class="card-title mb-4 text-center mt-2 fst-italic">Registrar un nuevo libro</h2>
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-10 ">
                    <form action="../../../Controladores/Admin/libros/nuevoLibro.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="formrow-firstname-input" class="form-label fw-bold fst-italic">Titulo del
                                libro</label>
                            <input type="text" class="form-control" required name="titulo_libro" placeholder="Don quijote">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-email-input"
                                        class="form-label fw-bold fst-italic">Descripcion</label>
                                    <textarea name="descripcion" required id="" row="4" class="form-control" placeholder="Descripcion..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="formrow-email-input" class="form-label fw-bold fst-italic">Contenido</label>
                                    <textarea name="contenido" required id="" row="4" class="form-control" placeholder="Contenido..."></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="formrow-password-input" class="form-label fw-bold fst-italic">Fecha de
                                            publicacion</label>
                                        <input type="date" class="form-control" required name="fecha_publicacion">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="formrow-inputState"
                                            class="form-label fw-bold fst-italic">Etiquetas</label>
                                        <select id="formrow-inputState" required name="etiqueta_id" class="form-select">
                                            <option> Seleccionar...</option>
                                            <?php while ($row = $result_etiquetas->fetch_assoc()): ?>
                                                <option name="etiqueta_id" value="<?php echo $row['id'] ?>"><?php echo $row['nombre_etiqueta'] ?> </option>
                                            <?php endwhile ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label fw-bold fst-italic">Categoria</label>
                                    <select id="formrow-inputState" required name="categoria_id" class="form-select">
                                        <option> Seleccionar...</option>
                                        <?php while ($row2 = $result->fetch_assoc()): ?>
                                            <option name="categoria_id" value="<?php echo $row2['id'] ?>"><?php echo $row2['nombre_categoria'] ?></option>
                                        <?php endwhile ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="mb-3">
                                    <label for="formrow-inputState" class="form-label fw-bold fst-italic">Imagen</label>
                                    <input class="form-control" required type="file" id="imagen" name="imagen">
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary w-md fw-bold fst-italic">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?php include '../../Layouts/modal.php'; ?>
        </div>
    </div>
</body>
<?php include '../../Layouts/footer.php'; ?>
</html>