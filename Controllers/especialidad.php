<?php
require 'conexion.php';
$especialidad = $_POST['especialidad'];

$grado = "SELECT grado from alumnos where alumnos.especialidad = ".$especialidad." GROUP BY grado";
$espe = mysqli_query($mysqli,$grado);

if(mysqli_num_rows($espe)>0){
    //echo "<select  name='gra' id='gra'>";
    echo "<option value = '...'>...</option>";
    while($rows = $espe->fetch_assoc()){
        $resultado = "<option value = '".$rows['grado']."'>".$rows['grado']."</option>";
        echo $resultado;
    }
    //echo "</select>";
}


?>