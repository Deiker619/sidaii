<?php


include_once("7-escuela-comunitaria.php");






	$coordinacion = $_POST["coordinacion"]??null;
    $estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$comuna = (isset($_POST["comuna"]) && trim($_POST["comuna"]) !== "") ? trim($_POST["comuna"]) : null;
	$consejo_comunal = (isset($_POST["consejo_comunal"]) && trim($_POST["consejo_comunal"]) !== "") ? trim($_POST["consejo_comunal"]) : null;
	$fecha_inicio  = $_POST["fecha_encuentro"];
    $fecha_fin = $_POST["fin_encuentro"];
    $curso = $_POST["curso"];
    $comunidad = $_POST["comunidad"];
	$gerencia = $_POST["gerencia"];
	
	


	
	
	$escuela = new escuela(1);

    $escuela ->setestado($estado);
    $escuela ->setmunicipio($municipio);
    $escuela ->setparroquia($parroquia);
    $escuela ->setcomuna($comuna);
    $escuela ->setconsejo_comunal($consejo_comunal);
    $escuela ->setfecha_final($fecha_fin);
    $escuela ->setcomunidad($comunidad);
	$escuela->setfecha_inicio($fecha_inicio);
	$escuela->setgerencia($gerencia);
	
	$escuela->settema($curso);


	/* if($consulta){
		echo "Ya esta persona fue remitida";
	}else{ */
		$escuela->insertarescuela($coordinacion);
		echo "Regitro el taller exitosamente";
	
	

	


	


?>
