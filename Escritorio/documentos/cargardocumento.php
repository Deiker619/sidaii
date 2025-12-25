<?php
header('Content-Type: application/json'); // Respuesta en JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verificar si hay archivo
    if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
        echo json_encode(['error' => 'No se recibió ningún archivo o hubo un error.']);
        exit();
    }

    // Verificar número de atención
    if (empty($_POST['numero_aten'])) {
        echo json_encode(['error' => 'Número de atención no proporcionado.']);
        exit();
    }

    $numero_aten = $_POST['numero_aten'];
    $archivo = $_FILES['archivo'];
    
    // Directorio destino (asegúrate que exista y tenga permisos)
    $directorioDestino = '../../uploads/';
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }

    // Crear nombre único para evitar conflictos
    $nombre_unico = uniqid() . '.' . pathinfo($archivo['name'], PATHINFO_EXTENSION);
    $rutaCompleta = $directorioDestino . $nombre_unico;

    // Mover el archivo
    if (!move_uploaded_file($archivo['tmp_name'], $rutaCompleta)) {
        echo json_encode(['error' => 'No se pudo mover el archivo.']);
        exit();
    }

    // Incluir clase Atenciones y guardar informe
    require_once("../../php/01-atenciones.php");
    $aten = new Atenciones(1); // Conexion a la DB
    $aten->setnumero_aten($numero_aten);

    if ($aten->subirInforme($nombre_unico)) {
        echo json_encode(['mensaje' => 'Archivo subido con éxito', 'archivo' => $nombre_unico]);
    } else {
        echo json_encode(['error' => 'No se pudo actualizar la base de datos.']);
    }

} else {
    echo json_encode(['error' => 'Método no permitido']);
}
