<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar Alumnos</title>
</head>

<body>
    <form action="alumnos.php" method="POST" enctype="multipart/form-data">
        <label for="lista">Elegir una lista: </label>
        <input type="file" name="fichero_usuario">
        <label for="especialidad">Especialidad: </label>
        <select name="especialidad" id="especialidad">
            <option value="1">Combustion Interna</option>
            <option value="2">Maquinas y herramientas</option>
            <option value="3">Electricidad</option>
            <option value="4">sistemas</option>
            <option value="5">Mecatronica</option>
        </select>
        <label for="fila_determinada">A partir de que fila tiene los alumnos: </label>
        <input type="number" name="fila" style="width: 2.5%;" value="0">
        <label for="columna">En que columna se encuentran los registros: </label>
        <select name="columna" id="columna">
        <option value="0">A</option>
        <option value="1">B</option>
        <option value="2">C</option>
        <option value="3">D</option>
        <option value="4">E</option>
        <option value="5">F</option>
        </select>
<input type="submit" value="Subir" name="Insertar">
    </form>

    <?php
    include 'Controllers/leer.php';

?>
</body>

</html>