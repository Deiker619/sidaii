<?php
include_once("../php/12-informes_medicos.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
    $id = $_POST['id'];

    $informes = new informes_medicos(1);
    $informes->setid($id);

    if ($informes->eliminarInforme($id)){
        $response = [
            'code' => 200,
            'message' => 'Registro eliminado correctamente'
        ];
    } else {
        $response = [
            'code' => 500,
            'message' => 'Error al eliminar el registro'
        ];
    }

    header('Content-Type: application/json');
    echo json_encode($response);

}else{
    $response =[
        'code' => 404,
        'message' => 'Acceso no autorizado'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>