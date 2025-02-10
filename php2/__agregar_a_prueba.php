<?php 
$id = $_POST['id'];
$fecha = $_POST['fecha'];

include_once("../php/01-02-cita_protesis.php");
$evalucion= new citas_protesis(1);
$evalucion->setid($id);
$consulta = $evalucion->enviar_a_prueba($fecha);


?>