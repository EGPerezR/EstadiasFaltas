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
            <label for="por dia">Por Día</label>
            <input type="checkbox" name="seleccion1" id="dia" onclick="showfe()" value="1">
            <label for="por dia">Por Semana</label>
            <input type="checkbox" name="seleccion2" id="semana" onclick="showfe()" value="1">
            <label for="por dia">Por Mes</label>
            <input type="checkbox" name="seleccion3" id="mes" onclick="showfe()" value="1">
            <br> 
            <br> 
            <div id="fecha1" style="display: none;">
                <label>Seleccione Dia</label>
                <input type="date" name="semana" id="semana1" disabled>
                <input type="submit" value="buscar" name="buscar">
            </div>
            <div id="fecha2" style="display: none;">
                <label>Seleccione semana: (inicio de la semana -> lunes)</label>
                <input type="date" name="semana" id="semana2" disabled>
                <input type="submit" value="buscar" name="buscar">
            </div>
            <div id="fecha3" style="display: none;">
                <label>Seleccione Mes:</label>
                <select name="mes" id="semana3" disabled>
                <option value="Enero">Enero</option>
                <option value="Febrero">Febrero</option>
                <option value="Marzo">Marzo</option>
                <option value="Abril">Abril</option>
                <option value="Mayo">Mayo</option>
                <option value="Junio">Junio</option>
                <option value="Julio">Julio</option>
                <option value="Agosto">Agosto</option>
                <option value="Septiembre">Septiembre</option>
                <option value="Octubre">Octubre</option>
                <option value="Noviembre">Noviembre</option>
                <option value="Diciembre">Diciembre</option>
                </select>
                <input type="submit" value="buscar" name="buscar">
            </div>
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

    function alerta() {
        alert("Su tabla se ha creado exitosamente y se descargo :D");
    }



    function showfe() {
        element1 = document.getElementById("fecha1");
        check1 = document.getElementById("dia");
        element2 = document.getElementById("fecha2");
        check2 = document.getElementById("semana");
        element3 = document.getElementById("fecha3");
        check3 = document.getElementById("mes");
        if (check1.checked) {
            
            document.getElementById('semana1').disabled = false;
            element3.style.display = 'none';
            element1.style.display = 'block';
            element2.style.display = 'none';
        } else {
            element1.style.display = 'none';
        }
        if (check2.checked) {
            
            element2.style.display = 'block';
            element1.style.display = 'none';
            document.getElementById('semana2').disabled = false;
            document.getElementById('semana3').disabled = true;
            document.getElementById('semana1').disabled = true;
            element3.style.display = 'none';
        } else {
            element2.style.display = 'none';
        }
        if (check3.checked) {
            element3.style.display = 'block';
            element1.style.display = 'none';
            document.getElementById('semana3').disabled = false;
            document.getElementById('semana2').disabled = true;
            document.getElementById('semana1').disabled = true;
            element2.style.display = 'none';
        } else {
            element3.style.display = 'none';
        }
    }
</script>

</html>