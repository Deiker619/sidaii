<?php
require_once __DIR__ . "/ManejadorBD.php";
require_once __DIR__ . "/01-atenciones-estadales.php";

$aten = new AtencionesEstadales(1);
$admin = $aten->consultarTodosAtencionesAdmin();
$foundAdmin = false;
foreach($admin as $r) {
    if ($r['numero_aten'] == 270) {
        $foundAdmin = true;
    }
}

$aten->setcoordinacion('C-miran');
$coordM = $aten->consultarTodosAtenciones();
$foundCoordM = false;
foreach($coordM as $r) {
    if ($r['numero_aten'] == 270) {
        $foundCoordM = true;
    }
}

$aten->setcoordinacion('C-Dct');
$coordD = $aten->consultarTodosAtenciones();
$foundCoordD = false;
foreach($coordD as $r) {
    if ($r['numero_aten'] == 270) {
        $foundCoordD = true;
    }
}

echo "Admin sees 270? " . ($foundAdmin ? "YES" : "NO") . "\n";
echo "Miranda sees 270? " . ($foundCoordM ? "YES" : "NO") . "\n";
echo "Capital sees 270? " . ($foundCoordD ? "YES" : "NO") . "\n";
