<?php
session_start();
require_once("../../php/02-personasJornadas.php");




$id = $_REQUEST["id"];

echo $id;



if(isset($_REQUEST["id"])){  
    $eliminar=true;

 }else{
    $eliminar = false;	
 }


 




 $pe = new personasJornadas(1);
 $pe->setid($id);




 if($eliminar){ // Si preionó el boton eliminar
   $consulta = $pe->eliminarPersonaJornada();
 //Ejecuta el Query en la Base de Datos
	if ($consulta) { // Si se Ejecuta el Query Correctamente
		function redireccionar($url){ 
            ob_start();   // Se utiliza para solucionar el error de  headers already sent 
            $host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
            //echo "Host: ".$host."<br>";
            $uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
            //echo "Uri: ".$uri."<br>";
            header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
            ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
        }
        redireccionar("../10-encuentros.php");
	}else{
		echo "No se Eliminaron los Datos!";	
	}
}

?>