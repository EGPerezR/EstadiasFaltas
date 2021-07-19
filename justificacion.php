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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icono/bateil png.ico">
    
    <link rel="stylesheet" href="css/justificacion.css" type="text/css">
    <title>Justificacion</title>
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
    <center><label style="width: fit-content; background-color: black; color:white; font-size: 20px;">Justificar</label></center>
    <div class="faltas">

        <form action="justificacion.php" method="POST">
            <label class="letra">Seleccione Especialidad</label>
            <select name="especialidad" id="espe" oninput="abilitagrado()">
                <option value="">...</option>
                <option value="1">Combustion Interna</option>
                <option value="2">Maquinas y herramientas</option>
                <option value="3">Electricidad</option>
                <option value="4">Sistemas</option>
                <option value="5">Mecatronica</option>
            </select>
            <lablel>Seleccione Grado</lablel>
            <select name="grado" disabled id="gra" oninput="abilitaseccion()">
                <option value="">...</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
            </select>
            <lablel>Seleccione Seccion</lablel>
            <select name="seccion" disabled id="se">
                <option value="">...</option>
                <option value="1">A</option>
                <option value="2">B</option>
            </select>
            <input type="submit" value="Buscar" name="justificar">
        </form>
    </div>

    <?php
    include('Controllers/justifiback.php');
    ?>

</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/justi.js"></script>
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

    function cie() {
    document.getElementById('fondojustifica').style.display = "none";
    document.getElementById('justifiform').style.display = "none";
}
    
</script>

</html>