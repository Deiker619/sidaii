<?php 

require_once("__rehabilitacion.php");

if(isset($_REQUEST['tipo'])){
    $id = $_POST['idee'];
    $descripcion = $_POST['descripcion'];
    $fecha_cita = $_POST['fecha_rehabilitacion'];

    $rehabilitacionModel = new rehabilitacion(1);
    
    $rehabilitacionModel->setrehabilitacion($id);
    $rehabilitacionModel->setid($id);
    $rehabilitacionModel->setdescripcion($descripcion);
    $rehabilitacionModel->setfecha_cita($fecha_cita);
    $consulta = $rehabilitacionModel->insertarAvance();
    $consultaGeneral = $rehabilitacionModel->modificarDescripcionGeneral();
    
    if($consulta){
        $data = [
            'message' => $consulta
        ];
    
    }else{
        $data = [
            'message' => $consulta
        ];
    
    }
}



if(isset($_REQUEST['new_control'])){
    $descripcion = $_REQUEST['descripcion'];
    $fecha_cita = $_REQUEST['fecha_rehabilitacion'];
    $id = $_REQUEST['id'];
    $rehabilitacion = $_REQUEST['idee'];

    $rehabilitacionModel = new rehabilitacion(1);
    $rehabilitacionModel->setid($rehabilitacion);
    $rehabilitacionModel->setdescripcion($descripcion);
    
    $rehabilitacionModel->setfecha_cita($fecha_cita);
    $rehabilitacionModel->setrehabilitacion($id);
    $consulta = $rehabilitacionModel->insertarAvance();
    $rehabilitacionModel->insertarDescripcionDeControl();

    

}
if(isset($_REQUEST['cerrar_caso'])){

    $id = $_REQUEST['idee'];

    $rehabilitacionModel = new rehabilitacion(1);
    $rehabilitacionModel->setid($id);
    $rehabilitacionModel->eliminarUltimoCasoProceso();
    $rehabilitacionModel->cerrarCaso();

    echo 'hola' , $id;
    

}

?>