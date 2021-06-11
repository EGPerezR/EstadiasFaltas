<?php

/*$grado = $_POST['gra'];
    $seccion = $_POST['secc'];
    $espe = $_POST['espe'];
*/
$grado = 2;
$seccion = "A";
$espe = "maquinas y Herramientas";





require  __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet = $spreadsheet->getActiveSheet();
$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
            'color' => ['argb' => 'FFFF0000'],
        ],
    ],
];
$spreadsheet->getActiveSheet()->mergeCells('D2:J2');
$sheet->setCellValue('D2', 'Registro de faltas del grupo ' . $grado . ' de ' . $espe . ' del ' . $seccion . '');

//$sheet->setCellValue('A1', 'Hello World !');
//$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('hello world.xlsx');
