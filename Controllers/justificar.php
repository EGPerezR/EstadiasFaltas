<?php
include('conexion.php');

if (isset($_POST['justificar'])) {
    $materia = $_POST['materiaj'];
    $alumno = $_POST['alumno'];

    //Contruccion de la fecha
    if (!empty($_POST["fecha"]) && is_array($_POST["fecha"])) {
        $fechj = array();
        foreach ($_POST["fecha"] as $fehcajus) {
            $fechj[] = $fehcajus;
        }
    }


    for ($i = 0; $i < count($fechj); $i++) {
        $justificalo = "INSERT INTO faltasjustificadas (idalumno, idmateria, fecha_a_justificar, fecha_justificado) VALUES (" . $alumno . ", " . $materia . ", '" . $fechj[$i] . "', '" . date("Y-m-d") . "')";
       

        $selectf = "SELECT faltas from faltas where dia_registro = '" . $fechj[$i] . "' AND id_alumno = " . $alumno . " AND id_materia = " . $materia . " LIMIT 1";
        $sleccion = mysqli_query($mysqli, $selectf);
        
        if (mysqli_num_rows($sleccion) > 0) {
            while ($faltaa = $sleccion->fetch_assoc()) {
                $resta = $faltaa['faltas'] - 1;
                

                $cambia = "UPDATE faltas SET faltas = $resta WHERE dia_registro = '" . $fechj[$i] . "' AND id_alumno = " . $alumno . " AND id_materia = " . $materia . "";

                $cambio = mysqli_query($mysqli,$cambia);
            }
        }


        $justifica = mysqli_query($mysqli, $justificalo);
    }

header('Location:../justificacion.php');
}
