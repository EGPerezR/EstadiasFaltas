<?php
require 'conexion.php';
$especialidad = $_POST['especialidad'];
$grado = $_POST['grado'];

$materia = "SELECT id_materia, nombre from materias where materias.especialidad = ".$especialidad." and materias.grado = ".$grado."";
$mate = mysqli_query($mysqli,$materia);

if(mysqli_num_rows($mate)>0){
    //echo "<select  name='gra' id='gra'>";
    echo "<option value = '...'>...</option>";
    while($rows = $mate->fetch_assoc()){
        echo "<option value = '".$rows['id_materia']."'>".$rows['nombre']."</option>";
        
    }
    //echo "</select>";
}