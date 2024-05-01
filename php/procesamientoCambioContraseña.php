<?php
include_once("03-usuario.php");


$contraseñaActual=$_POST["contraseñaActual"];
$contraseñaNueva=$_POST["contraseñaNueva"];
$contraseñaRepetida=$_POST["contraseñaRepetida"];
$cedula = $_POST["cedula"];


$user = new Usuario(1);
$user->setcedula($cedula);
$user->setpasswordd(password_hash($contraseñaNueva, PASSWORD_BCRYPT));
$consulta  = $user->consultarUsuarios();

if(password_verify($contraseñaActual, $consulta['passwordd'])){
    
    $consulta  = $user->CambiarContraseña();
    echo "1";
    
}else{
    echo "2";
}
?>