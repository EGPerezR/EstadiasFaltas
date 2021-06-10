<?php
require 'Controllers/funcs.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="icono/bateil png.ico">
    <link rel="stylesheet" href="css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafica de faltas</title>
</head>

<body>
    <ul class="nav-excel">

        <li>
            <a class="nav-link disabled" href="welcome.php" tabindex="-1" aria-disabled="true">return</a>
        </li>
    </ul>
    <div class="formfaltas">
        <form action="" method="POST">
            <label>Especialidad: </label>
            <select name="especialidad" id="especialidad" oninput="enablegra()">
                <option value="">...</option>
                <option value="1">Combustion Interna</option>
                <option value="2">Maquinas y herramientas</option>
                <option value="3">Electricidad</option>
                <option value="4">Sistemas</option>
                <option value="5">Mecatronica</option>
            </select>

            <label>Grado: </label>
            <select name="grado" id="grado" disabled oninput="enablesecc()">
                <option value="">...</option>
                <option value="1">1ero</option>
                <option value="2">2do</option>
                <option value="3">3ero</option>
                <option value="4">4to</option>
                <option value="5">5to</option>
                <option value="6">6to</option>
            </select>



            <label>Seccion: </label>
            <select name="seccion" id="seccion" disabled oninput="enablesemana()">
                <option value="">...</option>
                <option value="1">A</option>
                <option value="2">B</option>
            </select>

            <label>De la semana: (escoger inicio de la semana -> lunes)</label>
            <input type="date" name="semana" id="semana" disabled>
            <input type="submit" value="buscar" name="buscar">
        </form>
    </div>

    <?php
    include('Controllers/muestabl.php');
    ?>

</body>
<script type="text/javascript">
    function enablegra() {
        var combo = document.getElementById("especialidad");
        var selected = combo.options[combo.selectedIndex].text;
        if (selected == '...') {
            document.getElementById('grado').disabled = true;
            return false;
        } else {
            document.getElementById('grado').disabled = false;
        }
    }

    function enablesecc() {
        var combo = document.getElementById("grado");
        var selected = combo.options[combo.selectedIndex].text;
        if (selected == '...') {
            document.getElementById('seccion').disabled = true;
            return false;
        } else {
            document.getElementById('seccion').disabled = false;
        }
    }

    function enablesemana() {
        var combo = document.getElementById("seccion");
        var selected = combo.options[combo.selectedIndex].text;
        if (selected == '...') {
            document.getElementById('semana').disabled = true;
            return false;
        } else {
            document.getElementById('semana').disabled = false;
        }
    }

    function offtab() {
        document.getElementById("tabfal").style.display = "none";
    }
</script>

</html>