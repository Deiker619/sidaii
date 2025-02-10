<?php
include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);


$id = $_POST["id"];
$descripcion = $_POST["descripcion"];

$aten->setid($id);
$aten->setmedidas($descripcion);
$aten->modificarCita_prueba()
?>