<?php
require 'funcs.php';
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
            <div class="fondojustifica">
                <div class="justifiform">
                    <a style="color: red; cursor:pointer;" onclick="cie()">X</a>
                    <br>
                    <form action="">
                        <select class="alumjus">
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
                            <select id="selemateria">
                            <?php
                            while ($materiasli = $mate->fetch_assoc()) {
                                //muestra las materias
                                echo "<option value='" . $materiasli['id_materia'] . "'>" . $materiasli['nombre'] . "</option>";
                            }
                        }
                            ?>
                            </select>
                            <b><label for="cantidad">Presione para agregar fecha</label></b>
                            <input type="button" value=">>" id="btn_agregar" onclick="crearDin()">
                            <br>
                            <div id="mosdate">

                            </div>
                            <input type="submit" value="Justificar">
                    </form>
                </div>
            </div>
<?php

        }
    }
}

?>