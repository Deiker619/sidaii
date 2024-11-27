<?php


include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);

	$id = $_POST["id"];
	$cedula = $_POST["cedula"];
	$artificio = $_POST["artificio"];
	$fecha_cita = $_POST["fecha_cita"];
	$fecha_aper = $_POST["fecha_aper"] ?? null;
	$descripcion = $_POST["descripcion"];


	$aten->setid($id);
	$aten->setartificio($artificio);
	$aten->setfecha_medidas($fecha_cita);
	$aten->setartificio($artificio);
	$aten->setdescripcion($descripcion);
	$aten->modificarCita_toma_medidas()



	
	
	
	
	
	
	

	


	


?>
