<?php
require_once("../php/04-participante_taller.php");
require_once("../php/04-solicitud_desarrollo.php");

$id = $_POST["ids"];
$cedula = $_POST["cedula"];
$taller = $_POST["taller"];
$fecha_asig = $_POST["fecha_asig"];

$solicitud = new solicitud_desarrollo(1);
$solicitud -> setid($id);
$solicitud -> setfecha_asig($fecha_asig);
$solicitud -> modificarSolicitud();



$medid = new participante_taller(1);
$medid ->settaller($taller);
$medid ->setcedula($cedula);
$medid ->setfecha_recibido($fecha_asig);
$medid ->insertarParticipante();

?>