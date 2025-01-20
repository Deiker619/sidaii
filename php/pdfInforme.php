<?php

// Ajustar la ruta de inclusión para ManejadorBD.php
include_once("../php/ManejadorBD.php");

if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];
    $pdf = isset($_FILES['pdf']) ? $_FILES['pdf'] : null;

    // Crear una instancia de ManejadorBD y conectar a la base de datos
    $manejadorBD = new ManejadorBD(1); // 1 para MySQL, 0 para PostgreSQL
    $conn = $manejadorBD->conectar(1); // Usamos 1 también aquí, ya que $tipoConexion se pasa al método conectar

    if (!$conn) {
        echo json_encode(['success' => false, 'message' => 'Error al conectar a la base de datos.']);
        exit;
    }

    // Verificar si la cédula existe en la base de datos
    $sql = "SELECT * FROM cita_ortesis_protesis WHERE cedula = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $cedula); // Usamos bindParam para evitar inyecciones SQL
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        if ($pdf) {
            // La cédula existe en la base de datos, proceder con la carga del archivo
            $uploadDir = '../Escritorio/informesMedicos/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Crear el directorio si no existe
            }

            // Nombre del archivo PDF
            $fileName = 'informe_' . $cedula . '_' . time() . '.pdf';
            $filePath = $uploadDir . $fileName;

            // Mover el archivo
            if (move_uploaded_file($pdf['tmp_name'], $filePath)) {
                // Devolver la respuesta al cliente
                echo json_encode(['success' => true, 'file' => $fileName, 'path' => $filePath]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al cargar el archivo.']);
            }
        } else {
            // Solo verificar la cédula
            echo json_encode(['success' => true, 'message' => 'Cédula verificada.']);
        }
    } else {
        // La cédula no existe en la base de datos
        echo json_encode(['success' => false, 'message' => 'La cédula no está registrada en el sistema.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Faltan datos.']);
}
?>
