<?php
$diaSemana = date("w");
# Calcular el tiempo (no la fecha) de cuándo fue el inicio de semana
$tiempoDeInicioDeSemana = strtotime("-".$diaSemana."days"); # Restamos -X days
# Y formateamos ese tiempo
$fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);

$lunes = date("Y-m-d",strtotime($fechaInicioSemana."+ 1 days"));


?>