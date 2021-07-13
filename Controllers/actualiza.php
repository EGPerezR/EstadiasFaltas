<?php
include('conexion.php');
require 'funcs.php';
$a;
$s;
if (isset($_POST['update'])) {
    //Construccion de Alumnos Activos
    if (!empty($_POST["alumno"]) && is_array($_POST["alumno"])) {
        $alumno = array();
        foreach ($_POST["alumno"] as $al) {

            $alumno[] = $al;
        }
    } else {
        echo "nada paso";
    }

    if (!empty($_POST["activo"]) && is_array($_POST["activo"])) {
        $activo = array();
        foreach ($_POST["activo"] as $activar) {

            $activo[] = $activar;
        }
    } else {
        echo "nada paso";
    }

    if (count($alumno) == count($activo)) {
       
        for ($i = 0; $i < count($alumno); $i++) {
            if($activo[$i]=='NA'){
                $a = 0;
               }elseif($activo[$i]=='A'){
                   $a = 1;
               }
            $up = 'UPDATE alumnos SET activo = '.$a.' WHERE id_alumnos = '.$alumno[$i].'';
            $ejecutar = mysqli_query($mysqli, $up);
            echo $up;
        }

        header('Location: ../GestionA.php');
        
    }
}


if(isset($_POST['camb'])){
    $grado = $_POST['grad'];
//Construccion de Alumnos Activos
if (!empty($_POST["alumno"]) && is_array($_POST["alumno"])) {
    $alumno = array();
    foreach ($_POST["alumno"] as $al) {

        $alumno[] = $al;
    }
} else {
    echo "nada paso";
}


//construccion de seccion
if (!empty($_POST["seccion"]) && is_array($_POST["seccion"])) {
    $sec = array();
    foreach ($_POST["seccion"] as $secc) {

        $sec[] = $secc;
    }
} else {
    echo "nada paso";
}

if (count($alumno) == count($sec)) {
   
    for ($i = 0; $i < count($alumno); $i++) {
        
        if($sec[$i] =='A' || $sec[$i] =='a'){
            $s = 1;
            
           }elseif($sec[$i] =='B' || $sec[$i] =='b'){
               $s = 2;
               
           }elseif($sec[$i]=='C' || $sec[$i]=='c' ){
               $s = 3;
               
           }
        $up = 'UPDATE alumnos SET grado = '.$grado.', seccion = '.$s.' WHERE id_alumnos = '.$alumno[$i].'';
        $ejecutar = mysqli_query($mysqli, $up);
       
        
    }

    header('Location: ../GestionA.php');
    
}


}

if(isset($_POST['cov'])){
//Construccion de Alumnos Activos
if (!empty($_POST["alumno"]) && is_array($_POST["alumno"])) {
    $alumno = array();
    foreach ($_POST["alumno"] as $al) {

        $alumno[] = $al;
    }
} else {
    echo "nada paso";
}
//constuccion de grado
if (!empty($_POST["grupo"]) && is_array($_POST["grupo"])) {
    $grupo = array();
    foreach ($_POST["grupo"] as $gru) {

        $grupo[] = $gru;
    }
} else {
    echo "nada paso";
}

if(count($alumno) == count($grupo)){
    for($i=0; $i<count($alumno); $i++){
            $up = 'UPDATE alumnos SET grupo = '.$grupo[$i].' WHERE id_alumnos = '.$alumno[$i].'';
            $ejecutar = mysqli_query($mysqli, $up);
            
    }

    header('Location: ../GestionA.php');
}



}