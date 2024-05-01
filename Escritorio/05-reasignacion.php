<?php

$id = $_POST["ide"];
$fecha_pruebas = $_POST["fecha_pruebas"];

$statu = $_POST["statu"];



include_once("../php/01-04-pruebaArtificio.php");
$aten = new prueba_artificio(1);
$aten->setid($id);
$aten->setstatu($statu);
$aten->setfecha_prueba($fecha_pruebas);
$aten->reasignarPruebas();



?>