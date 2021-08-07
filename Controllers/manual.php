<?php

require 'conexion.php';
if(isset($_POST['manual'])){
    $nombres = $_POST['nombres'];
    $espe = $_POST['especialidad'];
    $seccion = $_POST['seccion'];

    $insert = "INSERT INTO alumnos (nombres,especialidad,grado,seccion, activo) VALUES ('" . $nombres. "'," . $espe . ",1," . $seccion . ", 1)";
    $ejecutar = mysqli_query($mysqli,$insert);
    if($ejecutar){
        echo '<script>
        alert("Alumno Insertado");
      </script>';
    }
    
}