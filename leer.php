<?php
require 'vendor/autoload.php';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{

    public function readCell($column, $row, $worksheetName = '')
    {
        // Read title row and rows 20 - 30
        if ($row > 11) {
            return true;
        }
        return false;
    }
}
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$inputFileName = 'LISTA 6 SCI-A.xlsx';

/**  Identify the type of $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Create a new Reader of the type that has been identified  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
//Leo datos para obtener una celda especifica
$reader->setReadFilter(new MyReadFilter());
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);
?>
<table border="1">
    <thead>
        <tr>
            <th>Alumno</th>
        </tr>
    </thead>

    <?php
    $cantidad = $spreadsheet->getActiveSheet(2)->toArray();
    foreach ($cantidad as $row) {
        if ($row[0] != '') {
            echo '<tr><td>' . $row[1] . '</td></tr>';
        }
    }

    ?>

</table>