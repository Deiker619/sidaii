<?php

$cedula = $_REQUEST['cedula'];

include_once("../php/01-discapacitados.php");

$beneficiario = new discapacitados(1);
$beneficiario->setcedula($cedula);

$consulta = $beneficiario->consultarDiscapacitados();


if($consulta){

    header('Content-Type: application/json');
    
    $datos = [
        'nombre' => 'Juan',
        'datos' => $consulta,
        'message' => 200
    ];
    echo json_encode($datos);
}else{
    header('Content-Type: application/json');
    
    $datos = [
        'message' => 404
    ];
    echo json_encode($datos);
}







?>