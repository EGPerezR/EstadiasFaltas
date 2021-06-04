<?php

session_start();

include("conexion.php");
require('funcs.php');

//Mandamos a pedir datos del index
$id_matri = $_POST['matricula'];
$pass = $_POST['contra'];
//Consulta segura

?>

<h1>
<?php
if(empty($_POST['matricula']) || empty($_POST['contra'])){
    echo "campos faltantes, "; ?>

<a href = "../index.php" style="color: red;">intente de nuevo</a></h1>
    <?php
    
}else{
    $sql = "SELECT matricula, nombre, tipo_usuario, usuario FROM profesores WHERE matricula = '$id_matri' or usuario = '$id_matri' and contrasena = '$pass' LIMIT 1";
  $resultado = mysqli_query($mysqli, $sql) or die(mysqli_error($conexion));
    if(mysqli_num_rows($resultado) > 0)
    {
        while($guarda = $resultado->fetch_assoc()){
        $_SESSION['matricula'] = $guarda['matricula'];
        $_SESSION['usuairo'] = $guarda['usuario'];
        }

        guardausuario($_SESSION['matricula']);


        $usuario = $mysqli->query($sql);
        $fila = mysqli_fetch_array($usuario);

        // Redirecciono al usuario a la página principal del sitio.
        header("HTTP/1.1 302 Moved Temporarily"); 
        
            
             
          
                header("Location: ../welcome.php");
                 
        
 
    }else{
        echo '<h1 style= color:red;>El Usuario o password es incorrecto, <a href="../index.php">vuelva a intenarlo</a><h1><br/>';
        echo $result;
    }
}



?>