<?php 
include_once("03-usuario.php");

$cedula = $_POST["cedula"];

$user = new Usuario(1);
$user->setcedula($cedula);

$registro = $user->consultarUsuarios();

if ($registro) {
    $user->bloquearUsuario();
}

$user = null;
?>