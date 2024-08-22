<?php 
require_once '../../../BD/conexion.php';
include '../../Layouts/menu_admin.php';
include '../../../Controladores/Admin/estadisticas.php';
?>
<div class="container py-5">
    <div class="row p-3 m-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Libros por categorías</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Categorías</th>
                                    <th>Libros por Categoría</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $row['nombre_categoria'] ?></td>
                                        <td><?php echo $row['total_libros'] ?></td>
                                    </tr>
                                <?php endwhile ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mt-3">
                <div class="card-body">
                    <form action="../../../Controladores/Admin/estadisticasExcel.php" method="GET">
                        <button type="submit" class="btn btn-success btn-block">
                            <i class="fas fa-file-download"></i> Descargar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../../Layouts/footer.php'; ?>