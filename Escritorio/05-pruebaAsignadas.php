<?php
require_once("../php/01-04-pruebaArtificio.php");

$id = $_POST["ide"];
$pruebas = $_POST["pruebas"];

$medid = new prueba_artificio(1);
$medid ->setid($id);
$medid ->setpruebas($pruebas);
$medid ->modificarPruebas();

?>