<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="css/style.css" rel="stylesheet" type="text/css">
  <link rel="shortcut icon" href="icono/bateil png.ico">
  <title>Login</title>
</head>

<body>
  <div>
    <form action="Controllers/backlogin.php" method="POST">
      <label>Matricula o Usuario</label>
      <input type="text" id="matricula" name="matricula" placeholder="Matricula o Usuairo">
      <label>Contraseña</label>
      <input type="password" id="contra" name="contra" placeholder="Contraseña...">
      <div class="popup" onclick="myFunction()">Olvidaste tu contraseña?
        <span class="popuptext" id="myPopup">En proceso...</span>
      </div>
      <input type="submit" value="Iniciar Session">
      <a href="#">Registro</a>
    </form>


  </div>
</body>

<script>
  // When the user clicks on <div>, open the popup
  function myFunction() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }
</script>

</html>