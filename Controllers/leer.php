<?php
if (isset($_POST['Insertar'])) {
    $alumnos = [];
    $nombre = $_FILES['fichero_usuario']['name'];




    $info = new SplFileInfo($_FILES['fichero_usuario']['name']);
    $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);
    $dir_subida =  __DIR__ . '/../Excels';
    if ($extension == 'xlsx') {
        $tmp_name = $_FILES['fichero_usuario']['tmp_name'];
        $name = basename($_FILES['fichero_usuario']['name']);
        if (move_uploaded_file($tmp_name, $dir_subida . '/' . $name)) {
            require __DIR__ . '/../vendor/autoload.php';

            class MyReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter
            {

                public function readCell($column, $row, $worksheetName = '')
                {

                    // Read title row and rows 20 - 30
                    if ($row >= 13) {
                        return true;
                    }
                    return false;
                }
            }
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            $inputFileName = __DIR__ . '/../Excels/' . $_FILES['fichero_usuario']['name'];


            /**  Identify the type of $inputFileName  **/
            $inputFileType = \PhpOffice\PhpSpreadsheet\IOFactory::identify($inputFileName);
            /**  Create a new Reader of the type that has been identified  **/
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($inputFileType);
            //Leo datos para obtener una celda especifica
            $reader->setReadFilter(new MyReadFilter());
            /**  Load $inputFileName to a Spreadsheet Object  **/
            $spreadsheet = $reader->load($inputFileName);

?>

            <div class="tablaexcel" id="tablaexcel">


                <table border="1">
                    <thead>
                        <tr>
                            <th>Alumno</th>
                        </tr>
                    </thead>

                    <?php

                    $cantidad = $spreadsheet->getActiveSheet()->toArray();
                    foreach ($cantidad as $row) {
                        if ($row[0] != '') {
                            $alumnos[] = $row[1];
                            echo '<tr><td>' . $row[1] . '</td></tr>';
                        }
                    }

                    ?>

                </table>

                <div class="formu">
                    <form action='' method="POST">


                        <label for="especialidad">Especialidad: </label>
                        <select name="especialidad" id="especialidad" oninput="mossec()">
                            <option value="...">...</option>
                            <option value="1">Combustion Interna</option>
                            <option value="2">Maquinas y herramientas</option>
                            <option value="3">Electricidad</option>
                            <option value="4">sistemas</option>
                            <option value="5">Mecatronica</option>
                        </select>
                        <label for="seccion">Seccion:</label>
                        <select name="seccion" id="seccion" disabled>
                            <option value="1">A</option>
                            <option value="2">B</option>
                        </select>
                        <?php
                        echo '<input name="excel" type="text" value="' . $nombre . '"  hidden>';
                        for ($i = 0; $i < count($alumnos); $i++) {

                            echo '<input name = "alumno[]" type="text" value="' . $alumnos[$i] . '" hidden>';
                        }
                        ?>
                        <input type="button" onclick="confirm()" value="Enviar">
                        <div id="confirmado" class="confirmar" hidden>
                            <div class="conf">
                                <label for="advertencia" style="background-color: yellow; color: red; padding: 5px; width:100%;">Advertencia</label><br>
                                <b><label for="confimar">Está segur@ de Insertar esta lista?</label></b>
                                <input type="submit" value="Confirmar" name="confirmado">
                                <input type="submit" value="Cancelar" name="cancelar" onclick="actualizar()">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
<?php


        } else {
            echo '¡posible ataque de subida de ficheros';
        }
    } else {
        echo "este tipo de archivo no esta permitido";
    }
}

if (isset($_POST['confirmado'])) {
    include('conexion.php');
    $seccion = $_POST['seccion'];
    $espe = $_POST['especialidad'];
    if (!empty($_POST["alumno"]) && is_array($_POST["alumno"])) {
        $alumnos = array();
        foreach ($_POST["alumno"] as $alavertebra) {
            $alumnos[] = $alavertebra;
        }
    }

    for ($i = 0; $i < count($alumnos); $i++) {
        $insert = "INSERT INTO alumnos (nombres,especialidad,grado,seccion) VALUES ('" . $alumnos[$i] . "'," . $espe . ",1," . $seccion . ")";
        $ejecuta = mysqli_query($mysqli, $insert);
    }

    echo 'lista insertada correctamente';
}

if (isset($_POST['cancelar'])) {
    unlink(__DIR__ . '/../Excels/' . $_POST['excel']);
}

?>