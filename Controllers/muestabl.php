<?php
include('conexion.php');
require 'fecha.php';
if (isset($_POST['buscar'])) {


    if (isNullesp($_POST['especialidad'])) {

        echo '<script>
            alert("Seleccionar una Especialidad");
          </script>';
    } else if (isNullgrad($_POST['grado'])) {

        echo '<script>
            alert("Seleccionar un Grado");
          </script>';
    } else if (isNullsec($_POST['seccion'])) {

        echo '<script>
            alert("Seleccionar una Seccion");
          </script>';
    } else {
        $grado = $_POST['grado'];
        $espe = $_POST['especialidad'];
        $secc = $_POST['seccion'];
        $mes = $_POST['mes'];

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
        <div class="tabfal" id="tabfal">

            <div class="tablafal" style="
            
                        <?php
                        if ($espe == 4) {
                            echo "background-color: #87ec8b;";
                        }
                        if ($espe == 1) {
                            echo "background-color: #f79595;";
                        }
                        if ($espe == 2) {
                            echo "background-color: #7ea7ff;";
                        }
                        if ($espe == 3) {
                            echo "background-color: #ffb87e;";
                        }
                        if ($espe == 5) {
                            echo "background-color: #9d61fd;";
                        }    ?>"><a href="" onclick="offtab()" style="color = red;">X</a>
                <form method="POST" action="Controllers/creaexcel.php">
                    <center><b><label>Registro de faltas del grupo
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
                            </label></b></center><br>

                    <?php
                    if ($espe == 1) {
                        echo "<input type='text' value='Combustion Interna' name='espe' hidden>";
                    }
                    if ($espe == 2) {
                        echo "<input type='text' value='Maquinas y herramientas' name='espe' hidden >";
                    }
                    if ($espe == 3) {
                        echo "<input type='text' value='Electricidad' name='espe' hidden>";
                    }
                    if ($espe == 4) {
                        echo "<input type='text' value='Sistemas' name='espe' hidden>";
                    }
                    if ($espe == 5) {
                        echo "<input type='text' value='Mecatronica' name='espe' hidden>";
                    }
                    if ($secc == 1) {

                        echo "<input type='text' value = 'A' name='secc' hidden>";
                    }
                    if ($secc == 2) {
                        echo "<input type='text' value = 'B' name='secc' hidden>";
                    }
                    echo "<input type = 'text' value = '" . $grado . "' name='gra' hidden>";

                    ?>
                    <table class="table table-light" border="1">
                        <thead class="thead-light">

                            <tr>
                                <th>Nombre alumno</th>
                                <?php while ($rows = $materias->fetch_assoc()) {
                                    echo "<th>" . $rows['nombre'] . "</th>";
                                    echo "<input type = 'text' value = '" . $rows['nombre'] . "' name='mate[]' hidden>";
                                    $materia[] = $rows['nombre'];
                                }   ?>
                                <?php
                                if (isset($_POST['seleccion1'])) {
                                    echo "<input type ='text' value = '1' name='seleccion' hidden>";
                                ?>
                                    <th> Faltas del dia <?php echo date('Y-m-d');  ?></th>
                                <?php
                                }
                                ?>
                                <?php
                                if (isset($_POST['seleccion2'])) {
                                    echo "<input type ='text' value = '2' name='seleccion' hidden>";
                                    echo "<input type ='text' value = '" . $fechaselect . "' name='sema' hidden>";
                                    echo "<input type ='text' value = '" . $semana . "' name='semana' hidden>";

                                ?>
                                    <th> Faltas de la semana No. <?php echo $semana;  ?></th>
                                <?php
                                }
                                ?>
                                <?php
                                if (isset($_POST['seleccion3'])) {

                                    echo "<input type ='text' value = '3' name='seleccion' hidden>";
                                    echo "<input type ='text' value = '" . $mes . "' name='mes' hidden>";
                                ?>
                                    <th> Faltas del Mes de <?php echo $mes;  ?></th>
                                <?php
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            while ($row = $alumnos->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>";
                                echo $row['nombres'];
                                echo "<input type='text' value='" . $row['nombres'] . "' name='nombre[]'  hidden>";
                                echo "</td>";

                                for ($i = 0; $i < count($materia); $i++) {



                                    if (isset($_POST['seleccion1'])) {
                                        if (isNullfecha($_POST['semana'])) {
                                            echo '<script>
                                            alert("Seleccionar una fecha");
                                          </script>';
                                        } else {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.dia_registro = "' . $fechaselect . '"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        }
                                    } else if (isset($_POST['seleccion2'])) {
                                        if (isNullfecha($_POST['semana'])) {
                                            echo '<script>
                                            alert("Seleccionar una fecha");
                                          </script>';

                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana = "' . $fechaselect . '"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        }
                                    } else if (isset($_POST['seleccion3'])) {

                                        if ($mes == 'Enero') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-01-01" AND faltas.semana <= "2021-01-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Febrero') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-02-01" AND faltas.semana <= "2021-02-28"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Marzo') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-03-01" AND faltas.semana <= "2021-03-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Abril') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-04-01" AND faltas.semana <= "2021-04-30"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Mayo') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-05-01" AND faltas.semana <= "2021-05-31"';
                                            echo $bufa;
                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Junio') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-06-01" AND faltas.semana <= "2021-06-30"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Julio') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-07-01" AND faltas.semana <= "2021-07-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Agosto') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-08-01" AND faltas.semana <= "2021-08-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Septiembre') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-09-01" AND faltas.semana <= "2021-09-30"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Octubre') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-10-01" AND faltas.semana <= "2021-10-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Noviembre') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-11-01" AND faltas.semana <= "2021-11-30"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        } else if ($mes == 'Diciembre') {
                                            $bufa = 'SELECT SUM(faltas.faltas) as faltas from faltas INNER JOIN materias on faltas.id_materia=materias.id_materia INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos where faltas.id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '") AND faltas.id_materia=(SELECT materias.id_materia from materias WHERE materias.nombre = "' . $materia[$i] . '" AND materias.grado = ' . $grado . ' AND materias.especialidad = ' . $espe . ') AND faltas.semana >= "2021-12-01" AND faltas.semana <= "2021-12-31"';

                                            $falta = mysqli_query($mysqli, $bufa);

                                            $fa = $falta->fetch_assoc();

                                            echo "<td>";
                                            if (empty($fa['faltas'])) {
                                                echo "0";
                                                echo "<input type='text' value='0' name='faltase[]'  hidden>";
                                            } else {
                                                echo $fa['faltas'];
                                                echo "<input type='text' value='" . $fa['faltas'] . "' name='faltase[]' hidden >";
                                            }

                                            echo "</td>";
                                        }
                                    }
                                }



                                if (isset($_POST['seleccion1'])) {
                                    echo "<td>";
                                    $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND dia_registro = "' . $fechaselect . '")';

                                    $total = mysqli_query($mysqli, $totfa);
                                    $to = $total->fetch_assoc();
                                    if (empty($to['falta'])) {
                                        echo "0";
                                        echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                    } else {
                                        echo $to['falta'];
                                        echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                    }

                                    echo "</td>";
                                    echo "</tr>";
                                } else if (isset($_POST['seleccion2'])) {
                                    echo "<td>";
                                    $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND semana = "' . $fechaselect . '")';

                                    $total = mysqli_query($mysqli, $totfa);
                                    $to = $total->fetch_assoc();
                                    if (empty($to['falta'])) {
                                        echo "0";
                                        echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                    } else {
                                        echo $to['falta'];
                                        echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                    }

                                    echo "</td>";
                                    echo "</tr>";
                                } else if (isset($_POST['seleccion3'])) {
                                    if ($mes == 'Enero') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-01-01" AND faltas.semana <= "2021-01-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Febrero') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-02-01" AND faltas.semana <= "2021-02-28")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Marzo') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-03-01" AND faltas.semana <= "2021-03-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Abril') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" faltas.semana >= "2021-04-01" AND faltas.semana <= "2021-04-30")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Mayo') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-05-01" AND faltas.semana <= "2021-05-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Junio') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-06-01" AND faltas.semana <= "2021-06-30")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Julio') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-07-01" AND faltas.semana <= "2021-07-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Agosto') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-08-01" AND faltas.semana <= "2021-08-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Septiembre') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-09-01" AND faltas.semana <= "2021-09-30")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Octubre') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-10-01" AND faltas.semana <= "2021-10-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Noviembre') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-11-01" AND faltas.semana <= "2021-11-30")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                    if ($mes == 'Diciembre') {
                                        echo "<td>";
                                        $totfa = 'SELECT SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos where id_alumno = (SELECT alumnos.id_alumnos from alumnos where alumnos.nombres = "' . $row['nombres'] . '" AND faltas.semana >= "2021-12-01" AND faltas.semana <= "2021-12-31")';

                                        $total = mysqli_query($mysqli, $totfa);
                                        $to = $total->fetch_assoc();
                                        if (empty($to['falta'])) {
                                            echo "0";
                                            echo "<input type='text' value='0' name='faltato[]'  hidden>";
                                        } else {
                                            echo $to['falta'];
                                            echo "<input type='text' value='" . $to['falta'] . "' name='faltato[]' hidden >";
                                        }

                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                    <br>
                    <div class="imprimir">

                        <input type="submit" value="Imprimir" name="imprimir" onclick="alerta()">
                </form>
            </div>
        </div>

        </div>



<?php
    }
}

?>