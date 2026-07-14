<?php
include_once("../../../php/01-atenciones-estadales.php");

$IDmes = $_POST["IDmes"];
$IDanio = $_POST["IDanio"];

$meses = [
    1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril",
    5 => "Mayo", 6 => "Junio", 7 => "Julio", 8 => "Agosto",
    9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
];

$aten = new AtencionesEstadales(1);
$registro = $aten->campamentos_mensual($IDmes, $IDanio);

$totalRegistros = count($registro);

$resultados = array();

if ($totalRegistros > 0) {
    $resultado = array(
        "anio" => $IDanio,
        "nombre_mes" => $meses[intval($IDmes)],
        "total_registros" => $totalRegistros,
    );
    $resultados[] = $resultado;
}

echo json_encode($resultados);
