<?php

$grado = $_POST['gra'];
$seccion = $_POST['secc'];
$espe = $_POST['espe'];
$colmal = "A";
$filalm = 5;
$colu = "B";
$filama = 4;
$o = 0;


//Construccion de las materias
if (!empty($_POST["mate"]) && is_array($_POST["mate"])) {
    $materia = array();
    foreach ($_POST["mate"] as $como) {

        $materia[] = $como;
    }
} else {
    echo "nada paso";
}



//construccion de los nombres

if (!empty($_POST["nombre"]) && is_array($_POST["nombre"])) {
    $nombrea = array();
    foreach ($_POST["nombre"] as $nomr) {

        $nombrea[] = $nomr;
    }
} else {
    echo "nada paso";
}


//construccion de las faltas de la semana por materia

if (!empty($_POST["faltase"]) && is_array($_POST["faltase"])) {
    $faltase = array();
    foreach ($_POST["faltase"] as $falta) {

        $faltase[] = $falta;
    }
} else {
    echo "nada paso";
}



//Construccion de las faltas totales del alumno
if (!empty($_POST["faltato"]) && is_array($_POST["faltato"])) {
    $faltat = array();
    foreach ($_POST["faltato"] as $fa) {

        $faltat[] = $fa;
    }
} else {
    echo "nada paso";
}






require  __DIR__ . '/../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

$spreadsheet = new Spreadsheet();
$bold = new RichText();
$cambio = $bold->createTextRun('Alumno');
$cambio->getFont()->setbold(true);

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
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
$spreadsheet->getActiveSheet()->mergeCells('B2:H2');
$sheet->setCellValue('B2', 'Registro de faltas del grupo ' . $grado . ' de ' . $espe . ' del ' . $seccion . '');

$spreadsheet->getActiveSheet()->getCell('A4')->setValue($bold);
$col = $colu;
for ($i = 0; $i < count($materia); $i++) {
    $sheet->setCellValue($colu . $filama, $materia[$i]);

    $colu++;
}
$colu2 = $colu;
$fila2 = $filama;
$fila1 = $filama;

$fila4 = $filama;
$fila5 = $filama;
$colu3 = $colu2++;
for ($a = 0; $a < count($nombrea); $a++) {
    $sheet->setCellValue($colmal . $filalm, $nombrea[$a]);
    $colupa = $col;
    for ($m = 0; $m < count($materia); $m++) {
        if ($o < count($faltase)) {
            $sheet->setCellValue($colupa . $filalm, $faltase[$o]);
            $colupa++;
            $o++;
        }
    }

    $filalm++;

    $fila1++;
    $fila2++;
    $spreadsheet->getActiveSheet()->mergeCells($colu3 . $fila1 . ':' . $colu2 . $fila2);
}

for ($j = 0; $j < count($faltat); $j++) {
    $fila4++;
    $sheet->setCellValue($colu3 . $fila4, $faltat[$j]);
}
$sheet->setCellValue($colu . $filama, 'semana No.');
$colu1 = $colu;
$colu++;
$spreadsheet->getActiveSheet()->mergeCells($colu1 . $filama . ':' . $colu . $filama);


$writer = new Xlsx($spreadsheet);


$writer->save(__DIR__.'/../Impreso/Tabla de faltas de la semana de '.$espe.' de '.$grado.' grado del '.$seccion.'.xlsx');

header('Location: ../tablafaltas.php');
