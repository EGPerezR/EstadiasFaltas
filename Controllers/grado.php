<?php
require 'conexion.php';
$especialidad = $_POST['especialidad'];
$grado = $_POST['grado'];

$seccion = "SELECT seccion from alumnos where alumnos.especialidad = ".$especialidad." and alumnos.grado = ".$grado." GROUP BY seccion";
$espe = mysqli_query($mysqli,$seccion);

if(mysqli_num_rows($espe)>0){
    //echo "<select  name='gra' id='gra'>";
    echo "<option value = '...'>...</option>";
    while($rows = $espe->fetch_assoc()){
        if($rows['seccion']==1){
            $sec = 'A';
        }
        if($rows['seccion']==2){
            $sec = 'B';
        }
        if($rows['seccion']==3){
            $sec = 'C';
        }
        echo "<option value = '".$rows['seccion']."'>".$sec."</option>";
        
    }
    //echo "</select>";
}


?>