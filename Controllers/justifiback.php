<?php
require 'funcs.php';
require 'fecha.php';
if (isset($_POST['justificar'])) {
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
        $espe = $_POST['especialidad'];
        $grado = $_POST['grado'];
        $secc = $_POST['seccion'];
        //consulta de alumnos
        $sql = "SELECT  id_alumnos, nombres, grado, seccion from alumnos where especialidad = $espe and grado = $grado and seccion = $secc and activo = 1 ORDER BY nombres ASC";

        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {
?>
            <div class="fondojustifica" id="fondojustifica">
                <div class="justifiform">
                    <a style="color: red; cursor:pointer;" onclick="cierr()">X</a>
                    <br>
                    <form action="Controllers/justificar.php" method="POST">
                        <select class="alumjus" name="alumno">
                            <?php
                            while ($lista = $result->fetch_assoc()) {

                                echo "<option value='" . $lista['id_alumnos'] . "'>" . $lista['nombres'] . "</option>";
                            }

                            ?>
                        </select>

                        <b><label>Materia</label></b>
                        <?php
                        //consulta de materias
                        $materia = "SELECT * from materias where especialidad = $espe and grado = $grado";
                        $mate = mysqli_query($mysqli, $materia);

                        if (mysqli_num_rows($mate) > 0) {

                        ?>
                            <select id="selemateria" name="materiaj">
                            <?php
                            while ($materiasli = $mate->fetch_assoc()) {
                                //muestra las materias
                                echo "<option value='" . $materiasli['id_materia'] . "'>" . $materiasli['nombre'] . "</option>";
                            }
                        }
                            ?>
                            </select>
                            <br>
                            <label>Motivo:</label>
                            <input type="text" name="motivo">
                            <br>
                            <b><label for="cantidad">Presione para agregar fecha</label></b>
                            <input type="button" value=">>" id="btn_agregar" onclick="crearDin()">
                            
                            <br>
                            <div id="mosdate">

                            </div>
                            <input type="submit" value="Justificar" name="justificar">
                    </form>
                </div>
            </div>
        <?php

        }
    }
}


if (isset($_POST['historial'])) {
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
        $historial = "SELECT faltasjustificadas.idalumno, faltasjustificadas.idmateria,faltasjustificadas.motivo, alumnos.nombres as Alumno, materias.nombre as Materia, faltasjustificadas.fecha_a_justificar as 'fecha justificada', faltasjustificadas.fecha_justificado as 'Fecha de justificante' from faltasjustificadas INNER JOIN alumnos ON faltasjustificadas.idalumno = alumnos.id_alumnos INNER JOIN materias ON faltasjustificadas.idmateria = materias.id_materia WHERE fecha_justificado >= '" . $lunes . "' AND fecha_justificado <= '" . estasemana() . "' AND profesor = '" . $_SESSION['matricula'] . "'";

        $ejecuta = mysqli_query($mysqli, $historial);

        if (mysqli_num_rows($ejecuta) > 0) {
        ?>
            <div class="histo" id="histo">
                <div class="hisform">
                    <form action="Controllers/justificar.php" method="POST">
                        <a onclick="cierra()">X</a>
                        <table border="1">

                            <tr>
                                <th>Alumno</th>
                                <th>Materia</th>
                                <th>Motivo</th>
                                <th>Fecha Justificada</th>
                                <th>Fecha de Justificación</th>
                            </tr>
                            <?php
                            while ($rows = $ejecuta->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<input type='text' class='lista'  value='".$rows['idalumno']."' name='alumnos[]' style='display: none;'>";
                                echo $rows['Alumno'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input type='text' class='lista'  value='".$rows['idmateria']."' name='materias[]'style='display: none;' >";
                                echo $rows['Materia'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input type='text' class='lista'  value='".$rows['idmateria']."' name='materias[]'style='display: none;' >";
                                echo $rows['motivo'];
                                echo "</td>";
                                echo "<td>";
                                echo "<input type='text' name='fecha2[]' value='" . $rows['fecha justificada'] . "' style='display: none;' > ";
                                //echo "<input type='date' name='fecha1[]' value='" . $rows['fecha justificada'] . "' >";
                                echo $rows['fecha justificada'];
                                echo "</td>";
                                echo "<td>";
                                echo $rows['Fecha de justificante'];
                                echo "</td>";
                                echo "</tr>";
                            }

                            ?>

                        </table>
                        <!-- <input type="submit" value="Corregir Fechas" name="corregir" class="corregir">-->
                    </form>
                </div>

            </div>

<?php
        } else {
            
            echo "<td><label>No hay faltas registradas</label></td>";
        }
    }
}

?>