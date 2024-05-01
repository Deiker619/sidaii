<?php
require_once("05-participante_encuentro.php");



$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido= $_POST["apellido"];
$telefono= $_POST["telefono"];
$email= $_POST["email"];
$numero_encuentro= $_POST["numero_encuentro"];
$discapacidad= $_POST["discapacidadE"];
$parroquia= $_POST["parroquia"];
$edad = $_POST["edad"];
$fecha_nacimiento = $_POST["fecha"];
$sexo = $_POST["sexo"];
$nacionalidad = $_POST["nacionalidad"];

$solicitud = new participante_encuentro(1);
$solicitud -> setencuentro($numero_encuentro);
$solicitud -> setcedula($cedula);

$verificar = $solicitud->autenticar();
if($verificar){
    echo "2";
}else{
$solicitud -> setNombre($nombre);
$solicitud -> setApellido($apellido);
$solicitud -> setTelefono($telefono);
$solicitud -> setEmail($email);
$solicitud -> setDiscapacidad($discapacidad);
$solicitud -> setParroquia($parroquia);

$solicitud -> setEdad($edad);
$solicitud -> setSexo($sexo);
$solicitud -> setFechaNacimiento($fecha_nacimiento);
$solicitud -> setNacionalidad($nacionalidad);
$solicitud -> insertarParticipante();
}
?>