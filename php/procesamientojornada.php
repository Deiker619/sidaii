<?php

include_once("02-jornadas.php");


	
	$estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$numero_personas = $_POST["personas_atender"];
	$gerencia = $_POST["gerencia"];
	



	
	
	$jornadas = new Jornadas(1);

	$jornadas->setestado($estado);
	$jornadas->setmunicipio($municipio);
	$jornadas->setparroquia($parroquia);
	$jornadas->setnumero_personas($numero_personas);
	$jornadas->setgerencia($gerencia);
	$jornadas->insertarJornada();

	function redireccionar($url){ 
		ob_start();   // Se utiliza para solucionar el error de  headers already sent 
		$host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
		//echo "Host: ".$host."<br>";
		$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
		//echo "Uri: ".$uri."<br>";
		header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
		ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
	}

	redireccionar("../Escritorio/02-jornadas.php");	

?>