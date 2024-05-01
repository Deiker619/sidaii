<?php


include_once("04-taller.php");

if (isset($_POST["registro"])) {
	
    $fecha_taller = $_POST["fecha_taller"];
	$estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$actividad = $_POST["actividad"];
	

	
	
	$taller = new taller(1);

    $taller ->setfecha_taller($fecha_taller);
	$taller->setestado($estado);
	$taller->setmunicipio($municipio);
	$taller->setparroquia($parroquia);
	$taller->setactividad($actividad);
	$taller->insertarTaller();

	function redireccionar($url){ 
		ob_start();   // Se utiliza para solucionar el error de  headers already sent 
		$host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
		//echo "Host: ".$host."<br>";
		$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
		//echo "Uri: ".$uri."<br>";
		header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
		ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
	}
	redireccionar("../Escritorio/08-desarrolloSocial-talleres.php");	

	

}
?>
