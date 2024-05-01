<?php
require_once("../php/05-participante_encuentro.php");
require_once("../php/05-solicitud_encuentro.php");

$id = $_POST["ids"];
$cedula = $_POST["cedula"];
$encuentro = $_POST["encuentro"];
$fecha_asig = $_POST["fecha_asig"];

$solicitud = new solicitud_encuentro(1);
$solicitud -> setid($id);
$solicitud -> setfecha_asig($fecha_asig);
$solicitud -> modificarSolicitud();



$medid = new participante_encuentro(1);
$medid ->setencuentro($encuentro);
$medid ->setcedula($cedula);
$medid ->setfecha_recibido($fecha_asig);
$medid ->insertarParticipante();

?>