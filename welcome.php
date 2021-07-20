<?php
session_start();
include("Controllers/fecha.php");
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





</head>

<body onload="setVolume()">
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
					<li><a href='pasemaestros.php'>Pase de lista</a></li>

				<?php } else {
				?>
					<li><a href='justificacion.php'>Faltas Justificadas</a></li>
				<?php


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
		<center><label style="width: fit-content; background-color: black; color:white; font-size: 20px;">Pase de lista</label></center>
		<div class="faltas">

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
	} elseif ($rows['tipo_usuario'] == 1) {




	?>













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
					<img class="volu" src="img/volumesong.png">
					<input type="range" oninput="setVolume()" id='volume1' min=0 max=1 step=0.01 value='0.2'>
				</div>
				<button type="button" class="next" id="next" onclick="selector()">
					<span><img src="img/skip.png" class="skipp"></span>
				</button>
			</div>
			<label id="cancions">Canciones</label>
			<ul id="listado"></ul>

		</div>
	<?php
	}
	include('Controllers/busalumn.php');
	?>
</body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/songs.js"></script>
<script type="text/javascript">
	function disable() {

		document.getElementById("grado").disabled = true;
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
</script>

</html>