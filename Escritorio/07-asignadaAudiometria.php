<?php
require_once("../php/01-06-audiometria.php");



if ($_POST['statusModified']) {
    $medid = new audiometria(1);
    $id = $_POST["id"];
    $medid->setid($id);
    $cita_cerrada = $medid->cargar_nuevo_estado();

    if ($cita_cerrada) {

        $data = [
            'message' => 'Operación completada',
            'others' => ''
        ];
        header('Content-Type: application/json');
        echo json_encode($data);
    } else {

        $data = [];
        header('Content-Type: application/json');
        echo json_encode($data);
    }
} else {

    $id = $_POST["id"];
    $fecha_cita = $_POST["fecha_cita"];
    $status = $_POST["status"];
    $descripcion = $_POST["descripcion"];

    $medid = new audiometria(1);
    $medid->setid($id);
    $medid->setfecha_cita($fecha_cita);
    $medid->setdescripcion($descripcion);
    $medid->setstatus($status);

    $medid->modificarCita();
}
