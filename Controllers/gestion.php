<?php
require 'funcs.php';
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
        $sql = "SELECT  id_alumnos, nombres, activo from alumnos where especialidad = $espe and grado = $grado and seccion = $secc and activo = 1 ORDER BY nombres ASC";

        $result = mysqli_query($mysqli, $sql);
        if (mysqli_num_rows($result) > 0) {


?>
            <div class="tablafa" id="tablafa">

                <form action="" method="POST">

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
                            //muestra los alumnos 
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><input type='number' min='0' max='1' style='width: 80%;' name='activo[]' value='" . $lista['activo'] . "'><input type='text' hidden dissabled name='alumno[]' value='" . $lista['id_alumnos'] . "'></td></tr>";
                        }

                        ?>

                    </table>

                    <div class="matefa">
                        
                        <input type="submit" value="Actualizar" name="insertar">

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

                <form action="" method="POST">

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
                            if($lista['seccion'] == 1){
                                $seccion = 'A';
                            } elseif($lista['seccion']== 2){
                                $seccion = 'B';
                            }
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><input type='number' min='1' max='6' style='width: 60%;' name='grad[]' value='" .$lista['grado']. "'><input type='text' hidden dissabled name='alumno[]' value='" . $lista['id_alumnos'] . "'></td><td><input type='text' maxlength='1' style='text-transform:uppercase; width: 30%;' name='seccion[]' value='".$seccion."'></td></tr>";
                        }

                        ?>

                    </table>
                    <div class="matefa">
                        
                            <input type="submit" value="Actualizar" name="insertar">

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

                <form action="" method="POST">

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
                            echo "<tr><td>" . $lista['nombres'] . "</td><td><input type='number' min='0' max='1' style='width: 80%;' name='grupo[]' value='" . $lista['grupo'] . "'><input type='text' hidden  name='alumno[]' value='" . $lista['id_alumnos'] . "'></td></tr>";
                        }

                        ?>

                    </table>
                    <div class="matefa">
                        
                        <input type="submit" value="Actualizar" name="insertar">

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


if(isset($_POST['act'])){

    
}



?>