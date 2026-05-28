<?php
require_once __DIR__ . "/ManejadorBD.php";
$db = new ManejadorBD(1);
$cnn = $db->conectar(1);

$estadoId = 14;

$stmt = $cnn->prepare("
    SELECT u.cedula, u.nombre, u.rol 
    FROM usuario u
    JOIN coordinaciones_estadales ce ON u.coordinacion = ce.id
    JOIN estados e ON ce.codigo = e.codigo
    WHERE e.id_estados = :estado_id
");
$stmt->execute([':estado_id' => $estadoId]);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

print_r($rows);
