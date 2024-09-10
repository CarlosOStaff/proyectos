<?php
include '../../Layouts/menu_admin.php';
require_once '../../../BD/conexion.php';
if (!isset($_SESSION['admin'])) {
    $_SESSION['message'] = 'No has iniciado sesion';
    header('Location: ../../Auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../Css/modal.css">
    <link rel="stylesheet" href="../../../Css/cssAdmin/editarlibro.css">
</head>

<body>
    <div class="card-body pt-5 pb-5 p-5 mt-3">
        <h4 class="reveal card-title mt-5 mb-4">Actualiza la informacion necesaria del libro</h4>
        <?php
        include('../../../Controladores/Admin/libros/editarLibros.php');
        while ($row = $result->fetch_assoc()):
        ?>
            <form action="../../../Controladores/Admin/libros/actualizarlibro.php" , method="POST" enctype="multipart/form-data">

                <div class="form-floating mb-4 col-md-6">
                    <input type="text" class="text form-control" name="titulo_libro" value="<?php echo $row['titulo_libro'] ?>"
                        id="floatingnameInput" placeholder="Enter Name">
                    <label for="floatingnameInput" class="label-title">Titulo del libro</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <textarea class="txt-desc form-control col-md-6" type="textarea" name="descripcion"
                                value="<?php echo $row['descripcion'] ?>" rows="5" cols="83"
                                style="height:10vw;"><?php echo $row['descripcion'] ?></textarea>
                            <label for="floatingemailInput" class="label-title">Descripcion</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select name="categoria_id" class="txt-desc form-select" id="floatingSelectGrid"
                                aria-label="Floating label select example">
                                <option class="txt-desc" selected="" value="<?php echo $row['categoria_id'] ?>" >__<?php echo $row['nombre_categoria'] ?>__</option>
                                <?php
                                include("../../../Controladores/Catalogos/categorias.php");
                                while ($row2 = $result->fetch_assoc()): ?>
                                    <option name="categoria_id" class="txt-desc" value="<?php echo $row2['id'] ?>"><?php echo $row2['nombre_categoria'] ?></option>
                                <?php endwhile ?>
                            </select>
                            <label for="floatingSelectGrid" class="label-title">Categoria</label>
                        </div>
                        <div class="form-group mb-4">
                            <label for="input-date1" class="label-title">Fecha de publicacion</label>
                            <input id="input-date1" type="date" name="fecha_publicacion"  value="<?php echo $row['fecha_publicacion'] ?>"
                                class="txt-desc form-control input-mask" data-inputmask="'alias': 'datetime'"
                                data-inputmask-inputformat="dd/mm/yyyy" im-insert="false">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1" class="label-title">Contenido</label>
                    <textarea name="contenido" value="" class="txt-desc form-control" id="exampleFormControlTextarea1"
                        rows="3"><?php echo $row['contenido'] ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="formrow-inputState" class="label-title form-label fw-bold fst-italic">Imagen</label>
                    <input class="form-control" type="file" id="imagen" name="imagen">
                </div>
                <br>
                <div>
                    <button type="submit" name="id" value="<?php echo $row['id'] ?>" class="btn btn-outline-success w-md d-flex">
                        <i class="fas fa-save mt-1 mx-1"></i>Guardar</button>
                </div>
            </form>
        <?php endwhile ?>
        <?php include '../../Layouts/modal.php'; ?>
    </div>
</body>
<?php include '../../Layouts/footer.php'; ?>
<script src="../../../Js/efectotexto.js"></script>

</html>