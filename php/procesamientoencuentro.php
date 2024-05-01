<?php


include_once("05-encuentro.php");


	
    $fecha_encuentro = $_POST["fecha_encuentro"];
	$estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$actividad = $_POST["actividad"];
	$gerencia = $_POST["gerencia"];
	


	
	
	$encuentro = new encuentro(1);

    $encuentro ->setfecha_encuentro($fecha_encuentro);
	$encuentro->setestado($estado);
	$encuentro->setmunicipio($municipio);
	$encuentro->setgerencia($gerencia);
	$encuentro->setparroquia($parroquia);
	$encuentro->setactividad($actividad);
	$encuentro->insertarEncuentro();

	

?>
