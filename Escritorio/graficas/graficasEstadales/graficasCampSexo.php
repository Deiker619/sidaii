<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_por_sexo();

$resultados = array();

foreach ($registro as $consulta) {
    $resultado = array(
        "sexos" => $consulta["sexos"],
        "cantidades" => $consulta["cantidades"]
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);

