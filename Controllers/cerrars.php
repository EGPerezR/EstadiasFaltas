<?php
//este codigo es para deslogearse
session_start();
session_destroy();
header("location: ../index.php ");
exit();

?>
