<?php
include_once("../../php/10-coordinaciones-estadales.php");
$coordinacion = $_REQUEST["coordinacion"];
$aten = new coordinacion(1);
$aten->setid($coordinacion );
$registro = $aten->graficasxsexo();

// Crear un arreglo para almacenar los resultados
$resultados = array();

foreach ($registro as $consulta) {
    // Agregar los resultados al arreglo asociativo
    $resultado = array(
        "sexos" => $consulta["sexos"],
        "cantidades" => $consulta["cantidades"]
    );

    // Agregar el resultado al arreglo general
    $resultados[] = $resultado;
}

// Convertir el arreglo PHP en formato JSON y devolverlo como respuesta

echo json_encode($resultados);
?>