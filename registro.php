<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/registro.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="icono/bateil png.ico">
    <title>Registro</title>
</head>
<body>
    <div class="registro">
    <form action="registro.php" method="POST" onsubmit="verificaPasswords(); return false">
    <label for="matricula">Matricula</label>
    <input type="text" name="matricula" id="matricula" placeholder="Matricula">
    <label for="nombre">Nombre Completo</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo...">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" id="usuario" placeholder="Usuario">
    <label for="contraseña">Contraseña</label>
    <input type="password" name="pass1" id="pass1" placeholder="Contraseña">
    <label for="confirmar">Confirmar contraseña</label>
    <input type="password" name="pass2" placeholder="Confirmar Contraseña">
    <label for="correo">Correo</label>
    <input type="email" name="correo" id="correo" placeholder="Correo">
    <input type="submit" value="Enviar" name="enviar">
    <center><a href="index.php">Regresar</a></center>
    </form>
    </div>
    <?php
    include('Controllers/backregis.php');
    ?>

    <div id="msg"></div>
 
<!-- Mensajes de Verificación -->
<div id="error" class="alert alert-danger ocultar" role="alert" style="display: none;">
    Las Contraseñas no coinciden, vuelve a intentar !
</div>

</body>




<script>
    
function cerrarerror(){
    document.getElementById('error').style.display= "none";
    document.getElementById('fondo').style.display= "none";
}

</script>
</html>