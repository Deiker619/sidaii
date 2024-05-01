<?php 

include_once("../php/6-remitir.php");
$aten = new remitido(1);

$cedula = $_POST["cedula"];
$statu = $_POST["status"];

if($statu =="Aceptado"){

$aten->setcedula($cedula);
$aten->setstatu($statu);
$aten->ModificarRemitido();
}

if($statu=="Rechazado"){
$motivo = $_POST["motivo"];
echo $motivo;
$aten->setcedula($cedula);
$aten->setstatu($statu);
$aten->setmotivo($motivo);
$aten->ModificarRemitidoRechazado();
}



?>