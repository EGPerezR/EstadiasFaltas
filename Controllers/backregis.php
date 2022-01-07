<?php
require 'funcs.php';
if (isset($_POST['enviar'])) {

    if (isNullRegistro($_POST['nombre'], $_POST['usuario'], $_POST['pass1'], $_POST['pass2'], $_POST['correo'])) {
        echo '<div class="fondo" id="fondo"><div class="error" id="error"><a onclick="cerrarerror()">X</a><br><label>Favor de llenar todos los campos</label></div></div>';
    } else {


        $nomb = $_POST['nombre'];
        $usuario = $_POST['usuario'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $correo = $_POST['correo'];
        if (usuarioExiste($_POST['usuario'])) :
            echo '<div class="fondo" id="fondo"><div class="error" id="error"><a onclick="cerrarerror()">X</a><br><label>El Usuario ' . $_POST['usuario'] . ' ya ha sido registrado en otra cuenta</label></div></div>';

        elseif (!validaPassword($_POST['pass1'], $_POST['pass2'])) :
            echo '<div class="fondo" id="fondo"><div class="error" id="error"><a onclick="cerrarerror()">X</a><br><label>Las contraseñas no son identicas</label></div></div>';

        elseif (emailExiste($correo)) :

            echo '<div class="fondo" id="fondo"><div class="error" id="error"><a onclick="cerrarerror()">X</a><br><label>El correo ya ha sido registrado en otra cuenta</label></div></div>';

        else :
            $cifrado = encriptar($pass1);
            $token = generateToken();
            $tipo = 2;

            if ($insertar = registraMaestro($nomb, $usuario, $cifrado, $correo, $token, $tipo)) :
                echo '<div class="fondo" id="fondo"><div class="exito" id="error"><a onclick="cerrarerror()">X</a><br><label>Docente registrado con exito</label></div></div>';
            endif;
        endif;
    }
}
