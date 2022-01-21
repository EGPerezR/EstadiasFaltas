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
        $consulta = "SELECT nombres from alumnos where especialidad = $espe and grado = $gra and seccion = $secc and activo = 1 ORDER BY nombres DESC";
        $ejecuta = mysqli_query($mysqli, $consulta);

        if ($ejecuta->num_rows > 0) {
?>
            <div>

                <?php
                while ($row = $ejecuta->fetch_assoc()) {
                }

                ?>
            </div>

<?php
        } else {
            echo "<script>alert('cagaste');</script>";
        }
    }
}
