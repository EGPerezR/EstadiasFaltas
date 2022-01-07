<?php
require('conexion.php');

$tabla = "select profesores.nombre as Profesor, profesores.tipo_usuario ,pasemaestros.hora as Hora, pasemaestros.fecha as Fecha from pasemaestros inner join profesores on pasemaestros.maestro=profesores.matricula ";
$tabular = mysqli_query($mysqli, $tabla);
if (mysqli_num_rows($tabular) > 0) {
    while ($row = $tabular->fetch_assoc()) {
        if ($row['tipo_usuario'] != 4) {
            if ($row['Fecha'] = date("Y-m-d")) {

?>
                <table>

                    <tr>
                        <th>Maestro</th>
                        <th>Hora</th>
                    </tr>
                    <tr>
                        <td><?php echo $row['Profesor']; ?></td>
                        <td><?php echo $row['Hora'] ?></td>
                    </tr>

                </table>

<?php
            }
        }
    }
} else {
    echo "no ha entrado nadie";
}







?>