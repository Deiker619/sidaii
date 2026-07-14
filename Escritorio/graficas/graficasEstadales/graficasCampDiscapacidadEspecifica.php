<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_por_discapacidad_especifica();

$resultados = array();

foreach ($registro as $consulta) {
    $resultado = array(
        "discapacidad" => $consulta["discapacidad"],
        "cantidades" => $consulta["cantidades"]
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);

