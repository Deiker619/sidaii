<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_por_ayuda_tecnica();

$resultados = array();

foreach ($registro as $consulta) {
    $resultado = array(
        "ayuda" => $consulta["ayuda"],
        "cantidades" => $consulta["cantidades"]
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);
