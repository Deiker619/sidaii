<?php 
include_once("03-usuario.php");

session_start();
function redireccionar($url){ 
	ob_start();   // Se utiliza para solucionar el error de  headers already sent 
	$host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
	//echo "Host: ".$host."<br>";
	$uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
	//echo "Uri: ".$uri."<br>";
	header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
	ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
}

$cedula = $_POST["cedula"];
$pass = $_POST["contraseña"];

$user = new Usuario(1);
$user->setcedula($cedula);

$registro = $user->consultarUsuarios();

if ($registro['bloqueado'] == 1) {
    echo "bloqueado";
} else if ($registro and password_verify($pass, $registro['passwordd'])){ 
    $_SESSION['cedula']=$registro['cedula'];
    $_SESSION['nombre']=$registro['nombre'];
    $_SESSION['rol']=$registro['rol'];     
    $_SESSION['telefono']=$registro['telefono'];
    $_SESSION['gerencia']=$registro['gerencia'];     
    $_SESSION['coordinacion']=$registro['coordinacion'];     

    echo true;
} else {
    echo false;
}
$user = null;
?>