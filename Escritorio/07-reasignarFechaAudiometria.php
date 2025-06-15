<?php

header('Content-Type: application/json');
if (!isset($_POST['id']) || !isset($_POST['nueva_fecha'])){
echo json_encode(['success' =>false, 'message' => 'Datos inclompletos']);
exit;
}

require_once("../php/01-06-audiometria.php");
//Recibe los datos del formulario
$id = $_POST['id'];
$nueva_fecha = $_POST['nueva_fecha'];

try{
    //Llama a la clase audiometria
    $audiometria = new audiometria(1);
    $audiometria->setid($id);
    $audiometria->setfecha_cita($nueva_fecha);
    //Llama al metodo modificarCitaDada
    //para actualizar la fecha de la cita
    $resultado = $audiometria->modificarCitaDada();

    if($resultado > 0){
        echo json_encode(['success' => true, 'message' => 'Fecha actualizada correctamente']);
        
    }else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar la fecha']);
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}

?>

