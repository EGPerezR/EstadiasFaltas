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


$styleArray = [
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
];
$spreadsheet->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$sheet = $spreadsheet->getActiveSheet();
$spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(25);
$spreadsheet->getActiveSheet()->mergeCells('B2:H2');
$titulo = new RichText();
$negro = $titulo->createTextRun('Registro de faltas del grupo ' . $grado . ' de ' . $espe . ' del ' . $seccion);
$negro->getFont()->setBold(true);
$sheet->setCellValue('B2', $titulo);

//$spreadsheet->getActiveSheet()->getStyle('A4')->getBorders()->getAllBorders()->setBorderStyle(true);
$sheet->getStyle('A4')->applyFromArray($styleArray);
$spreadsheet->getActiveSheet()->getCell('A4')->setValue($bold);

$col = $colu;
for ($i = 0; $i < count($materia); $i++) {
    $sheet->setCellValue($colu . $filama, $materia[$i]);
    $sheet->getStyle($colu . $filama)->applyFromArray($styleArray);
    //$spreadsheet->getActiveSheet()->getStyle($colu . $filama)->getBorders()->getAllBorders()->setBorderStyle(true);
    $colu++;
}
$colu2 = $colu;
$fila2 = $filama;
$fila1 = $filama;

$fila4 = $filama;
$fila5 = $filama;
$colu3 = $colu2++;
for ($a = 0; $a < count($nombrea); $a++) {
    $sheet->getStyle($colmal . $filalm)->applyFromArray($styleArray);
    //$spreadsheet->getActiveSheet()->getStyle($colmal . $filalm)->getBorders()->getAllBorders()->setBorderStyle(true);
    $sheet->setCellValue($colmal . $filalm, $nombrea[$a]);
    $colupa = $col;
    for ($m = 0; $m < count($materia); $m++) {
        if ($o < count($faltase)) {
            $sheet->getStyle($colupa . $filalm)->applyFromArray($styleArray);
            //$spreadsheet->getActiveSheet()->getStyle($colupa . $filalm)->getBorders()->getBottom()->setBorderStyle(true);
            $sheet->setCellValue($colupa . $filalm, $faltase[$o]);
            $colupa++;
            $o++;
        }
    }

    $filalm++;

    $fila1++;
    $fila2++;
    $spreadsheet->getActiveSheet()->mergeCells($colu3 . $fila1 . ':' . $colu2 . $fila2);
    $sheet->getStyle($colu3 . $fila1 . ':' . $colu2 . $fila2)->applyFromArray($styleArray);
    //$spreadsheet->getActiveSheet()->getStyle($colu3 . $fila1 . ':' . $colu2 . $fila2)->getBorders()->getAllBorders()->setBorderStyle(true);
}

for ($j = 0; $j < count($faltat); $j++) {
    $fila4++;
    $sheet->setCellValue($colu3 . $fila4, $faltat[$j]);
    $sheet->getStyle($colu3 . $fila4)->applyFromArray($styleArray);
    //$spreadsheet->getActiveSheet()->getStyle($colu3 . $fila4)->getBorders()->getAllBorders()->setBorderStyle(true);
}
if ($_POST['seleccion'] == 1) {
    $sheet->getStyle($colu . $filama)->applyFromArray($styleArray);
    $sheet->setCellValue($colu . $filama, 'Dia ' . date('Y-m-d'));
}
if ($_POST['seleccion'] == 2) {
    $semana = $_POST['sema'];
    $sheet->getStyle($colu . $filama)->applyFromArray($styleArray);
    $sheet->setCellValue($colu . $filama, 'semana No. ' . $semana);
}
if ($_POST['seleccion'] == 3) {
    $mes = $_POST['mes'];
    $sheet->getStyle($colu . $filama)->applyFromArray($styleArray);
    $sheet->setCellValue($colu . $filama, 'Faltas de ' . $mes);
}

$colu1 = $colu;
$colu++;
$spreadsheet->getActiveSheet()->mergeCells($colu1 . $filama . ':' . $colu . $filama);
$spreadsheet->getActiveSheet()->getColumnDimension($colu1)->setWidth(15);


$writer = new Xlsx($spreadsheet);
$usuario = getenv('USERNAME');
$ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels';


if(!is_dir($ruta)){
    mkdir($ruta);
    echo $ruta;
    
if ($_POST['seleccion'] == 1) {
    $writer->save( 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx';
    $fichero = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx';
    header('Location: ../tablafaltas.php');
}
if ($_POST['seleccion'] == 2) {
    $no = $_POST['semana'];
    $writer->save('C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx';
    $fichero = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx';
    descargar($ruta, $fichero);
    header('Location: ../tablafaltas.php');
}
if ($_POST['seleccion'] == 3) {
    $mes = $_POST['mes'];
    $writer->save('C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx';
    $fichero = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx';
    descargar($ruta,$fichero);
    header('Location: ../tablafaltas.php');
}
}else {

    
    
if ($_POST['seleccion'] == 1) {
    $writer->save( 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx';
    $fich = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del Dia ' . date('Y-m-d') . '.xlsx';
    descargar($ruta,$fich);
    header('Location: ../tablafaltas.php');
    
}
if ($_POST['seleccion'] == 2) {
    $no = $_POST['semana'];
    $writer->save('C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx';
    $fich = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' de la semana ' . $no . '.xlsx';
    descargar($ruta,$fich);
    header('Location: ../tablafaltas.php');

    }
    



if ($_POST['seleccion'] == 3) {
    $mes = $_POST['mes'];
    $writer->save('C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx');
    $ruta = 'C:/users/'.$usuario.'/desktop/Impresion_Excels/Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx';
    $fich = 'Tabla de faltas de ' . $espe . ' de ' . $grado . ' grado del ' . $seccion . ' del mes de ' . $mes . '.xlsx';
    descargar($ruta, $fich);
    header('Location: ../tablafaltas.php');
}
}


function descargar($ruta, $fich){
    if(file_exists($ruta) && is_file($ruta)){

        header('Cache-control: private');
        header('Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Length: '.filesize($ruta));
        header('Content-Disposition: filename='.$fich);
     
        // flush content
        flush();
     
         //abrimos el fichero
         $file = fopen($ruta , "rb");
     
         //imprimimos el contenido del fichero al navegador
         print fread ($file, filesize($ruta )); 
     
         //cerramos el fichero abierto
         fclose($file);
     
    } else {
     
        die('Error:  El fichero  '.$ruta .' no existe!');  //termino la ejecución de código por que el fichero no existe.
     
    }
}