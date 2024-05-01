<?php 

include_once("01-discapacitados.php");

$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$email = $_POST["email"];
$telefono = $_POST["telefono"];
$fecha_naci = $_POST["fecha_naci"];
$edad = $_POST["edad"];
$hijos = $_POST["hijos"];
$civil = $_POST["civil"];
$estado = $_POST["estado"];
$municipio = $_POST["municipio"];
$parroquia = $_POST["parroquia"];
$discapacidad = $_POST["discapacidad"];
$carnet = $_POST["carnet"];
/* $registrador = $_POST["registrador"]; */
/* $fecha_registro = $_POST["fecha_registro"]; */
$cuidador = $_POST["cuidador"]?? null;
$cedula_cui = $_POST["cedula_cui"]?? null;
$nombre_empre = $_POST["nombre_empre"]?? null;
$rif_emp = $_POST["rif_emp"]?? null;
$area_comerc = $_POST["area_comerc"]?? null;
$banco = $_POST["banco"]?? null;
$bono = $_POST["bono"]?? null;
$institucion = $_POST["institucion"]?? null;
$sexo = $_POST["sexo"];



$beneficiario = new Discapacitados(1);


$beneficiario->setcedula($cedula);
$beneficiario->setnombre($nombre);
$beneficiario->setapellido($apellido);
$beneficiario->settelefono($telefono);
$beneficiario->setemail($email);
$beneficiario->setfecha_naci($fecha_naci);
$beneficiario->setedad($edad);
$beneficiario->sethijos($hijos); // Agregado
$beneficiario->setcivil($civil); // Agregado
$beneficiario->setcod_carnet($carnet); // Agregado
/* $beneficiario->setdireccion($direccion); // Agregado */

$beneficiario->setestado($estado);
$beneficiario->setmunicipio($municipio);
$beneficiario->setparroquia($parroquia);
$beneficiario->setdiscapacidad($discapacidad);
/* $beneficiario->setregistrado_por($registrado_por);
$beneficiario->setfecha_registro($fecha_registro); */
$beneficiario->setsexo($sexo); // Agregado

$beneficiario->modificarDiscapacitados();





?>