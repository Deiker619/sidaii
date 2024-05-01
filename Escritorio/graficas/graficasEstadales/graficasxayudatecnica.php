<?php
include_once("../../../php/01-atenciones-estadales.php");
$aten = new AtencionesEstadales(1);
$registro = $aten->consultarTodosAtencionesporayuda();

// Crear un arreglo para almacenar los resultados
$resultados = array();

foreach ($registro as $consulta) {
    // Agregar los resultados al arreglo asociativo
    $resultado = array(
        "nombre_tipoayuda" => $consulta["nombre_tipoayuda"],
        "cantidad" => $consulta["cantidad"]
    );

    // Agregar el resultado al arreglo general
    $resultados[] = $resultado;
}

// Convertir el arreglo PHP en formato JSON y devolverlo como respuesta

echo json_encode($resultados); 
?>