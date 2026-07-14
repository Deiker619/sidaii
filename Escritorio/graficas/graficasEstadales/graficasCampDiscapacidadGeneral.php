<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_por_discapacidad_general();

$resultados = array();

foreach ($registro as $consulta) {
    $resultado = array(
        "nombre_discapacidad" => $consulta["nombre_discapacidad"],
        "cantidades" => $consulta["cantidades"]
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);

