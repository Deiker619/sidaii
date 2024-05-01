<?php
    // Conexión a la base de datos
    $host = 'localhost';
    $dbname = 'conapdis';
    $username = 'fmjgh';
    $password = 'misionfmjgh';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Configuración de la conexión
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Recuperamos el texto del POST
        $text = $_POST['text'];
        $id = $_POST['id'];


        // Preparamos la consulta SQL para insertar el texto en la base de datos
        $stmt = $conn->prepare("INSERT INTO observacion (id_atencion, observacion) VALUES (:id_atencion, :text)");

        // Ejecutamos la consulta
        $stmt->execute(['id_atencion' => $id, 'text' => $text]);

        // Si todo sale bien, devolvemos una respuesta exitosa
        http_response_code(200);
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
?>