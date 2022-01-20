<?php
require('conexion.php');
$maes = 'SELECT profesores.nombre from profesores where tipo_usuario = 2 ORDER BY nombre ASC';
$preparar = mysqli_query($mysqli, $maes);

if ($preparar->num_rows > 0) {


?>
    <table border="1" style="background-color: white;">

        <tr>
            <th>Maestro</th>
            <th>Asistencia</th>

        </tr>
        <?php

while ($profesores = $preparar->fetch_assoc()){
            $pasemaes = 'SELECT pasemaestros.maestro from pasemaestros INNER JOIN profesores on pasemaestros.maestro = profesores.matricula where profesores.nombre = "'.$profesores['nombre'].'" and fecha = "'.date("Y-m-d").'"';
            $pase = mysqli_query($mysqli,$pasemaes);
            
    ?>
        <tr>
            <td><?php echo $profesores['nombre']   ?></td><td style="<?php if($pase->num_rows >0){ echo 'background-color: green';}  ?>"></td>
        </tr>
    <?php
        }
    ?>
    </table>


<?php

}
?>