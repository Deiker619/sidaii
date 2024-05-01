<?php

require_once("../php/02-personasJornadas.php");


$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$numero_jornada = $_POST["numero_jornada"];
$discapacidad = $_POST["discapacidad"];
$tipo_ayuda_tec = $_POST["tipo_ayuda_tec"];






$personas = new personasJornadas(1);

$personas->setcedula($cedula);
$personas->setayuda_tecnica($tipo_ayuda_tec);
$personas->setnumero_jornada($numero_jornada);

$consulta = $personas->autenticarAyuda();

foreach ($consulta as $i) {


    if ($i["cedula"] == $cedula) {
        echo "Ya";

    } else {
        $personas->setnombre($nombre);
        $personas->setapellido($apellido);
        $personas->setdiscapacidad($discapacidad);
        $personas->setfecha_jaten(date("Y-m-d"));
        /* $personas->insertarPersonasJornada(); */
       /*  echo "No esta registrado"; */

        $calculo = $personas->calculodeayuda();

        foreach ($calculo as $e) {
            $personas->setcedula($cedula);
            $personas->setayuda_tecnica($tipo_ayuda_tec);

         /*    echo $e["ayuda_tecnica"]; */
            if ($e["ayuda_tecnica"] == $tipo_ayuda_tec) {
                $fechaU =  $e["fecha_jaten"];
                $fechaA =  date("Y-m-d");

                $fecha1 = new DateTime($e["fecha_jaten"]);
                $fecha2 = new DateTime(date("Y-m-d"));
                $diff = $fecha1->diff($fecha2);

                // El resultados sera 3 dias
                $difer =  $diff->days;

                $datos = array(
                    "fechaU" => $fechaU,
                    "fechaA" => $fechaA,
                    "fecha1" => $fecha1,
                    "fecha2" => $fecha2,
                    "difer" => $difer
                );


                if ($difer >= 180) {
                    $mensaje = 2;
                    /* header('Content-Type: application/json'); */
                    echo json_encode($mensaje);
                    $personas->insertarPersonasJornada(); 
            
                } else {
                    $mensaje = 1;
                    /* header('Content-Type: application/json'); */
                    echo json_encode($mensaje);
                    
                }
            }else{
                $mensaje = "primera";
                echo $mensaje;
                $personas->insertarPersonasJornada(); 
            }
        }
    }
}
