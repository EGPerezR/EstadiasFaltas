<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icono/bateil png.ico">
    <title>Document</title>
</head>
<body>
<nav>
<?php
include("Controllers/conexion.php");
    session_start();
    if (isset($_SESSION['matricula'])){
        $admin = $_SESSION['matricula'];
        
        $nombre = "SELECT nombre from profesores where matricula = '$admin' Limit 1";
        $result = mysqli_query($mysqli,$nombre)  or die(mysqli_error($mysqli));
        $rows = mysqli_fetch_array($result);

        
            echo "<label style='color:red;'>Biendvenid@ </label>".$rows['nombre'];
        
    }else{
 header('Location: index.php');//Aqui lo redireccionas al lugar que quieras.
     die() ;
    }

    ?>

    <form action="Controllers/cerrars.php">
    <input type="submit" value="Cerrar session">
    </form>
    </nav>
    
</body>
</html>

