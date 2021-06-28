<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="icono/bateil png.ico">
    <title>Registro</title>
</head>
<body>
    <div class="registro">
    <form action="" method="POST" onsubmit="verificaPasswords(); return false">
    <label for="matricula">Matricula</label>
    <input type="text" name="matricula" id="matricula" placeholder="Matricula">
    <label for="nombre">Nombre Completo</label>
    <input type="text" name="nombre" id="nombre" placeholder="Nombre completo...">
    <label for="usuario">Usuario</label>
    <input type="text" name="usuario" id="usuario">
    <label for="contraseña">Contraseña</label>
    <input type="text" name="contraseña" id="pass1">
    <label for="confirmar">Confirmar contraseña</label>
    <input type="text" id="pass2">
    <label for="correo">Correo</label>
    </form>
    </div>


    <div id="msg"></div>
 
<!-- Mensajes de Verificación -->
<div id="error" class="alert alert-danger ocultar" role="alert">
    Las Contraseñas no coinciden, vuelve a intentar !
</div>
<div id="ok" class="alert alert-success ocultar" role="alert">
    Las Contraseñas coinciden ! (Procesando formulario ... )
</div>
</body>




<script>
    function verificaPasswords() {
 
 // Ontenemos los valores de los campos de contraseñas 
 pass1 = document.getElementById('pass1');
 pass2 = document.getElementById('pass2');

 // Verificamos si las constraseñas no coinciden 
 if (pass1.value != pass2.value) {

     // Si las constraseñas no coinciden mostramos un mensaje 
     document.getElementById("error").classList.add("mostrar");

     return false;
 } else {

     // Si las contraseñas coinciden ocultamos el mensaje de error
     document.getElementById("error").classList.remove("mostrar");

     // Mostramos un mensaje mencionando que las Contraseñas coinciden 
     document.getElementById("ok").classList.remove("ocultar");

     // Desabilitamos el botón de login 
     document.getElementById("login").disabled = true;

     // Refrescamos la página (Simulación de envío del formulario) 
     setTimeout(function() {
         location.reload();
     }, 3000);

     return true;
 }

}

</script>
</html>