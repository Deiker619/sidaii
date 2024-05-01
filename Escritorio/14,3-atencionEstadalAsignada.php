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
$motivo = $_POST["motivo"];



/* orientado */

$descrip_orientacion = $_POST["descrip_orientacion"];
$orientar = $_POST["orientar"];


/* otros */

$registrador = $_POST["registrador"];
$gerencia = $_POST["gerencia"];

if ($atencion_recibida) {
    $aten->setatencion_brindada($entrega);
    $aten->setnumero_aten($numero_aten);
    $aten->setfecha_aten($fecha_aten);
    $aten->setatencion_recibida($atencion_recibida);
    $aten->setpor($por);
    $aten->setcedula($cedula);



    $resultados = $aten->CalculoeAtenciones();
    foreach ($resultados as $i) {

        if ($atencion_recibida == $i["atencion_recibida"]) {
            $fechaU =  $i["fecha_aten"];
            $fechaA =  date("Y-m-d");

            $fecha1 = new DateTime($i["fecha_aten"]);
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
            $datos["mensaje"] = "entregado";
            header('Content-Type: application/json');
            echo json_encode($datos);
            $consulta = $aten->modificarAtenciones();

            
            } else {
                $datos["mensaje"] = "Noentregado";
            header('Content-Type: application/json');
            echo json_encode($datos);
           
            }
        } else {
        $mensaje = "primera";
        echo $mensaje;
        $consulta = $aten->modificarAtenciones();
            

        }
    }
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
        $consultR = $remicion->insertarRemicion();
        header('Content-Type: application/json');
        echo json_encode("Remitido");
    }
}

if ($descrip_orientacion) {
    $aten->setatencion_brindada($orientar);
    $aten->setnumero_aten($numero_aten);
    $aten->setfecha_aten($fecha_aten);
    $aten->setpor($por);

    $consulta = $aten->modificarAtenciones();
    if ($consulta) {
        echo "Orientado";
        include_once("../php/09-orientacion.php");
        $remicion = new orientacion(1);
        $remicion->setcedula($cedula);
        $remicion->setdescripcion($descrip_orientacion);

        $remicion->setfecha_orientacion($fecha_aten);

        $remicion->setpor($por);  /* 22/8/2023     */
        $remicion->insertarOrientacionEstadal(); /* 22/8/2023    */
        
    }
}
?>
