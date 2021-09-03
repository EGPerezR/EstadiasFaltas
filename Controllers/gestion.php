<?php
include('conexion.php');
require 'funcs.php';
$opcion = '';
$seccion = '';
if (isset($_POST['activo'])) {

    if (isNullesp($_POST['especialidad'])) {

        echo '<script>
        alert("Seleccionar una Especialidad");
      </script>';
    } else if (isNullgrad($_POST['grado'])) {

        echo '<script>
        alert("Seleccionar un Grado");
      </script>';
    } else if (isNullsec($_POST['seccion'])) {

        echo '<script>
        alert("Seleccionar una Seccion");
      </script>';
    } else {
        $espe = $_POST['especialidad'];
        $grado = $_POST['grado'];
        $secc = $_POST['seccion'];
        //consulta de alumnos
        $sql = "SELECT  id_alumnos, nombres, activo from alumnos where especialidad = $espe and grado = $grado and seccion = $secc ORDER BY nombres ASC";
        
        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {


?>
            <div class="tablafa" id="tablafa">

                <form action="Controllers/actualiza.php" method="POST">

                    <table border="1" class="tabla">
                        <thead style="
                    <?php
                    if ($espe == 4) {
                        echo "background-color: #87ec8b;";
                    }
                    if ($espe == 1) {
                        echo "background-color: #f79595;";
                    }
                    if ($espe == 2) {
                        echo "background-color: #7ea7ff;";
                    }
                    if ($espe == 3) {
                        echo "background-color: #ffb87e;";
                    }
                    if ($espe == 5) {
                        echo "background-color: #9d61fd;";
                    }    ?>">
                            <td colspan="4">
                                <a onclick="cierra()" style="float: right; font-size: 20px; color: red; cursor:pointer;">X</a>
                                <center>
                                    <b>
                                        <label>
                                            <?php echo $grado . " Grado de ";
                                            if ($espe == 4) {
                                                echo "Sistemas";
                                            }
                                            if ($espe == 1) {
                                                echo "Combustion Interna";
                                            }
                                            if ($espe == 2) {
                                                echo "Maquinas y Herramientas";
                                            }
                                            if ($espe == 3) {
                                                echo "Electricidad";
                                            }
                                            if ($espe == 5) {
                                                echo "Mecatronica";
                                            }
                                            echo " del ";
                                            if ($secc == 2) {
                                                echo "B";
                                            }
                                            if ($secc == 1) {
                                                echo "A";
                                            } ?></label></b>
                                </center>

                            </td>
                        </thead>
                        <tr>

                            <th>Nombres</th>
                            <th style="width: 40px;">Activo</hd>
                        </tr>
                        <?php
                        while ($lista = $result->fetch_assoc()) {
                            if($lista['activo'] == 0){
                                $opcion = 'NA';
                            }elseif($lista['activo']==1){
                                $opcion = 'A';
                            }
                            //muestra los alumnos 
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><input type='text' maxlength='2' style='text-transform:uppercase; width: 80%;' name='activo[]' value='" . $opcion . "'><input type='text' hidden dissabled name='alumno[]' value='" . $lista['id_alumnos'] . "'></td></tr>";
                        }

                        ?>

                    </table>

                    <div class="matefa">
                    <b><label>A = Activo</label></b>
                        <b><label class="na">NA =No Activo</label></b>
                        <br>
                        <input type="submit" value="Actualizar" onclick="alerta()" name="update">

                    </div>
                </form>
            </div>
        <?php

        } else {
            echo $sql;
        ?>
        
            <h1>No se Encontro este grupo...</h1>

        <?php
        }
    }
}
if (isset($_POST['cambio'])) {
    if (isNullesp($_POST['especialidad'])) {

        echo '<script>
            alert("Seleccionar una Especialidad");
          </script>';
    } else if (isNullgrad($_POST['grado'])) {

        echo '<script>
            alert("Seleccionar un Grado");
          </script>';
    } else if (isNullsec($_POST['seccion'])) {

        echo '<script>
            alert("Seleccionar una Seccion");
          </script>';
    } else {
        $espe = $_POST['especialidad'];
        $grado = $_POST['grado'];
        $secc = $_POST['seccion'];
        
        //consulta de alumnos
        $sql = "SELECT  id_alumnos, nombres, grado, seccion from alumnos where especialidad = $espe and grado = $grado and seccion = $secc and activo = 1 ORDER BY nombres ASC";

        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {


        ?>
            <div class="tablafa" id="tablafa">

                <form action="Controllers/actualiza.php" method="POST">

                    <table border="1" class="tabla">
                        <thead style="
                        <?php
                        if ($espe == 4) {
                            echo "background-color: #87ec8b;";
                        }
                        if ($espe == 1) {
                            echo "background-color: #f79595;";
                        }
                        if ($espe == 2) {
                            echo "background-color: #7ea7ff;";
                        }
                        if ($espe == 3) {
                            echo "background-color: #ffb87e;";
                        }
                        if ($espe == 5) {
                            echo "background-color: #9d61fd;";
                        }    ?>">
                            <td colspan="4">
                                <a onclick="cierra()" style="float: right; font-size: 20px; color: red; cursor:pointer;">X</a>
                                <center>
                                    <b>
                                        <label>
                                            <?php echo $grado . " Grado de ";
                                            if ($espe == 4) {
                                                echo "Sistemas";
                                            }
                                            if ($espe == 1) {
                                                echo "Combustion Interna";
                                            }
                                            if ($espe == 2) {
                                                echo "Maquinas y Herramientas";
                                            }
                                            if ($espe == 3) {
                                                echo "Electricidad";
                                            }
                                            if ($espe == 5) {
                                                echo "Mecatronica";
                                            }
                                            echo " del ";
                                            if ($secc == 2) {
                                                echo "B";
                                            }
                                            if ($secc == 1) {
                                                echo "A";
                                            } ?></label></b>
                                </center>

                            </td>
                        </thead>
                        <tr>

                            <th>Nombres</th>
                            <th style="width: 40px;">Grado</hd>
                            <th style="width: 40px;">Seccion</hd>
                        </tr>
                        <?php
                        while ($lista = $result->fetch_assoc()) {
                            //muestra los alumnos 
                            if ($lista['seccion'] == 1) {
                                $seccion = 'A';
                            } elseif ($lista['seccion'] == 2) {
                                $seccion = 'B';
                            } elseif ($lista['seccion']== 3){
                                $seccion = 'C';
                            }
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><label>" . $lista['grado'] . "</label><input type='text' hidden dissabled name='alumno[]' value='" . $lista['id_alumnos'] . "'></td><td><input type='text' maxlength='1' style='text-transform:uppercase; width: 30%;' name='seccion[]' value='" . $seccion . "'></td></tr>";
                        }

                        ?>

                    </table>
                   
                    <div class="matefa">
                        <label>Grado</label>
                        <input class="grado" type="number" min="1" max="6" name="grad">
                        <input type="submit" value="Actualizar" name="camb" onclick="alerta()">

                    </div>

                </form>
            </div>
        <?php

        } else {
        ?>
            <h1>No se Encontro este grupo...</h1>

        <?php
        }
    }
}
if (isset($_POST['covid'])) {

    if (isNullesp($_POST['especialidad'])) {

        echo '<script>
        alert("Seleccionar una Especialidad");
      </script>';
    } else if (isNullgrad($_POST['grado'])) {

        echo '<script>
        alert("Seleccionar un Grado");
      </script>';
    } else if (isNullsec($_POST['seccion'])) {

        echo '<script>
        alert("Seleccionar una Seccion");
      </script>';
    } else {
        $espe = $_POST['especialidad'];
        $grado = $_POST['grado'];
        $secc = $_POST['seccion'];
        //consulta de alumnos
        $sql = "SELECT  id_alumnos, nombres, grupo from alumnos where especialidad = $espe and grado = $grado and seccion = $secc and activo = 1 ORDER BY nombres ASC";

        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {


        ?>
            <div class="tablafa" id="tablafa">

                <form action="Controllers/actualiza.php" method="POST">

                    <table border="1" class="tabla">
                        <thead style="
                    <?php
                    if ($espe == 4) {
                        echo "background-color: #87ec8b;";
                    }
                    if ($espe == 1) {
                        echo "background-color: #f79595;";
                    }
                    if ($espe == 2) {
                        echo "background-color: #7ea7ff;";
                    }
                    if ($espe == 3) {
                        echo "background-color: #ffb87e;";
                    }
                    if ($espe == 5) {
                        echo "background-color: #9d61fd;";
                    }    ?>">
                            <td colspan="4">
                                <a onclick="cierra()" style="float: right; font-size: 20px; color: red; cursor:pointer;">X</a>
                                <center>
                                    <b>
                                        <label>
                                            <?php echo $grado . " Grado de ";
                                            if ($espe == 4) {
                                                echo "Sistemas";
                                            }
                                            if ($espe == 1) {
                                                echo "Combustion Interna";
                                            }
                                            if ($espe == 2) {
                                                echo "Maquinas y Herramientas";
                                            }
                                            if ($espe == 3) {
                                                echo "Electricidad";
                                            }
                                            if ($espe == 5) {
                                                echo "Mecatronica";
                                            }
                                            echo " del ";
                                            if ($secc == 2) {
                                                echo "B";
                                            }
                                            if ($secc == 1) {
                                                echo "A";
                                            } ?></label></b>
                                </center>

                            </td>
                        </thead>
                        <tr>

                            <th>Nombres</th>
                            <th style="width: 40px;">Grupo</hd>
                        </tr>
                        <?php
                        while ($lista = $result->fetch_assoc()) {
                            //muestra los alumnos 
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><input type='number' min='0' max='2' style='width: 80%;' name='grupo[]' value='" . $lista['grupo'] . "'><input type='text' hidden  name='alumno[]' value='" . $lista['id_alumnos'] . "'></td></tr>";
                        }

                        ?>

                    </table>
                    <div class="matefa">

                        <input type="submit" value="Actualizar" name="cov" onclick="alerta()">

                    </div>

                </form>
            </div>
        <?php

        } else {
        ?>
            <h1>No se Encontro este grupo...</h1>

<?php
        }
    }
}




?>