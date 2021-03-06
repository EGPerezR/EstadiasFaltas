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
	<title>Registro de falta</title>
	<link rel="shortcut icon" href="icono/bateil png.ico">
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<link rel="stylesheet" href="css/especialidades.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>





</head>

<body onload="alcargar()">
	<header>
		<div class="menu_bar">
			<a href="#" class="bt-menu">Menu</a>
		</div>
		<nav class="lista">
			<ul class="nav-excel">
				<li><a href='welcome.php' class="bt-menu">Inicio</a></li>
				<?php

				$nombre = "SELECT tipo_usuario from profesores where matricula = '" . $_SESSION['matricula'] . "' or usuario = '" . $_SESSION['usuairo'] . "' Limit 1";
				$result = mysqli_query($mysqli, $nombre)  or die(mysqli_error($mysqli));
				$rows = mysqli_fetch_array($result);
				if ($rows['tipo_usuario'] == 1) { ?>
					<li><a href='tablafaltas.php'>Grafica de faltas</a></li>
					<li><a href='alumnos.php'>Nuevos Alumnos</a></li>
					<li><a href='GestionA.php'>Gestion de alumnos</a></li>
					<li><a href='justificacion.php'>Justificar</a></li>
					<li><a href='visrepo.php'>Reportes</a></li>
					<li><a href='pasemaestros.php'>Historial</a></li>


				<?php } else if ($rows['tipo_usuario'] == 2) {
				?>
					<li><a href='reportes.php'>Reportes</a></li>
					<li><a href='justificacion.php'>Justificantes</a></li>
					<li style="float: right;"><a href=''><img style="width: 20px; height: 20px;" src="img/configuracion.png"></a></li>
				<?php


				} else if ($rows['tipo_usuario'] == 3) {
					echo "<li><a href='tablafaltas.php'>Grafica de faltas</a></li>";
					echo "<li><a href='pasemaestros.php'>Historial Asistencia</a></li>";
				} ?>

				<li><a href='Controllers/cerrars.php'>Cerrar Sesi&oacute;n</a></li>
			</ul>
		</nav>
	</header>



	<?php
	$nombre = "SELECT tipo_usuario from profesores where matricula = '" . $_SESSION['matricula'] . "' or usuario = '" . $_SESSION['usuairo'] . "' Limit 1";
	$result = mysqli_query($mysqli, $nombre)  or die(mysqli_error($mysqli));
	$rows = mysqli_fetch_array($result);
	if ($rows['tipo_usuario'] == 2) {
		//echo "<label>Inicio de semana: </label>" . $lunes;
		//echo "<br>fecha: " . date("Y-m-d");
	?>
		<button id="back" style="display: none" onclick="atras()">Atras</button>
		<div id="opvis">
			<button onclick="lista()">Pasar Lista</button>
			<!--<button onclick="milista()">Mi lista</button>-->
		</div>
		<div class="CF" id="CFa" >
			<form method="POST" >
				<table class="tabCF">
					<tr>
						<td><label for="">Especialidad:</label></td>
						<td><label for="">Grado:</label></td>
						<td><label for="">Seccion:</label></td>
						<td><label for="">Materia:</label></td>
					</tr>
				</table>


				<select name="espe" id="espe">
					<option value="">...</option>
					<option value="1">Combustion Interna</option>
					<option value="2">Maquinas y herramientas</option>
					<option value="3">Electricidad</option>
					<option value="4">Sistemas</option>
					<option value="5">Mecatronica</option>
				</select>
				

				<input type="button" onclick="faltgra()" value=">>">
				<select disabled id="resultado" name="grado">

				</select>
				<input type="button" onclick="faltsec()" value=">>">
				

				<select name="sec" id="result" disabled>

				</select>
				<input type="button" onclick="faltmater()" value=">>">
				
				<select name="mate" id="mate" disabled>

				</select>
				<input type="submit" Value=">>" name="faltma">
			</form>

			
		</div>
		<?php
			include('Controllers/CF.php');

?>

		<div class="faltas" id="faltas">
			<center><label style="width: fit-content; background-color: black; color:white; font-size: 20px;">Pase de lista</label></center>


			<form action="welcome.php" method="POST">
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
	} elseif ($rows['tipo_usuario'] == 3) {




	?>

		<label>Estatus de la semana No.<?php  echo $semana;  ?></label>
		<br>
		<div class="especialidades">


			<div class="Combustion">
				<table border="1" id="com">
					<?php
					include('Controllers/CI.php')
					?>

				</table>
			</div>
			<div class="Maquinas">
				<table border="1" id="maq">
					<?php
					include('Controllers/MH.php')
					?>
				</table>
			</div>
			<div class="Electricidad">
				<table border="1" id="ele">
					<?php
					include('Controllers/E.php')
					?>

				</table>
			</div>
			<div class="Sistemas">
				<table border="1" id="sis">
					<?php
					include('Controllers/SCI.php')
					?>
				</table>
			</div>
			<div class="Mecatronica">
				<table border="1" id="meca">
					<?php
					include('Controllers/M.php')
					?>

				</table>
			</div>

		</div>









		<!---
		<div class="reproductor">
			<b><label class="status">Reproduciendo...<span>&nbsp;</span></label></b>
			<div id="texto"></div>
			<audio id="audioo">
				Tu navegador no soporta el elemento <code>audio</code>.
			</audio>
			<div class="Controlls">
				<button type="button" class="previus" id="previus" onclick="previus()">
					<span><img src="img/previous.png" class="skipp"></span>
				</button>
				<div class="controlsa">
					<img class="volu" src="img/volumesong.png" id="volu" onclick="silencio()">
					<input type="range" oninput="setVolume()" id='volume1' min=0 max=1 step=0.01 value='0.2'>
				</div>
				<button type="button" class="next" id="next" onclick="selector()">
					<span><img src="img/skip.png" class="skipp"></span>
				</button>
			</div>
			<label id="cancions">Canciones</label>
			<ul id="listado"></ul>

		</div>--->
	<?php
	} elseif ($rows['tipo_usuario'] == 4){
        ?>
		<div class="pase" id="pase">
			<?php

				include 'Controllers/pasemaestros.php';
?>
		</div>

<?php
        
    } else {

		echo "<h1>Bienvenid@ " . $_SESSION['usuairo'] . "<h1>";
	}
	include('Controllers/busalumn.php');
	?>
