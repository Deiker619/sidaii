<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_por_edad();

$resultados = array();

foreach ($registro as $consulta) {
    $resultado = array(
        "edad" => $consulta["edad"],
        "cantidades" => $consulta["cantidades"]
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);

