<?php
require_once("../php/01-05-reparacionArtificio.php");


if($_POST['statusModified']){
    $reparacion = new raparacion_artificio(1);

    $id = $_POST["id"];
    $reparacion->setid($id);
    $isreparado = $reparacion->reparcionAtendida();

    if($isreparado){

        $data = [
            'message' => 'Reparacion completada',
            'others' => ''
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }else{
        
        $data = [
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}else{

    $id = $_POST["idee"];
    $fecha_reparacion = $_POST["fecha_reparacion"];
    $artificio = $_POST["artificio"];
    $descripcion = $_POST["descripcion"];
    
    $reparacion = new raparacion_artificio(1);
    $reparacion ->setid($id);
    $reparacion ->setartificio($artificio);
    $reparacion ->setfecha_reparacion($fecha_reparacion);
    $reparacion ->setdescripcion($descripcion);
    
    $reparacion ->InsertarCitaReparacion();
}




?>