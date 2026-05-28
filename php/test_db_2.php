<?php
require_once __DIR__ . "/ManejadorBD.php";
$db = new ManejadorBD(1);
$cnn = $db->conectar(1);

$sql = "SELECT atenciones_coordinaciones.numero_aten, beneficiario.estado, estados.id_estados
FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e, usuario, coordinaciones_estadales 
WHERE 
usuario.cedula = atenciones_coordinaciones.asignado and
usuario.coordinacion = coordinaciones_estadales.id and
beneficiario.cedula = atenciones_coordinaciones.cedula and 
beneficiario.estado = estados.id_estados and 
beneficiario.discapacidad = discapacid_e.id_e and
atenciones_coordinaciones.numero_aten = 270";

$stmt = $cnn->query($sql);
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
