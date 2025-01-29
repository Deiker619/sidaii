<?php
include_once("../php/12-informes_medicos.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['pdf'])) {
    $id = $_POST['id'];
    $pdf = $_FILES['pdf'];

    // Validar que el archivo sea un PDF
    if ($pdf['type'] !== 'application/pdf') {
        die("Error: Solo se permiten archivos PDF.");
    }

    // Crear la carpeta de uploads si no existe
    if (!is_dir('informes/')) {
        mkdir('informes/', 0777, true);
    }

    // Generar un nombre único para el archivo
    $nombre_archivo = uniqid() . '_' . basename($pdf['name']);
    $ruta_archivo = 'informes/' . $nombre_archivo;

    // Mover el archivo a la carpeta de uploads
    if (move_uploaded_file($pdf['tmp_name'], $ruta_archivo)) {
        // Actualizar la base de datos con la ruta del archivo
        $informes = new informes_medicos(1);
        $informes->setid($id);
        $informes->setpdf_path($ruta_archivo);
        $informes->actualizarPdf();

        // Redirigir de vuelta a la página principal
        header("Location: 21-evaluacionesMedicas.php");
        exit();
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "Acceso no autorizado.";
}
?>