<?php
require_once '../../BD/conexion.php';
require '../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$excel = "SELECT c.nombre_categoria, COUNT(b.id) 
            as total_libros FROM categories c 
            LEFT JOIN books b 
            ON c.id = b.categoria_id 
            GROUP BY c.nombre_categoria";
$result = $mysqli->query($excel);

// Crea una nueva instancia de Spreadsheet
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Agrega el titulo a la hoja de excel
$sheet->setTitle('Libros por Categorías');
// Agrega datos a la hoja
$sheet->setCellValue('A1', 'Categorías');
$sheet->setCellValue('B1', 'Libros por Categoría');
$fila = 2;
while ($row = $result->fetch_assoc()) {
    $sheet->getColumnDimension('A')->setWidth(25);
    $sheet->setCellValue('A' . $fila, $row['nombre_categoria']);
    $sheet->getColumnDimension('B')->setWidth(25);
    $sheet->setCellValue('B' . $fila, $row['total_libros']);
    $fila++;
}

// Aplica el filtro automático solo a la columna A
$lastRow = $sheet->getHighestRow(); // Obtiene la última fila con datos
$sheet->setAutoFilter('A1:A' . $lastRow); // Aplica filtro solo en la columna A
// Estilo de fondo
// Aplicar estilo a la fila de encabezado
$sheet->getStyle('A1:B1')->applyFromArray([
    'font' => [
        'bold' => true,
        'color'=>['rgb'=>'faf5f5']
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '0f0f0f'] // Fondo amarillo
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ]
]);
// Crea un escritor Xlsx para el archivo
$writer = new Xlsx($spreadsheet);

// Establece el nombre del archivo a descargar
$filename = 'ejemplo.xlsx';

// Establece las cabeceras HTTP para descargar el archivo
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Enviar el archivo al navegador
$writer->save('php://output');
exit;
