<?php
session_start();
require 'Controllers/conexion.php';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/gestion.css">
    <title>Document</title>
</head>

<body>
    <header>
        <div class="menu_bar">
            <a href="#" class="bt-menu"><span class="icon-list2"></span>Menu</a>
        </div>
        <nav class="lista">
            <ul class="nav-excel">
                <li><a href='welcome.php' class="bt-menu">Regresar</a></li>

            </ul>
        </nav>
    </header>
    <div>

        <div class="gestion" id="gestion">
            <button id="button1" onclick="mosta()">Activos</button>
            <button id="button2" onclick="mostc()">Cambio de grado y seccion</button>
            <center><button id="button3" onclick="mostg()">Gestion por Covid</button></center>
        </div>
        <div id="activos" class="formG">
            <div class="faltas">
                <form action="GestionA.php" method="POST">
                    <label style="font-size: 20px;
    color: rgb(255, 255, 255);
    background-color: rgb(0, 0, 0);
    font-style: unset;">Activo / Inactivo</label><a onclick="cerrara()" style="float: right; color:red; font-size: 20px; cursor:pointer;">X</a>
                    <br>
                    <br>
                    <label class="letra">Seleccione Especialidad</label>
                    <select name="especialidad" id="especialidad" oninput="enablegradoa()">
                        <option value="">...</option>
                        <option value="1">Combustion Interna</option>
                        <option value="2">Maquinas y herramientas</option>
                        <option value="3">Electricidad</option>
                        <option value="4">Sistemas</option>
                        <option value="5">Mecatronica</option>
                    </select>
                    <lablel>Seleccione Grado</lablel>
                    <select name="grado" disabled id="grado" oninput="enablesecciona()">
                        <option value="">...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <lablel>Seleccione Seccion</lablel>
                    <select name="seccion" disabled id="seccion">
                        <option value="">...</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                    </select>
                    <input type="submit" value="Buscar" name="activo">
                </form>
            </div>
        </div>
        <div id="jaja" class="formG">
            <div class="faltas">
                <form action="GestionA.php" method="POST">
                    <label style="font-size: 20px;
    color: rgb(255, 255, 255);
    background-color: rgb(0, 0, 0);
    font-style: unset;">Cambio de Grado y Seccion</label><a onclick="cerrarc()" style="float: right; color:red; font-size: 20px; cursor:pointer;">X</a>
                    <br>
                    <br>
                    <label class="letra">Seleccione Especialidad</label>
                    <select name="especialidad" id="especialidadc" oninput="enablegradoc()">
                        <option value="">...</option>
                        <option value="1">Combustion Interna</option>
                        <option value="2">Maquinas y herramientas</option>
                        <option value="3">Electricidad</option>
                        <option value="4">Sistemas</option>
                        <option value="5">Mecatronica</option>
                    </select>
                    <lablel>Seleccione Grado</lablel>
                    <select name="grado" disabled id="gradoc" oninput="enableseccionc()">
                        <option value="">...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <lablel>Seleccione Seccion</lablel>
                    <select name="seccion" disabled id="seccionc">
                        <option value="">...</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                    </select>
                    <input type="submit" value="Buscar" name="cambio">
                </form>
            </div>
        </div>
        <div id="numa" class="formG">
            <div class="faltas">
                <form action="GestionA.php" method="POST">
                    <label style="font-size: 20px;
    color: rgb(255, 255, 255);
    background-color: rgb(0, 0, 0);
    font-style: unset;">Division de Grupos</label><a onclick="cerrarg()" style="float: right; color:red; font-size: 20px; cursor:pointer;">X</a>
                    <br>
                    <br>
                    <label class="letra">Seleccione Especialidad</label>
                    <select name="especialidad" id="espe" oninput="enablegradog()">
                        <option value="">...</option>
                        <option value="1">Combustion Interna</option>
                        <option value="2">Maquinas y herramientas</option>
                        <option value="3">Electricidad</option>
                        <option value="4">Sistemas</option>
                        <option value="5">Mecatronica</option>
                    </select>
                    <lablel>Seleccione Grado</lablel>
                    <select name="grado" disabled id="gra" oninput="enablesecciong()">
                        <option value="">...</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                    </select>
                    <lablel>Seleccione Seccion</lablel>
                    <select name="seccion" disabled id="sec">
                        <option value="">...</option>
                        <option value="1">A</option>
                        <option value="2">B</option>
                    </select>
                    <input type="submit" value="Buscar" name="covid">
                </form>
            </div>
        </div>
    </div>

    <?php
    include('Controllers/gestion.php');
    ?>
</body>
<script src="js/gestion.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
    $(document).ready(main);

    var contador = 1;

    function main() {
        $('.menu_bar').click(function() {
            // $('nav').toggle(); 

            if (contador == 1) {
                $('.lista').animate({
                    left: '0'
                });
                contador = 0;
            } else {
                contador = 1;
                $('.lista').animate({
                    left: '-100%'
                });
            }

        });

    };



    function mosta() {
        document.getElementById('activos').style.display = "block";
    }

    function cerrara() {
        document.getElementById('activos').style.display = "none";
    }

    function mostc() {
        document.getElementById('jaja').style.display = "block";
    }

    function cerrarc() {
        document.getElementById('jaja').style.display = "none";
    }

    function mostg() {
        document.getElementById('numa').style.display = "block";
    }

    function cerrarg() {
        document.getElementById('numa').style.display = "none";
    }

    function cierra() {
        document.getElementById('tablafa').style.display = "none";
    }


    
function enablegradog() {
    var combo = document.getElementById("espe");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('gra').disabled = true;
        return false;
    } else {
        document.getElementById('gra').disabled = false;
    }
}

function enablesecciong() {
    var combo = document.getElementById("gra");
    var selected = combo.options[combo.selectedIndex].text;
    if (selected == '...') {
        document.getElementById('sec').disabled = true;
        return false;
    } else {
        document.getElementById('sec').disabled = false;
    }
}
</script>

</html>