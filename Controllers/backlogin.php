<?php

use ZipStream\Option\Method;

session_start();

include("conexion.php");
require('funcs.php');
if(isset($_POST['Iniciar'])){
//Mandamos a pedir datos del index
$id_matri = $_POST['matricula'];
$pass = $_POST['contra'];
//Consulta segura

?>

<h1>
    <?php
    if (empty($_POST['matricula']) || empty($_POST['contra'])) {
        echo "campos faltantes "; ?>

        <a href="../index.php" style="color: red;">intente de nuevo</a>
</h1>
<?php

    } else {

            login($id_matri, $pass);

    }

}

?>