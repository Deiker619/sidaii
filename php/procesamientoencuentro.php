<?php


include_once("05-encuentro.php");

if (isset($_POST["registro"])) {
	
    $fecha_encuentro = $_POST["fecha_encuentro"];
	$estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$actividad = $_POST["actividad"];
	


	
	
	$encuentro = new encuentro(1);

    $encuentro ->setfecha_encuentro($fecha_encuentro);
	$encuentro->setestado($estado);
	$encuentro->setmunicipio($municipio);
	$encuentro->setparroquia($parroquia);
	$encuentro->setactividad($actividad);
	$encuentro->insertarEncuentro();

	function redireccionar($url){ 
		ob_start();   // Se utiliza para solucionar el error de  headers already sent 
		$host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
		//echo "Host: ".$host."<br>";
		$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
		//echo "Uri: ".$uri."<br>";
		header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
		ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
	}

	redireccionar("../Escritorio/10-encuentros.php");	

}
?>
