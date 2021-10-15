<?php
session_start();
include("Controllers/conexion.php");
if (isset($_SESSION['matricula'])) {
} else {
	header('Location: index.php');
}
