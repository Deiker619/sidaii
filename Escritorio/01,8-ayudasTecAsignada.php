<?php
require_once("../php/01-01-ayudas_tec.php");
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$estado = $_POST["estado"];
$discapacidad = $_POST["discapacidad"];
$fecha_aten = $_POST["fecha_aten"];
$numero_aten = $_POST["numero_aten"];
echo $numero_aten;
$atencion_recibida = $_POST["atencion_recibida"];
$id = $_POST["id"];
$tipo_ayuda_tec = $_POST["tipo_ayuda_tec"];

$ayudas_tec  = new Ayudas_tec(1);
$ayudas_tec ->setid($id);
$ayudas_tec ->settipo_ayuda_tec($tipo_ayuda_tec);
$ayudas_tec ->modificarAyudas_tec();

?>