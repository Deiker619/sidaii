<?php
header('Content-Type: application/json');

if (!isset($_POST['id']) || !isset($_POST['nueva_fecha'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

require_once "conexion.php"; // Asegúrate de incluir tu archivo de conexión

$id = $_POST['id'];
$nueva_fecha = $_POST['nueva_fecha'];

try {
    $stmt = $pdo->prepare("UPDATE audiometrias SET fecha_cita = ? WHERE id = ?");
    $success = $stmt->execute([$nueva_fecha, $id]);

    if ($success && $stmt->rowCount() > 0) {
        echo json_encode(['success' => true, 'message' => 'Fecha actualizada correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se realizaron cambios']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error en la base de datos: ' . $e->getMessage()]);
}
?>