<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="icono/bateil png.ico">
  <link rel="stylesheet" href="css/registro.css">
  <title>Login</title>
</head>

<body>
  <div class="login">
    <div class="logo">
      <img src="img/logo.png">
    </div>
    <form action="index.php" method="POST">
      <label>Matricula o Usuario</label>
      <input type="text" id="matricula" name="matricula" placeholder="Matricula o Usuairo">
      <label>Contraseña</label>
      <input type="password" id="contra" name="contra" placeholder="Contraseña...">
      <center><div class="popup" onclick="myFunction()" >Olvidaste tu contraseña?
        <span class="popuptext" id="myPopup">En proceso...</span>
      </div><center>
      <input type="submit" value="Iniciar Session" name="Iniciar">
      <a href="registro.php">Registro</a>
    </form>


  </div>
</body>
<?php
include('Controllers/backlogin.php');
?>
<script>
  // When the user clicks on <div>, open the popup
  function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }

  function login(){
    document.getElementById('fondo').style.display = "none";
    document.getElementById('log').style.display = "none";
  }
</script>

</html>