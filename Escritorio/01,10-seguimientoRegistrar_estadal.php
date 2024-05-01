<?php
require_once("../php/08-seguimiento.php");

$aten = new seguimiento(1);

$cedula = $_POST["cedula"];
$descripcion = $_POST["descripcion"];
$fecha_seguimiento = $_POST["fecha"];
$numero = $_POST["numero"];



$aten->setcedula($cedula);
$aten->setdescripcion($descripcion);
$aten->setfecha_seguimiento($fecha_seguimiento);
$aten->insertarSeguimiento();

include_once("../php/01-atenciones-estadales.php");

$aten =  new AtencionesEstadales(1);
$aten ->setnumero_aten($numero);
$aten ->setstatu("En seguimiento");
$aten ->insertarStatu();




?>