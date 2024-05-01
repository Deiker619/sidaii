<?php


include_once("6-remitir.php");







    $cedula = $_POST["cedula"];
	$departamento = $_POST["remitir"];
	$fecha = $_POST["fecha"];
	$nombre = $_POST["nombre"];
	
	


	
	
	$remitido = new remitido(1);

    $remitido ->setfecha($fecha);
	$remitido->setcedula($cedula);
	$remitido->setdepartamento($departamento);

	$consulta = $remitido->consultarRemitido();

	if($consulta){
		echo "Ya esta persona fue remitida";
	}else{
		$remitido->insertarRemitido();
		echo "Regitro remitido exitosamente";
	}
	

	


	


?>
