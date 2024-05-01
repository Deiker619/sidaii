
<?php

/* include_once("01-atenciones.php"); */
include_once("01-discapacitados.php");



	/* Detalles personales */



		
		$cedula = $_POST["cedula"];
		




		
	

	$beneficiario->setcedula($cedula);

	$Consulta = $beneficiario->consultarDiscapacitados();

	if (!$Consulta){
		
			
				if($laboratorio =="4-tomedi"){
					require_once("../php/01-03-toma_medidas.php");

					$medidas = new toma_medidas(1);
					$medidas ->setcedula($cedula);
					$medidas ->insertarMedidas();
					echo "Se registro a ".$nombre." exitosamente";
					
					
				}
				if($laboratorio =="5-pruebar"){
					require_once("../php/01-04-pruebaArtificio.php");
					$medidas = new prueba_artificio(1);
					$medidas ->setcedula($cedula);
					$medidas ->insertarPrueba();
					echo "Se registro a ".$nombre." exitosamente";
						
							
					
				
				}
	
	}else{

		
	
		if($laboratorio =="4-tomedi"){
			require_once("../php/01-03-toma_medidas.php");

			$medidas = new toma_medidas(1);
			$medidas ->setcedula($cedula);
			$consultamedidas = $medidas -> autenticarMedidas();
					if (!$consultamedidas) {
						/* echo "Se registro a ".$nombre." exitosamente"; */
						$medidas ->insertarMedidas();
				
					}else{
						echo "Ya este Beneficiario se registro en esta area";
					}
			
		}

		
		if($laboratorio =="5-pruebar"){
			require_once("../php/01-04-pruebaArtificio.php");
			$medidas = new prueba_artificio(1);
			$medidas ->setcedula($cedula);
			$ConsultaPruebas = $medidas->autenticarArtificio();//Para verificar que una persona no pueda estar registrada mas de dos veces con un mismo beneficio
					if (!$ConsultaPruebas) {
						echo "Se registro a ".$nombre." exitosamente";
						$medidas ->insertarPrueba();
				
					}else{
						echo "Ya este Beneficiario se registro en esta area";
					}
	
			
		
		}


		

	}


?>