<?php
include('conexion.php');
require 'fecha.php';
if (isset($_POST['buscar'])) {
    $grado = $_POST['grado'];
    $espe = $_POST['especialidad'];
    $secc = $_POST['seccion'];
    $fechaselect = $_POST['semana'];
    $materia = [];
    $i = 0;
    //busca materias de una especialidad y grado
    $buscarm = "SELECT nombre from materias where grado = $grado and especialidad = $espe";
    $materias = mysqli_query($mysqli, $buscarm);

    //busca los alumnos de una especialidad, grado y seccion
    $busa = "SELECT nombres from alumnos where grado= $grado and especialidad = $espe and seccion = $secc";
    $alumnos = mysqli_query($mysqli, $busa);



    $semana = date("W", strtotime($fechaselect));




?>
    <div style="width:max-content;">
        <center><b><label>Registro de tablas del grupo
                    <?php echo $grado;  ?> de
                    <?php
                    if ($espe == 1) {
                        echo "Combustion Interna";
                    }
                    if ($espe == 2) {
                        echo "Maquinas y Herramientas";
                    }
                    if ($espe == 3) {
                        echo "Electricidad";
                    }
                    if ($espe == 4) {
                        echo "Sistemas";
                    }
                    if ($espe == 5) {
                        echo "Mecatronica";
                    }   ?> del
                    <?php
                    if ($secc == 1) {
                        echo "A";
                    }
                    if ($secc == 2) {
                        echo "B";
                    } ?>
                </label></b></center>
        <table class="table table-light"   border="1">
            <thead class="thead-light">

                <tr>
                    <th>Nombre alumno</th> <?php while ($rows = $materias->fetch_assoc()) {
                                                echo "<th>" . $rows['nombre'] . "</th>";
                                                $materia[] = $rows['nombre'];
                                            }   ?> <th> Faltas de la semana No. <?php echo $semana;  ?></th>
                </tr>
            </thead>
            <tbody>
                <?php

                while ($row = $alumnos->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>";
                    echo $row['nombres'];
                    echo "</td>";

                    for ($i = 0; $i < count($materia); $i++) {
                        $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana = "' . $fechaselect . '"';

                        $falta = mysqli_query($mysqli, $bufa);

                        $fa = $falta->fetch_assoc();

                        echo "<td>";
                        if (empty($fa['faltas'])) {
                            echo "0";
                        } else {
                            echo $fa['faltas'];
                        }

                        echo "</td>";
                    }





                    echo "<td>";
                    $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND semana = "' . $fechaselect . '")';
                    $total = mysqli_query($mysqli, $totfa);
                    $to = $total->fetch_assoc();
                    if (empty($to['falta'])) {
                        echo "0";
                    } else {
                        echo $to['falta'];
                    }

                    echo "</td>";
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>
    </div>



<?php
}

?>