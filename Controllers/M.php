<?php
require 'conexion.php';
require 'lunesEs.php';

$filtro5 = "SELECT alumnos.nombres as nombres, alumnos.grado as grado, alumnos.seccion as seccion, alumnos.especialidad as especialidad, SUM(faltas.faltas) as faltas from faltas INNER JOIN alumnos on faltas.id_alumno=alumnos.id_alumnos WHERE faltas.semana >= '".$lunes."' AND especialidad = 5 GROUP BY alumnos.nombres ORDER BY faltas DESC LIMIT 10";
$Me = mysqli_query($mysqli, $filtro5);
if (mysqli_num_rows($Me) > 0) {
?>

<tr>
    <th colspan="5">M</th>
</tr>
<tr>    
    <td>#</td>
    <td>Nombres</td>
    <td>Grado</td>
    <td>Seccion</td>
    <td>Faltas</td>
</tr>

<?php
$i = 1;
while ($row = $Me->fetch_assoc()) {

    echo "<tr>";
    echo "<td>";
    echo $i;
    $i++;
    echo "</td>";
    echo "<td>";
    echo $row['nombres'];
    echo "</td>";
    echo "<td id='1'>";
    echo $row['grado']."°";
    echo "</td>";
    echo "<td class='ja'>";
    if($row['seccion']==1){
        echo "A";
    } elseif($row['seccion']==2){
        echo "B";
    }else{
        echo "C";
    }
    echo "</td>";
    echo "<td>";
    echo $row['faltas'];
    echo "</td>";
    echo "</tr>";
}
} else {
    ?>

    <tr>
        <th colspan="5">M</th>
    </tr>
    <tr>
        <td>Aun No hay Datos del Dia</td>
    </tr>


<?php
}