</body>
<script src="js/CF.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<!--<script src="js/songs.js"></script>-->
<script type="text/javascript">
	function atras() {
		location.reload();
	}

	function lista() {
		document.getElementById("back").style.display = "block";
		document.getElementById("faltas").style.display = "block";
		document.getElementById("opvis").style.display = "none";
        document.getElementById("CFa").style.display = "none";
		document.getElementById("CFt").style.display = "none";

	}

	function milista() {
		document.getElementById("opvis").style.display = "none";
		document.getElementById("CFt").style.display = "none";
		document.getElementById("CFa").style.display = "block";
		document.getElementById("back").style.display = "block";

	}

	function disable() {

		document.getElementById("grado").disabled = true;
	}

	function confirm() {
		document.getElementById("fondoconf").style.display = "block";
		document.getElementById("confirmarlista").style.display = "block";
	}

	function cancelamela() {
		document.getElementById("fondoconf").style.display = "none";
		document.getElementById("confirmarlista").style.display = "none";
	}

	function enablegrado() {
		var combo = document.getElementById("especialidad");
		var selected = combo.options[combo.selectedIndex].text;
		if (selected == '...') {
			document.getElementById('grado').disabled = true;
			return false;
		} else {
			document.getElementById('grado').disabled = false;
		}
	}

	function enableseccion() {
		var combo = document.getElementById("grado");
		var selected = combo.options[combo.selectedIndex].text;
		if (selected == '...') {
			document.getElementById('seccion').disabled = true;
			return false;
		} else {
			document.getElementById('seccion').disabled = false;
		}
	}

	function off() {
		document.getElementById("hecho").style.display = "none";
	}

	function offa() {
		document.getElementById("tablafa").style.display = "none";
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

	function pasemaestro(){
		var datos= $.ajax({
			url: 'Controllers/pasemaestros.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('pase').innerHTML = datos;
	}


	function electricidad() {
		var datos = $.ajax({
			url: 'Controllers/E.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('ele').innerHTML = datos;

	}

	function mecatronica() {
		var datos = $.ajax({
			url: 'Controllers/M.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('meca').innerHTML = datos
	}

	function combustion() {
		var datos = $.ajax({
			url: 'Controllers/CI.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('com').innerHTML = datos;
	}

	function sistemas() {
		var datos = $.ajax({
			url: 'Controllers/SCI.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('sis').innerHTML = datos;
	}

	function maquinas() {
		var datos = $.ajax({
			url: 'Controllers/MH.php',
			dataType: 'text',
			async: false
		}).responseText;

		document.getElementById('maq').innerHTML = datos;
	}




	setInterval(maquinas, 2400000);
	setInterval(sistemas, 2400000);
	setInterval(combustion, 2400000);
	setInterval(mecatronica, 2400000);
	setInterval(electricidad, 2400000);
	setInterval(pasemaestro, 10000);
</script>

</html>