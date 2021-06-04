<?php
/*pasamos la direccion de la ip de la bd, despues asignamos 
el usuario y la contraseña de nuestro servidor de bd*/
$mysqli = @mysqli_connect('localhost', 'root', '', 'lista');
if (!$mysqli) {
    echo "Error: " . mysqli_connect_error();
	exit();
}
?>