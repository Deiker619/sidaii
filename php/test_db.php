<?php
require_once __DIR__ . "/ManejadorBD.php";
$db = new ManejadorBD(1);
$cnn = $db->conectar(1);

$stmt = $cnn->query("SELECT * FROM atenciones_coordinaciones WHERE numero_aten = 270");
print_r($stmt->fetch(PDO::FETCH_ASSOC));

$stmt = $cnn->query("SELECT estado, discapacidad FROM beneficiario WHERE cedula = 2545514");
print_r($stmt->fetch(PDO::FETCH_ASSOC));
