<?php
require 'conexion.php';
if (isset($_POST['faltma'])) {
    $especialidad = $_POST['espe'];
    $grado = $_POST['grado'];
    $seccion = $_POST['sec'];
    $materia = $_POST['mate'];

 
    $alumno = "SELECT alumnos.nombres from alumnos where especialidad = $especialidad and grado = $grado and seccion = $seccion";
    $filtro = mysqli_query($mysqli, $alumno);

    if (mysqli_num_rows($filtro) > 0) {
        echo "<table id='CFt' style='border-collapse: collapse;
        background-color: white; position: absolute; left:30%; border-radius: 5%;'>";
                echo "<tr style='background-color:red; color: white;'>";
                echo "<td>Alumno</td>";
                echo "<td>Total Faltas de la primera Unidad</td>";
                echo "</tr>";
                
        while ($alumnos = $filtro->fetch_assoc()) {
            $consulta = "SELECT alumnos.nombres as Alumno, SUM(faltas.faltas) as falta from faltas INNER JOIN alumnos on faltas.id_alumno = alumnos.id_alumnos INNER JOIN materias on faltas.id_materia=materias.id_materia where faltas.id_materia = $materia AND alumnos.nombres = '" . $alumnos['nombres'] . "' AND faltas.dia_registro >= '2021-09-01' AND faltas.dia_registro <= '2021-09-30'";
            $ejecuta = mysqli_query($mysqli,$consulta);
       
            if(mysqli_num_rows($ejecuta)>0) {
                while($faltas = $ejecuta->fetch_assoc()){
                    echo "<tr>";
                    if ($faltas['falta']==''){
                        echo "<td>".$faltas['Alumno']."</td><td>0</td>";
                    } else{
                        echo "<td>".$faltas['Alumno']."</td><td>".$faltas['falta']."</td>";
                    }
                    
                    echo "</tr>";
                }
            }
        }
        echo "</table>";
    } else {
        
    }
}
