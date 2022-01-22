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
    <link rel="stylesheet" href="css/visrepo.css">
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
    <div class="contenedor">
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <div >
                <label>"{Alumno}" Quejas de no trabajo</label>
            </div>
            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>ciencias</td>
                </tr>
                <tr>
                    <td>TLR</td>
                </tr>
                <tr>
                    <td>Diseño</td>
                </tr>
                <tr>
                    <td>Diseño</td>
                </tr>
                <tr>
                    <td>Diseño</td>
                </tr>
            </table>
        </div>
        <div class="inforepo">
            <label>"{Alumno}" Quejas de no trabajo</label>

            <table>
                <tr>
                    <th></th>
                </tr>
                <tr>
                    <td>Matematicas</td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>