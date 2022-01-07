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
    <div class="registro">
        <form action="registro.php" method="POST" onsubmit="verificaPasswords(); return false">
            <label for="nombre">Nombre Completo</label>
            <input type="text" name="nombre" tabindex="2" id="nombre" placeholder="Nombre completo...">
            <label for="usuario">Usuario</label>
            <input type="text" name="usuario" tabindex="3" id="usuario" placeholder="Usuario">
            <label for="contraseña">Contraseña</label>
            <input type="password" name="pass1" tabindex="4" id="pass1" placeholder="Contraseña">
            <label for="confirmar">Confirmar contraseña</label>
            <input type="password" name="pass2" tabindex="5" placeholder="Confirmar Contraseña">
            <label for="correo">Correo</label>
            <input type="email" name="correo" tabindex="6" id="correo" placeholder="Correo">
            <input type="submit" value="Enviar" name="enviar">

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


<script src="http://code.jquery.com/jquery-latest.js"></script>

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


    function cerrarerror() {
        document.getElementById('error').style.display = "none";
        document.getElementById('fondo').style.display = "none";
    }

    document.addEventListener('keypress', function(evt) {

// Si el evento NO es una tecla Enter
if (evt.key !== 'Enter') {
  return;
}

let element = evt.target;

// Si el evento NO fue lanzado por un elemento con class "focusNext"
if (!element.classList.contains('focusNext')) {
  return;
}

// AQUI logica para encontrar el siguiente
let tabIndex = element.tabIndex + 1;
var next = document.querySelector('[tabindex="'+tabIndex+'"]');

// Si encontramos un elemento
if (next) {
  next.focus();
  event.preventDefault();
}
});
</script>

</html>