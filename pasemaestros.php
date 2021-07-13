<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icono/bateil png.ico">
	<link rel="stylesheet" href="css/style.css" type="text/css">
    <title>Comprobacion</title>
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
</script>
</html>