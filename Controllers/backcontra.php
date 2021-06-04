<?php

include 'conexion.php';
include 'func.php';
$errors = array();
if (empty($_POST['correo'])) {

    $email = $mysqli->real_escape_string($_POST['correo']);

    if(!$email){
        $errors[] = "No se Encuentra ese correo";

        if (emailExiste($email)) {
            $user_id = getValor('id', 'correo', $email);
            $nombre = getValor('nombre', 'correo', $email);
        }
    }

}

?>