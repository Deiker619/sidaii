<?php


include_once("01-atenciones.php");


    $numero_aten = $_POST["id"];
	$atencion_solicitada = $_POST["atencion_recibida"];
	
	
	
	
	$escuela = new Atenciones(1);
	$escuela ->setatencion_solicitada($atencion_solicitada);

    $escuela ->setnumero_aten($numero_aten);
	$escuela->carga_solicitud();
		/* extraer cedula de esa atencion */
	$cedula = $escuela->consultarAtenciones();
	


    
	/* */
	$escuela->setcedula($cedula["cedula"]);
	$escuela->setstatu("En espera");
	$escuela->insertarStatu();
	
	echo "Se cargo ".$atencion_solicitada;
	
	

	


	


?>
