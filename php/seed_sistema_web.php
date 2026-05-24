<?php
require_once __DIR__ . "/Config.php";
require_once __DIR__ . "/03-usuario.php";

echo "=== Seed: Usuario Sistema Web ===\n\n";

$cedula = "99999999";

$user = new Usuario(1);
$user->setcedula($cedula);

$existing = $user->consultarUsuarios();

if ($existing) {
    echo "[INFO] El usuario $cedula ya existe:\n";
    echo "  Nombre: " . ($existing["nombre"] ?? "N/A") . "\n";
    echo "  Gerencia: " . ($existing["gerencia"] ?? "N/A") . "\n";
    echo "  Rol: " . ($existing["rol"] ?? "N/A") . "\n";
    echo "  Coordinacion: " . ($existing["coordinacion"] ?? "N/A") . "\n";
    echo "\nNo se realizaron cambios.\n";
    exit;
}

$user->setpasswordd(password_hash("sistema_web_2026", PASSWORD_DEFAULT));
$user->setnombre("Sistema Web");
$user->setemail("sistemaweb@sidaii.gob.ve");
$user->settelefono("0000000000");
$user->setsexo("M");
$user->setgerencia("4Gtno");
$user->setrol("2coor");
$user->setinstitucion("CONAPDIS");

$result = $user->insertarUsuarios();

if ($result) {
    echo "[OK] Usuario $cedula creado exitosamente.\n\n";
    echo "Detalles:\n";
    echo "  Cedula:     $cedula\n";
    echo "  Nombre:     Sistema Web\n";
    echo "  Gerencia:   4Gtno (Gestion Operativa Estadal)\n";
    echo "  Rol:        2coor (Coordinador)\n";
    echo "  Password:   sistema_web_2026 (hasheado)\n";
} else {
    echo "[ERROR] No se pudo crear el usuario $cedula.\n";
}

echo "\n=== Fin Seed ===\n";
