<?php
require('funcs.php');
//este codigo es para deslogearse
session_start();
destruirlogeado();
session_destroy();
header("location: ../index.php ");
exit();

?>
