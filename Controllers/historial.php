<?php
require 'conexion.php';

$histo = "SELECT idhistorial, fecha, hora, profesores.nombre as Docente, materias.nombre As Materia, historial.especialidad, historial.grado, historial.seccion from historial INNER JOIN profesores on historial.maestro = profesores.matricula INNER JOIN materias on historial.materia=materias.id_materia ORDER BY idhistorial DESC";
$busca = mysqli_query($mysqli, $histo);
if (mysqli_num_rows($busca) > 0) {
?>

<?php
while($historial = $busca->fetch_assoc()){
    if($historial['especialidad']==1){
        $espe = 'Combustion Interna';
    } else if($historial['especialidad']==2){
        $espe = 'Maquinas Herramientas';
    }else if($historial['especialidad']==3){
        $espe = 'Electricidad';
    }else if($historial['especialidad']==4){
        $espe = 'Sistemas';
    }else if($historial['especialidad']==5){
        $espe = 'Mecatronica';
    }
    if($historial['seccion']==1){
        $secc = 'A';
    } else if($historial['seccion']==2){
        $secc = 'B';
    }
    echo "<tr>";
    echo "<td class='fechahora'>";
    echo $historial['fecha']."<br> ".$historial['hora'];
    echo "</td>";
  
    echo "<td>";
    echo "<label>".$historial['Docente']." ha pasado lista en ".$historial['grado']." de ".$espe." del ".$secc." <a style='color: red;'>(".$historial['Materia'].")</a></label>";
    echo "</td>";
    echo "</tr>";
}
}else {
    echo "<h1>No hay movimientos registrados</h1>";
}
?>