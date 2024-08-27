<?php
include('../../Layouts/menu_admin.php');
require_once('../../../BD/conexion.php');
if (!isset($_SESSION['admin'])) {
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
    <link rel="stylesheet" href="../../../Css/modal.css">
</head>
<body>
<div class="card-body" style="padding-left:3vw;padding-right:3vw;padding-top:3vw;">
    <h4 class="card-title mt-4 mb-4">Actualiza la informacion necesaria del libro</h4>
    <?php
    include('../../../Controladores/Admin/libros/editarLibros.php');
    while ($row = $result->fetch_assoc()):
    ?>
        <form action="../../../Controladores/Admin/libros/actualizarlibro.php" , method="POST" enctype="multipart/form-data">

            <div class="form-floating mb-4 col-md-6">
                <input type="text" class="form-control" name="titulo_libro" value="<?php echo $row['titulo_libro'] ?>"
                    id="floatingnameInput" placeholder="Enter Name">
                <label for="floatingnameInput">Titulo del libro</label>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <textarea class="form-control col-md-6" type="textarea" name="descripcion"
                            value="<?php echo $row['descripcion'] ?>" rows="5" cols="83"
                            style="height:10vw;"><?php echo $row['descripcion'] ?></textarea>
                        <label for="floatingemailInput">Descripcion</label>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-floating mb-3">
                        <select name="categoria_id" class="form-select" id="floatingSelectGrid"
                            aria-label="Floating label select example">
                            <option selected="" value="<?php echo $row['categoria_id'] ?>">__<?php echo $row['nombre_categoria'] ?>__</option>
                            <?php
                            include("../../../Controladores/Catalogos/categorias.php");
                            while ($row2 = $result->fetch_assoc()): ?>
                                <option name="categoria_id" value="<?php echo $row2['id'] ?>"><?php echo $row2['nombre_categoria'] ?></option>
                            <?php endwhile ?>
                        </select>
                        <label for="floatingSelectGrid">Categoria</label>
                    </div>
                    <div class="form-group mb-4">
                        <label for="input-date1">Fecha de publicacion</label>
                        <input id="input-date1" type="date" name="fecha_publicacion" value="<?php echo $row['fecha_publicacion'] ?>"
                            class="form-control input-mask" data-inputmask="'alias': 'datetime'"
                            data-inputmask-inputformat="dd/mm/yyyy" im-insert="false">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Contenido</label>
                <textarea name="contenido" value="" class="form-control" id="exampleFormControlTextarea1"
                    rows="3"><?php echo $row['contenido'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="formrow-inputState" class="form-label fw-bold fst-italic">Imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>
            <br>
            <div>
                <button type="submit" name="id" value="<?php echo $row['id'] ?>" class="btn btn-primary w-md">Guardar</button>
            </div>
        </form>
    <?php endwhile ?>
    <?php include('../../Layouts/modal.php'); ?>
</div>
<?php include('../../Layouts/footer.php') ?>
</body>
</html>