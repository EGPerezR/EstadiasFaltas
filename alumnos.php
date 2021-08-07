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
    <div class="alumnuevo" id="alumnuevo">
        <input type="button" value="Insertar alumno manualmente" onclick="Manual()">
        <input type="button" value="Lista de Excel" onclick="Excel()">
    </div>
    <div class="manual" id="manual">
        <form action="alumnos.php" method="POST">
            <label for="Nombres">Nombre Completo</label>
            <input type="text" placeholder="Empiece por los apellidos..." name="nombres">
            <label for="especialidad">Especialidad: </label>
                        <select name="especialidad" id="especialidad" oninput="mossec()">
                            <option value="...">...</option>
                            <option value="1">Combustion Interna</option>
                            <option value="2">Maquinas y herramientas</option>
                            <option value="3">Electricidad</option>
                            <option value="4">sistemas</option>
                            <option value="5">Mecatronica</option>
                        </select>
                        <label for="seccion">Seccion:</label>
                        <select name="seccion" id="seccion" disabled>
                            <option value="1">A</option>
                            <option value="2">B</option>
                        </select>
                        <input type="submit" value="Insertar alumno" name="manual">
                        <img src="img/regresar.png" onclick="balm()">
        </form>
    </div>
    <div class="form" id="forma">
        <form action="alumnos.php" method="POST" enctype="multipart/form-data">
            <label for="lista">Elegir una lista: </label>
            <input type="file" name="fichero_usuario">

            <br>
            <input type="submit" value="Subir" name="Insertar">
            <img src="img/regresar.png" onclick="back()">
        </form>
    </div>
    <?php
    include 'Controllers/leer.php';
    include 'Controllers/manual.php';
    ?>
</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">
    function balm(){
        document.getElementById('alumnuevo').style.display = "block";
        document.getElementById('manual').style.display = "none";
    }

    function Manual(){
        document.getElementById('alumnuevo').style.display = "none";
        document.getElementById('manual').style.display = "block";
    }

    function back(){
        document.getElementById('forma').style.display = "none";
        document.getElementById('alumnuevo').style.display = "block";
    }

    function Excel(){
        document.getElementById('forma').style.display = "block";
        document.getElementById('alumnuevo').style.display = "none";
    }


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

    function cerrar() {
        document.getElementById('advertencia').style.display = "none";
        document.getElementById('tablaexcel').style.display = "none";

    }

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
</script>

</html>