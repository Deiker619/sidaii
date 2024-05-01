<?php
include_once("../php/01-atenciones.php");
$aten = new Atenciones(1);
$registro = $aten->atencionesDadas_por_edad();

// Crear un arreglo para almacenar los resultados
$resultados = array();

foreach ($registro as $consulta) {
    // Agregar los resultados al arreglo asociativo
    $resultado = array(
        "edad" => $consulta["edad"],
        "cantidades" => $consulta["cantidades"]
    );

    // Agregar el resultado al arreglo general
    $resultados[] = $resultado;
}

// Convertir el arreglo PHP en formato JSON y devolverlo como respuesta

echo json_encode($resultados);
?>