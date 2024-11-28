<?php  
include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);

$fecha_prueba = $_POST["fecha_prueba"];
$id = $_POST["id"];
$descripcion = $_POST["descripcion"];

    $aten->setid($id);
	$aten->setfecha_prueba($fecha_prueba);
    $aten->setmedidas($descripcion);
	$aten->modificarCita_prueba()


?>