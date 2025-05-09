<?php
require_once("../php/01-atenciones-estadales.php");

$aten = new AtencionesEstadales(1);


$por = $_POST["registrador"];

$cedula = $_POST["cedula"];
$nombre = $_POST["nombre"];
$apellido = $_POST["apellido"];
$estado = $_POST["estado"];
$discapacidad = $_POST["discapacidad"];
$fecha_aten = $_POST["fecha_aten"];
$numero_aten = $_POST["numero_aten"];

/* entrega */
$atencion_recibida = $_POST["atencion_recibida"];
$atencion_solicitada = $_POST["atencion_solicitada"];
$entrega = $_POST["entrega"];


/* remitir */
$remitir = $_POST["remitir"];
$remit = $_POST["remit"];
$informe = $_POST["informe"];
$motivo = $_POST["motivo"];
$coordinacion = $_POST["coordinacions"];



/* orientado */

$descrip_orientacion = $_POST["descrip_orientacion"];
$orientar = $_POST["orientar"];


/* otros */

$registrador = $_POST["registrador"];
$gerencia = $_POST["gerencia"];

if ($atencion_recibida) {
    $result_oac = procesarAtenciones($entrega, $numero_aten, $fecha_aten, $atencion_recibida, $por, $cedula);
    $result_op = procesarAtencionesEstadales($aten,$atencion_recibida, $entrega, $numero_aten, $fecha_aten, $por, $cedula);


    $data = array(
        'oac' => $result_oac,
        'op' => $result_op
    );

    if (array_key_exists('fechaU', $result_oac) || array_key_exists('fechaU', $result_op)) {

        $fechaOAC = $result_oac["fechaU"] ?? "01-01-1950";
        $fechaOP = $result_op["fechaU"] ?? "01-01-1950";

        $fecha1 = new DateTime($fechaOAC);
        $fecha2 = new DateTime($fechaOP);
        if ($fecha1->format('Y-m-d') > $fecha2->format('Y-m-d')) { //OAC es mayor
            $data["i"] = "OAC";
            /* Asistir($result_oac, $result_op, $entrega, $numero_aten, $fecha_aten, $atencion_recibida, $por, $cedula); */

            if ($result_oac["mensaje"] == "entregado") {
                $oac = new AtencionesEstadales(1);
                $oac->setatencion_brindada($entrega);
                $oac->setnumero_aten($numero_aten);
                $oac->setfecha_aten($fecha_aten);
                $oac->setatencion_recibida($atencion_recibida);
                $oac->setpor($por);
                $oac->setcedula($cedula);
                $consulta = $oac->modificarAtenciones();
                $oac->__destruct();
            }
        }
        if ($fecha2->format('Y-m-d') > $fecha1->format('Y-m-d')) { //OP es mayor
            $data["i"] = "OP";

            if ($result_op["mensaje"] == "entregado") {
                $oac = new AtencionesEstadales(1);
                $oac->setatencion_brindada($entrega);
                $oac->setnumero_aten($numero_aten);
                $oac->setfecha_aten($fecha_aten);
                $oac->setatencion_recibida($atencion_recibida);
                $oac->setpor($por);
                $oac->setcedula($cedula);
                $consulta = $oac->modificarAtenciones();
                $oac->__destruct();
            }
        }
        if ($fecha1->format('Y-m-d') == $fecha2->format('Y-m-d')) { //Son iguales
            $data["i"] = "igual";
        }
    }

    if ($result_oac["mensaje"] == "primera" && $result_op["mensaje"] == "primera") {
        $oac = new AtencionesEstadales(1);
        $oac->setatencion_brindada($entrega);
        $oac->setnumero_aten($numero_aten);
        $oac->setfecha_aten($fecha_aten);
        $oac->setatencion_recibida($atencion_recibida);
        $oac->setpor($por);
        $oac->setcedula($cedula);
        $consulta = $oac->modificarAtenciones();
        $oac->__destruct();
    }

    header('Content-Type: application/json');
    echo json_encode($data);
}

