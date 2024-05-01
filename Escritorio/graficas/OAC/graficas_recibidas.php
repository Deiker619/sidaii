<?php
include_once("../../../php/01-atenciones.php");
$aten = new Atenciones(1);
$registro = $aten->graficasxtipoatencion();

// Crear un arreglo para almacenar los resultados
$resultados = array();

foreach ($registro as $consulta) {
    // Agregar los resultados al arreglo asociativo
    $resultado = array(
        "nombre" => $consulta["nombre"],
        "Recibidas" => $consulta["Recibidas"]
    );

    // Agregar el resultado al arreglo general
    $resultados[] = $resultado;
}

// Convertir el arreglo PHP en formato JSON y devolverlo como respuesta

echo json_encode($resultados);
?>
