<?php  
require_once("../php/01-06-audiometria.php");

    $id = $_POST["id"];
    $fecha_cita = $_POST["fecha_cita"];
    $status = $_POST["status"];
    $descripcion = $_POST["descripcion"];

    $medid = new audiometria(1);
    $medid->setid($id);
    $medid->setfecha_cita($fecha_cita);
    $medid->setdescripcion($descripcion);

    $medid->modificarCita();


?>