if ($remit) {
    $aten->setatencion_brindada($remitir);
    $aten->setnumero_aten($numero_aten);
    $aten->setfecha_aten($fecha_aten);
    $aten->setpor($por);
    $consulta = $aten->modificarAtenciones();

    if ($consulta) {
        include_once("../php/6-remitir.php");
        $remicion = new remitido(1);
        $remicion->setcedula($cedula);
        $remicion->setdepartamento($remit);
        $remicion->setfecha($fecha_aten);
        $remicion->setmotivo($motivo);
        $remicion->setregistrador($registrador);
        $remicion->setgerencia($gerencia);
        $remicion->setcoordinacion($coordinacion);
        $remicion->setsolicitud($atencion_solicitada);
        $remicion->setinforme($informe);
        $consultR = $remicion->insertarRemicion();
        $data = array();
        $data["i"] = "Remitido";
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

if ($descrip_orientacion) {
    $aten->setatencion_brindada($orientar);
    $aten->setnumero_aten($numero_aten);
    $aten->setfecha_aten($fecha_aten);
    $aten->setpor($por);

    $consulta = $aten->modificarAtenciones();
    if ($consulta) {
        include_once("../php/09-orientacion.php");
        $remicion = new orientacion(1);
        $remicion->setcedula($cedula);
        $remicion->setdescripcion($descrip_orientacion);

        $remicion->setfecha_orientacion($fecha_aten);

        $remicion->setpor($por);  /* 22/8/2023     */
        $remicion->insertarOrientacionEstadal(); /* 22/8/2023    */
        $data = array();
        $data["i"] = "Orientado";
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}

function procesarAtencionesEstadales($aten,$atencion_recibida, $entrega, $numero_aten, $fecha_aten, $por, $cedula)
{
    require_once("../php/01-atenciones-estadales.php");
    $aten = new AtencionesEstadales(1);
    $aten->setatencion_brindada($entrega);
    $aten->setnumero_aten($numero_aten);
    $aten->setfecha_aten($fecha_aten);
    $aten->setatencion_recibida($atencion_recibida);
    $aten->setpor($por);
    $aten->setcedula($cedula);

    $resultados = $aten->CalculoeAtenciones();
    foreach ($resultados as $i) {
        if ($atencion_recibida == $i["atencion_recibida"]) {
            $cordn = $i["nombre_coordinacion"];
            $fechaU =  $i["fecha_aten"];
            $fechaA =  date("Y-m-d");

            $fecha1 = new DateTime($i["fecha_aten"]);
            $fecha2 = new DateTime(date("Y-m-d"));
            $diff = $fecha1->diff($fecha2);

            // El resultado será 3 días
            $difer =  $diff->days;

            $datoss = array(
                "fechaU" => $fechaU,
                "fechaA" => $fechaA,
                "fecha1" => $fecha1,
                "fecha2" => $fecha2,
                "coordinacion" => $cordn,
                "difer" => $difer
            );

            if ($difer >= 180) {
                $datoss["mensaje"] = "entregado";
            } else {
                $datoss["mensaje"] = "Noentregado";
            }

            return $datoss;
        } else {
            $datoss = array();
            $datoss["mensaje"] = "primera";
            return $datoss;
        }
    }
}

// Llamar a la función
function procesarAtenciones($entrega, $numero_aten, $fecha_aten, $atencion_recibida, $por, $cedula)
{
    require_once("../php/01-atenciones.php");
    $aten1 = new Atenciones(1);
    $aten1->setatencion_brindada($entrega);
    $aten1->setnumero_aten($numero_aten);
    $aten1->setfecha_aten($fecha_aten);
    $aten1->setatencion_recibida($atencion_recibida);
    $aten1->setpor($por);
    $aten1->setcedula($cedula);

    $resultados = $aten1->CalculoeAtenciones();
    foreach ($resultados as $i) {
        if ($atencion_recibida == $i["atencion_recibida"]) {
            $fechaU =  $i["fecha_aten"];
            $fechaA =  date("Y-m-d");

            $fecha1 = new DateTime($i["fecha_aten"]);
            $fecha2 = new DateTime(date("Y-m-d"));
            $diff = $fecha1->diff($fecha2);

            // La diferencia será en días
            $difer =  $diff->days;

            $datos = array(
                "fechaU" => $fechaU,
                "fechaA" => $fechaA,
                "fecha1" => $fecha1,
                "fecha2" => $fecha2,
                "difer" => $difer
            );

            if ($difer >= 180) {
                $datos["mensaje"] = "entregado";
            } else {
                $datos["mensaje"] = "Noentregado";
            }

            // Devolver los datos como un arreglo asociativo
            return $datos;
        } else {
            $datos = array();
            $datos["mensaje"] = "primera";
            return $datos;
        }
    }
}
