<?php
require_once("../php/01-06-audiometria.php");


    
    $id = $_POST["id"];
    $reparacion = new audiometria(1);
    $reparacion ->setid($id);
    $reparacion ->eliminaraudio();

    $data = [ 
        'message' => 'Eliminado correctamente'
    ];
    header('Content-Type: application/json');
    echo json_encode($data);







?>