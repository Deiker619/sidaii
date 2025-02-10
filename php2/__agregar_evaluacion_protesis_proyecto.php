<?php 
$id = $_POST['id'];
$apto = $_POST['recibido'];

include_once("../php/01-02-cita_protesis.php");
$evalucion= new citas_protesis(1);
$evalucion->setid($id);
$consulta = $evalucion->evaluacion($apto);


?>