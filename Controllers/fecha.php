<?php
$diaSemana = date("w");
# Calcular el tiempo (no la fecha) de cuándo fue el inicio de semana
$tiempoDeInicioDeSemana = strtotime("-".$diaSemana."days"); # Restamos -X days
# Y formateamos ese tiempo
$fechaInicioSemana = date("Y-m-d", $tiempoDeInicioDeSemana);

$lunes = date("Y-m-d",strtotime($fechaInicioSemana."+ 1 days"));

function viernes($dia){
$viernes = date("Y-m-d",strtotime($dia."+ 4 days"));
return $viernes;
}

function estasemana(){
    global $lunes;
    $estasema = date("Y-m-d",strtotime($lunes."+ 5 days"));
    return $estasema;
}
?>