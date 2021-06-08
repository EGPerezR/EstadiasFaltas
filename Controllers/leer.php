<?php
if(isset($_POST['Insertar'])){
$alumnos = [];

$especialidad = $_POST['especialidad'];

$columna = $_POST['columna'];

$info = new SplFileInfo($_FILES['fichero_usuario']['name']);
$extension = pathinfo($info->getFilename(),PATHINFO_EXTENSION);

if($extension=='xlsx'){
$dir_subida =  __DIR__ . '/../Excels/';
$fichero_subido = $dir_subida . basename($_FILES['fichero_usuario']['name']);
if(move_uploaded_file($_FILES['fichero_usuario']['tmp_name'],$fichero_subido)){
    
} else {
    echo '¡posible ataque de subida de ficheros';
} 
}else {
    echo "este tipo de archivo no esta permitido";
}

require __DIR__.'/../vendor/autoload.php';

class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
{
    
    public function readCell($column, $row, $worksheetName = '')
    {
        $fila = $_POST['fila'];
        // Read title row and rows 20 - 30
        if ($row >= $fila) {
            return true;
        }
        return false;
    }
}
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$inputFileName = __DIR__.'/../Excels/'.$_FILES['fichero_usuario']['name'];


/**  Identify the type of $inputFileName  **/
$inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
/**  Create a new Reader of the type that has been identified  **/
$reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
//Leo datos para obtener una celda especifica
$reader->setReadFilter(new MyReadFilter());
/**  Load $inputFileName to a Spreadsheet Object  **/
$spreadsheet = $reader->load($inputFileName);

?>


<center><table border="1">
    <thead>
        <tr>
            <th>Alumno</th>
        </tr>
    </thead>

    <?php
    
    $cantidad = $spreadsheet->getActiveSheet()->toArray();
    foreach ($cantidad as $row) {
        if ($row[0] != '') {
            $alumnos[] = $row[$columna];
            echo '<tr><td>' . $row[$columna] . '</td></tr>';

        }
    }
    
    ?>

</table></center>

<form action='' method="POST">

<?php
echo '<input name="espe" type="text" value="'.$especialidad.'" disabled hidden>';
for ($i = 0; $i<count($alumnos); $i++){

    echo '<input name = "alumno[]" type="text" value="'.$alumnos[$i].'" disabled hidden>';
}
?>
<label for="confimar">Está segur@ de Insertar esta lista?</label>
<input type="submit" value="Confirmar" name="confirmado">
<input type="submit" value="Cancelar" name="cancelar">
</form>

<?php
}

if(isset($_POST['confirmado'])){

}

?>

