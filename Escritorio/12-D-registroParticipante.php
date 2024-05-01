<?php
require_once("../php/participante_escuela.php");



$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido= $_POST["apellido"];
$telefono= $_POST["telefono"];
$email= $_POST["email"];
$numero_escuela= $_POST["numero_escuela"];
$discapacidad= $_POST["discapacidad"];
$estado= $_POST["estado"];
$municipio= $_POST["municipio"];
$parroquia= $_POST["parroquia"];
$edad = $_POST["edad"];
$fecha_nacimiento = $_POST["fecha_naci"];
$sexo = $_POST["sexo"];
$nacionalidad = $_POST["nacionalidad"];

$solicitud = new participante_escuela(1);
$solicitud -> setid_curso($numero_escuela);
$solicitud -> setcedula($cedula);

$verificar = $solicitud->autenticar();
if($verificar){
    echo 2;
}else{
$solicitud -> setnombre($nombre);
$solicitud -> setapellido($apellido);
$solicitud -> settelefono($telefono);
$solicitud -> setemail($email);
$solicitud -> setdiscapacidad($discapacidad);
$solicitud -> setestado($estado);
$solicitud -> setmunicipio($municipio);
$solicitud -> setparroquia($parroquia);

$solicitud -> setedad($edad);
$solicitud -> setsexo($sexo);
$solicitud -> setfecha_naci($parroquia);
$solicitud -> setnacionalidad($nacionalidad);
$solicitud -> insertarParticipante();
}
?>