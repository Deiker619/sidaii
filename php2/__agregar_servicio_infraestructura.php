<?php

$cedula = $_REQUEST['cedula'];
$servicio = $_REQUEST['servicio'];
$cedulauser = $_REQUEST['cedulauser'];
include_once("../php/01-discapacitados.php");

$beneficiario = new discapacitados(1);
$beneficiario->setcedula($cedula);


$consulta = $beneficiario->consultarDiscapacitados();

if ($consulta) {

    switch ($servicio) {
        case 'protesis_proyecto':
            require_once("../php/01-02-cita_protesis.php");
            $cita = new citas_protesis(1);
            $cita->setcedula($cedula);
            $consultaayuda = $cita->autenticarProtesis();
            $cita->insertarCita();
            header('Content-Type: application/json');
            $datos = [
                'code' => 200,
                'message' => 'Se registró en servicio de protesis por proyecto'
            ];
            echo json_encode($datos);

            break;
        case 'audiometria':
            require_once("../php/01-06-audiometria.php");
            $medidas = new audiometria(1);
            $medidas->setcedula($cedula);


            $medidas->insertarCita();
            header('Content-Type: application/json');
            $datos = [
                'code' => 200,
                'message' => 'Se registró en servicio de audiometria'
            ];
            echo json_encode($datos);

            break;

        case 'rehabilitacion':

            require_once("__rehabilitacion.php");
            $atencion = new rehabilitacion(1);
            $atencion->setcedula($cedula);
            $atencion->setpor($cedulauser);
            $atencion->insertarCita();
            header('Content-Type: application/json');
            $datos = [
                'code' => 200,
                'message' => 'Se registró en servicio de rehabilitacion'
            ];
            echo json_encode($datos);
            break;
        case 'reparacion_artificio':
            

            require_once("../php/01-05-reparacionArtificio.php");
            $medidas = new raparacion_artificio(1);
            $medidas->setcedula($cedula);
            $ConsultaPruebas = $medidas->autenticarReparacion();
            $medidas->insertarReparacion();
            header('Content-Type: application/json');
            $datos = [
                'code' => 200,
                'message' => 'Se registró en servicio de reparación'
            ];
            echo json_encode($datos);
            break;

        case 'informe_medico':
            require_once("../php/12-informes_medicos.php");
            $informe = new informes_medicos(1);
            $informe->setcedula($cedula);
            $informe->setnombre($consulta['nombre']); // Asumiendo que $consulta tiene el nombre del beneficiario
            $informe->insertarInforme();
            header('Content-Type: application/json');
            $datos = [
                'code' => 200,
                'message' => 'Se registró en servicio de informes médicos'
            ];
            echo json_encode($datos);
            break;




        default:
            # code...
            break;
    }
} else {
    header('Content-Type: application/json');

    $datos = [
        'code' => 404
    ];
    echo json_encode($datos);
}
