<?php
session_start();
require_once 'conexion.php';
require 'fecha.php';
date_default_timezone_set('America/Monterrey');

if (isset($_POST['insert'])) {
    //Construccion de las casillas
    if (!empty($_POST['sancion']) && is_array($_POST['sancion'])) {
        $sancion = array();

        foreach ($_POST["sancion"] as $actividad) {
            $sancion[] = $actividad;
        }
    } else {
        echo "nada paso";
    }

    //construccion de alumnos
    if (!empty($_POST['alumno']) && is_array($_POST['alumno'])) {
        $alumno = array();

        foreach ($_POST['alumno'] as $persona) {
            $alumno[] = $persona;
        }
    }

    $materia = $_POST['materia'];
  
    for ($j = 0; $j < count($sancion); $j++) {
        echo "a";
        $insert = "INSERT INTO no_trabaja (alumno, materia, fecha, hora, maestro) VALUES (" . $alumno[$sancion[$j]] . ", $materia, '" . date("Y-m-d") . "', '" . date('h:i:s') . "'," . $_SESSION['matricula'] . ")";
        echo $insert."<br>";
        $noT = mysqli_query($mysqli, $insert);       
    }

    header('Location: ../reportes.php');

    
}
