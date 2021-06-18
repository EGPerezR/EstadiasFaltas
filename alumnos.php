<?php
session_start();
if (isset($_SESSION['matricula'])) {
} else {
    header('Location: index.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Insertar Alumnos</title>

    <ul class="nav-excel">
        
        <li>
            <a class="nav-link disabled" href="welcome.php" tabindex="-1" aria-disabled="true">return</a>
        </li>
    </ul>
</head>

<body>
    <div class="form">
        <form action="alumnos.php" method="POST" enctype="multipart/form-data">
            <label for="lista">Elegir una lista: </label>
            <input type="file" name="fichero_usuario">

            <br>
            <input type="submit" value="Subir" name="Insertar">
        </form>
    </div>
    <?php
    include 'Controllers/leer.php';

    ?>
</body>


<script type="text/javascript">
    function actualizar() {
        location.reload(true)
    };

    function confirm() {
        var x = document.getElementById("confirmado");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }

    function mossec() {
        var combo = document.getElementById("especialidad");
        var selected = combo.options[combo.selectedIndex].text;
        if (selected == '...') {
            document.getElementById('seccion').disabled = true;
            return false;
        } else {
            document.getElementById('seccion').disabled = false;
        }
    }

    function off() {
        document.getElementById("tablaexcel").style.display = "none";
    }

    function cerrar(){
        document.getElementById('advertencia').style.display = "none";
        document.getElementById('tablaexcel').style.display = "none";
        
    }
</script>

</html>