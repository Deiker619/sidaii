<?php

if(isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'r'){
    include_once("../php/01-02-cita_protesis.php");

    $tipo_artificio = $_REQUEST['tipo_artificio'];
    $seleccionado = $_REQUEST['seleccionado'];


    $accion  = $_REQUEST['accion'];
    $cedula = $_REQUEST['cedula'];
    $servicios_json = $_REQUEST['servicios'];
    $laboratorio = $_REQUEST['laboratorio'];
    $fecha_registro = $_REQUEST['fecha_registro'];
    $fecha_asistencia = $_REQUEST['fecha_asistencia'];
    $expediente = $_REQUEST['expediente'];
    $servicios = json_decode($servicios_json, true);
    $pruebas = [];

    


    header('Content-Type: application/json');
    
    $protesis = new citas_protesis(1);
    
    try {
        
        foreach ($servicios as $servicio ) {
            if($servicio){
                if($servicio=='entrega'){
                    if($seleccionado == 'ortesis'){

                        $consulta = $protesis->insertarAtencionLaboratorio($cedula,  $laboratorio, $servicio, $fecha_registro, $fecha_asistencia, $expediente, $seleccionado, $tipo_artificio, null); 
                    }
                    if($seleccionado == 'protesis'){
                        $consulta = $protesis->insertarAtencionLaboratorio($cedula,  $laboratorio, $servicio, $fecha_registro, $fecha_asistencia, $expediente, $seleccionado,  null, $tipo_artificio); 
                    }
                  /*   if($seleccionado == 'null' or $seleccionado == null){
                        $consulta = $protesis->insertarAtencionLaboratorio($cedula,  $laboratorio, $servicio, $fecha_registro, $fecha_asistencia, $expediente, null,  null, null); 
                    } */
                }else{
                    $consulta = $protesis->insertarAtencionLaboratorio($cedula,  $laboratorio, $servicio, $fecha_registro, $fecha_asistencia, $expediente, null,  null, null);
                }

               /*  $consulta = $protesis->insertarAtencionLaboratorio($cedula,  $laboratorio, $servicio, $fecha_registro, $fecha_asistencia, $expediente, null,  null, null);  */
            }
        }
        
        $datos = [
            'cedula' => $cedula,
            'servicios' => $servicios,
            'laboratorio' => $laboratorio,
            'message' => 200,
            'prueba' => $seleccionado,
            'accion' => $accion
        ];
        echo json_encode($datos);
    } catch (\Throwable $th) {
        $datos = [
            'cedula' => $cedula,
            'servicios' => $servicios,
            'laboratorio' => $laboratorio,
            'message' => 500
        ];
    }
    
    

}


if(isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'b'){

    include_once("../php/01-02-cita_protesis.php");
    $id = $_REQUEST['id'];
    $eliminar = new citas_protesis(1);
    $consulta = $eliminar->eliminarAtencionLaboratorio($id);

    header('Content-Type: application/json');

    if($consulta){

        $datos = [
            'message' => 200
        ];
        echo json_encode($datos);
    }else{
        $datos = [
            'message' => 500
        ];
        echo json_encode($datos);
    }

}
if(isset($_REQUEST['accion']) && $_REQUEST['accion'] == 'm'){

    include_once("../php/01-02-cita_protesis.php");
    $id = $_REQUEST['id'];
    $cedula = $_REQUEST['cedula'];
    $servicios = $_REQUEST['servicios'];
    $fecha_registro = $_REQUEST['fecha_registro'];
    $fecha_asistencia = $_REQUEST['fecha_asistencia'];
    $expediente = $_REQUEST['expediente'];
    $modificar = new citas_protesis(1);
    $consulta = $modificar->modificarRegistroLaboratorio($id, $cedula, $servicios, $fecha_registro, $fecha_asistencia, $expediente);


    header('Content-Type: application/json');

    if($consulta){

        $datos = [
            'message' => 200,
            'prueba' => $servicios
        
        ];
        echo json_encode($datos);
    }else{
        $datos = [
            'message' => 500
        ];
        echo json_encode($datos);
    }

}







?>