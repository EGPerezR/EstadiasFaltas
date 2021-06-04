<?php
include('conexion.php');
$grado = $_POST['grado'];
$espe = $_POST['especialidad'];
$materias = "SELECT nombre from materias where grado = $grado and especialidad = $espe";
$result = mysqli_query($mysqli, $materias);
?>
<table class="table table-light" border="1">
    <thead>
        <tr>
            <td></td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>





<?php



?>