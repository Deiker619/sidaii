<?php
require_once("../php/01-06-audiometria.php");

$id = $_POST["id"];
$fecha_cita = $_POST["fecha_cita"];

$medid = new audiometria(1);
$medid ->setid($id);
$medid ->setfecha_cita($fecha_cita);
$medid ->modificarCita();

?>