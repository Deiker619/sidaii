<?php
header('Content-Type: application/json');

// Solo aceptar peticiones POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['message' => 'Método no permitido']);
    exit;
}

// Validar que se envió la ruta
if (!isset($_POST['ruta'])) {
    echo json_encode(['message' => 'Ruta no especificada']);
    exit;
}

$rutaRelativa = $_POST['ruta'];

// Construir la ruta absoluta
$baseDir = realpath(__DIR__ . '/../Escritorio/pdfs');
$archivoAbsoluto = realpath(__DIR__ . '/../Escritorio/' . $rutaRelativa);

// Verificar que el archivo esté dentro de la carpeta pdfs y que exista
if ($archivoAbsoluto && strpos($archivoAbsoluto, $baseDir) === 0 && is_file($archivoAbsoluto)) {
    if (unlink($archivoAbsoluto)) {
        echo json_encode(['message' => 'Archivo eliminado correctamente']);
    } else {
        echo json_encode(['message' => 'No se pudo eliminar el archivo']);
    }
} else {
    echo json_encode(['message' => 'Archivo denegado o no existe']);
}
?>