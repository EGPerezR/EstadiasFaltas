<?php
session_start();
require 'Controllers/lunesEs.php';
$semana = date("W", strtotime($lunes));
include("Controllers/conexion.php");
if (isset($_SESSION['matricula'])) {
} else {
    header('Location: index.php');
}

?>
<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reportes Alumnos</title>
    <link rel="shortcut icon" href="icono/bateil png.ico">
    <link rel="stylesheet" href="css/reporte.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>





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


    <div class="reportes" id="reportes">
        <form action="reportes.php" method="POST">
            <label class="letra">Seleccione Especialidad</label>
            <select name="especialidad" id="especialidad" oninput="enablegrado()">
                <option value="">...</option>
                <option value="1">Combustion Interna</option>
                <option value="2">Maquinas y herramientas</option>
                <option value="3">Electricidad</option>
                <option value="4">Sistemas</option>
                <option value="5">Mecatronica</option>
            </select>
            <lablel>Seleccione Grado</lablel>
            <select name="grado" disabled id="grado" oninput="enableseccion()">
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
            <input type="submit" value="Buscar" name="buscar">
        </form>
    </div>
    <?php
        include('controllers/backreportes.php')
    ?>
    
</body>

<script src="js/reporte.js"></script>
</html>