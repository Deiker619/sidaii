<?php
require_once("../php/01-05-reparacionArtificio.php");


    
    echo 'eliminar';
    $id = $_POST["id"];
    $reparacion = new raparacion_artificio(1);
    $reparacion ->setid($id);
    $reparacion ->eliminarReparacion();


    $data = [ 
        'message' => 'Eliminado correctamente'
    ];
    header('Content-Type: application/json');
    echo json_encode($data);







?>