<?php  
include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);

$id = $_POST["id"];


    $aten->setid($id);
	$aten->finalizarProceso()


?>