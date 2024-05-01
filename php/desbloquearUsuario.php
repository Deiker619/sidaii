<?php
define("SRV", "localhost");
define("USR", "fmjgh");
define("PAS", "misionfmjgh");
define("BDN", "conapdis");

if(isset($_GET['desbloquear_id'])) {
    $cedula = $_GET['desbloquear_id'];
    try {
        // Crear una nueva conexión PDO. 
        $conn = new PDO('mysql:dbname='.BDN.';host='.SRV, USR, PAS);
        // Configurar PDO para lanzar excepciones cuando ocurra un error
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Preparar la consulta SQL
        $stmt = $conn->prepare('UPDATE usuario SET bloqueado = 0 WHERE cedula = :cedula');
        // Vincular el parámetro cedula a la consulta preparada
        $stmt->bindParam(':cedula', $cedula);
        // Ejecutar la consulta
        $stmt->execute();
        // Redirigir al usuario a tecnologia.php
        header("Location: tecnologia.php");
        exit();
    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
}
?>