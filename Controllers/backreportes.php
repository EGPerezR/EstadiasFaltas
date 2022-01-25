<?php
require 'funcs.php';
include('conexion.php');
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
        $espe = $_POST['especialidad'];
        $gra = $_POST['grado'];
        $secc = $_POST['seccion'];
        $consulta = "SELECT  id_alumnos, nombres, grado, seccion from alumnos where especialidad = $espe and grado = $gra and seccion = $secc and activo = 1 ORDER BY nombres ASC";
        $materia = "SELECT * from materias where especialidad = $espe and grado = $gra";
        $mate = mysqli_query($mysqli, $materia);
        $ejecuta = mysqli_query($mysqli, $consulta);

        if ($ejecuta->num_rows > 0) {

?>
            <div class="fondorepo" id="fondorepo">
                <div class="formate">
                    <form action="Controllers/reportar.php" method="POST">
                        <label for="">Materia:</label>
                        <select name="materia" id="">
                            <option value="">...</option>
                            <?php
                            if ($mate->num_rows > 0) {
                                while ($rows = $mate->fetch_assoc()) {
                                    echo "<option value='".$rows['id_materia']."'>".$rows['nombre']."</option>";
                                }
                            }
                            ?>
                            
                        </select>
                        <input type="submit" value="Enviar" name="insert">
                </div>

                <table>
                    <tr>
                        <th>Alumno <a id="cerrarep" onclick="cerrarepo()">X</a></th>
                        <th>No trabaja</th>
                    </tr>
                    <?php
                    $i = 0;
                    while ($row = $ejecuta->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['nombres'] . "<input type='text' name='alumno[]' hidden value='".$row['id_alumnos']."'</td>";
                        echo "<td><input type='checkbox' name='sancion[]' value='".$i."'>";
                        $i++;
                        echo "</tr>";
                    }

                    ?>
                </table>
                
                </form>
            </div>
<?php
        } else {
            echo "<script>alert('cagaste');</script>";
        }
    }
}
