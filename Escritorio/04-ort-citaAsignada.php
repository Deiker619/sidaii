<?php
require_once("../php/01-02-cita_protesis.php");
/* $nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$discapacidad = $_POST["discapacidad"];
$numero_aten = $_POST["numero_aten"];
echo $numero_aten;
$atencion_recibida = $_POST["atencion_recibida"]; */
$id = $_POST["id"];
$cedula = $_POST["cedula"];
$laboratorio = $_POST["laboratorio"];
$fecha = $_POST["fecha"];

$cita = new citas_protesis(1);
$cita ->setid($id);
$cita ->setlaboratorio($laboratorio);
$cita ->setfecha($fecha);
$cita ->modificarCita();


if($laboratorio =="4-tomedi"){
    require_once("../php/01-03-toma_medidas.php");

    $medidas = new toma_medidas(1);
    $medidas ->setcedula($cedula);
    $consultamedidas = $medidas -> autenticarMedidas();
            if (!$consultamedidas) {
                echo "Se registro a ".$nombre." exitosamente";
                $medidas ->insertarMedidas();
        
            }else{
                echo "Ya este Beneficiario se registro en esta area";
            }
    
}


if($laboratorio =="5-pruebar"){
    require_once("../php/01-04-pruebaArtificio.php");
    $medidas = new prueba_artificio(1);
    $medidas ->setcedula($cedula);
    $ConsultaPruebas = $medidas->autenticarArtificio();//Para verificar que una persona no pueda estar registrada mas de dos veces con un mismo beneficio
            if (!$ConsultaPruebas) {
                echo "Se registro a ".$nombre." exitosamente";
                $medidas ->insertarPrueba();
        
            }else{
                echo "Ya este Beneficiario se registro en esta area";
            }

    

}

?>