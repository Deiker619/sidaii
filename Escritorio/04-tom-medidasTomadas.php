<?php
require_once("../php/01-03-toma_medidas.php");

$id = $_POST["ide"];
$medidas = $_POST["medidas"];
$fechaActual = $_POST["fechaActual"];
$artificio = $_POST["artificio"];

$medid = new toma_medidas(1);

$medid ->setid($id);
$medid ->setmedidas($medidas);
$medid ->setfecha_medidas($fechaActual);
$medid ->setartificio($artificio);
$medid ->modificarMedidas();





?>