<?php
require_once("../php/01-05-reparacionArtificio.php");

$id = $_POST["idee"];
$artificio = $_POST["artificio"];

$reparacion = new raparacion_artificio(1);
$reparacion ->setid($id);
$reparacion ->setartificio($artificio);
$reparacion ->modificarArtificio();

?>