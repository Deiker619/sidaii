<?php 

include_once("../php/6-remitir.php");
$aten = new remitido(1);

$cedula = $_POST["cedula"];
$statu = $_POST["status"];
$informe = $_POST["informe"];
$atencion = $_POST["atencion"];
$solicitud = $_POST["solicitud"];

if($statu =="Aceptado"){

$aten->setcedula($cedula);
$aten->setstatu($statu);
$aten->ModificarRemitido();

include_once("../php/01-atenciones.php");

$aten = new Atenciones(1);
$consulta = $aten->UltimoIdRegistrado();


$aten->setnumero_aten($consulta["id"]);
$aten->setatencion_solicitada($solicitud);
$subconsulta = $aten->CargarDatosRemitidos($informe);

echo $subconsulta;
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