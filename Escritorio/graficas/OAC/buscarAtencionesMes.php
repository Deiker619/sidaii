<?php
include_once("../../../php/01-atenciones.php");

$IDmes = $_POST["IDmes"];
$IDaño = $_POST["IDaño"];

$aten = new Atenciones(1);
$registro = $aten->BuscarAtencionesMensuales($IDmes, $IDaño);

// Crear un arreglo para almacenar los resultados
$resultados = array();

foreach ($registro as $consulta) {
    // Agregar los resultados al arreglo asociativo
    $resultado = array(
        "año" => $consulta["anio"],
        "nro_mes" => $consulta["mes"],
        "nombre_mes" => $consulta["nombre_mes"],
        "cantidad_registros" => $consulta["cantidad_registros"],
    );

    // Agregar el resultado al arreglo general
    $resultados[] = $resultado;
}

// Convertir el arreglo PHP en formato JSON y devolverlo como respuesta
echo json_encode($resultados);
?>
