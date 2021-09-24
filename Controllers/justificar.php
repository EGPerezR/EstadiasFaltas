<?php
session_start();
include('conexion.php');

if (isset($_POST['justificar'])) {
    $materia = $_POST['materiaj'];
    $alumno = $_POST['alumno'];
    $motivo = $_POST['motivo'];

    //Contruccion de la fecha
    if (!empty($_POST["fecha"]) && is_array($_POST["fecha"])) {
        $fechj = array();
        foreach ($_POST["fecha"] as $fehcajus) {
            $fechj[] = $fehcajus;
        }
    }


    for ($i = 0; $i < count($fechj); $i++) {
        $justificalo = "INSERT INTO faltasjustificadas (idalumno, idmateria, profesor, motivo, fecha_a_justificar, fecha_justificado) VALUES (" . $alumno . ", " . $materia . ", '".$_SESSION['matricula']."', '".$motivo."','" . $fechj[$i] . "', '" . date("Y-m-d") . "')";

        $selectf = "SELECT faltas from faltas where dia_registro = '" . $fechj[$i] . "' AND id_alumno = " . $alumno . " AND id_materia = " . $materia . " LIMIT 1";
        $sleccion = mysqli_query($mysqli, $selectf);
    
        
        if (mysqli_num_rows($sleccion) > 0) {
            
            while ($faltaa = $sleccion->fetch_assoc()) {
                if($faltaa['faltas']==1){
                $resta = $faltaa['faltas'] - 1;
                

                $cambia = "UPDATE faltas SET faltas = $resta WHERE dia_registro = '" . $fechj[$i] . "' AND id_alumno = " . $alumno . " AND id_materia = " . $materia . "";

                $cambio = mysqli_query($mysqli,$cambia);
                $justifica = mysqli_query($mysqli, $justificalo);
                if($justifica){
                    header('Location:../justificacion.php');
                }
            } else {
                echo "no hay registro de una falta de ese dia <a style='font-size: 20px; ' href='../justificacion.php'>Regresar...</a>";
            }
            }
        } else{
            echo "no hay registro de una falta de ese dia <a style='font-size: 20px; ' href='../justificacion.php'>Regresar...</a>";
        }


        
    }


}


if(isset($_POST['corregir'])){
    //contruccion de alumnos
    if (!empty($_POST["alumnos"]) && is_array($_POST["alumnos"])) {
        $alumn = array();
        foreach ($_POST["alumnos"] as $al) {
            $alumn[] = $al;
        }
    }

    //construccion de materias
    if (!empty($_POST["materias"]) && is_array($_POST["materias"])) {
        $materia = array();
        foreach ($_POST["materias"] as $mate) {
            $materia[] = $mate;
        }
    }

    //Construccion de fechas a justificar
    if (!empty($_POST["fecha1"]) && is_array($_POST["fecha1"])) {
        $fechj1 = array();
        foreach ($_POST["fecha1"] as $fehcajus1) {
            $fechj1[] = $fehcajus1;
        }
    }

    //construccion de fechas justificadas para el where
    if (!empty($_POST["fecha2"]) && is_array($_POST["fecha2"])) {
        $fechj2 = array();
        foreach ($_POST["fecha2"] as $fehcajus2) {
            $fechj2[] = $fehcajus2;
        }
    }
    

    for($i=0; $i<count($alumn); $i++){
        $upd = "UPDATE faltasjustificadas SET fecha_a_justificar = '".$fechj1[$i]."', fecha_justificado = '".date("Y-m-d")."' WHERE fecha_a_justificar = '".$fechj2[$i]."' AND profesor = '".$_SESSION['matricula']."' AND idalumno = ".$alumn[$i]." AND idmateria = ".$materia[$i]."";

        echo $upd;
    }

}