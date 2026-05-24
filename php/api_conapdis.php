<?php
require_once __DIR__ . "/Config.php";
require_once __DIR__ . "/api_key_auth.php";
require_once __DIR__ . "/01-discapacitados.php";
require_once __DIR__ . "/01-atenciones-estadales.php";
require_once __DIR__ . "/detalles_institucionales.php";
require_once __DIR__ . "/ManejadorBD.php";

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, X-API-Key");
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(204);
    exit;
}

$auth = new ApiAuth();
if (!$auth->authenticate()) {
    exit;
}

$action = $_GET["action"] ?? $_POST["action"] ?? "";

try {
    switch ($action) {
        case "health":
            handleHealth();
            break;
        case "verificar-cedula":
            handleVerificarCedula();
            break;
        case "registrar":
            handleRegistrar();
            break;
        case "discapacidades":
            handleListDiscapacidades();
            break;
        case "verificar-atencion":
            handleVerificarAtencion();
            break;
        default:
            http_response_code(400);
            echo json_encode(["success" => false, "message" => "Acción no válida"]);
            break;
    }
} catch (PDOException $e) {
    $auth->log("DB_ERROR: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error interno del servidor"]);
} catch (Exception $e) {
    $auth->log("ERROR: " . $e->getMessage());
    http_response_code(400);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

function handleListDiscapacidades(): void {
    try {
        $db = getDbConnection();
        $stmt = $db->query("SELECT id_e, nombre_e FROM discapacid_e ORDER BY nombre_e");
        $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $list = array_map(function ($row) {
            $row["nombre_e"] = mb_convert_encoding($row["nombre_e"], "UTF-8", "ISO-8859-1");
            return $row;
        }, $list);
        echo json_encode(["success" => true, "data" => $list]);
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => $e->getMessage()]);
    }
}

function handleHealth(): void {
    $dbOk = false;
    try {
        $db = new ManejadorBD(1);
        $cnn = $db->conectar(1);
        $dbOk = true;
    } catch (Exception $e) {
        $dbOk = false;
    }

    echo json_encode([
        "success" => true,
        "message" => "API SIDAII funcionando",
        "data" => [
            "env" => ENV,
            "timestamp" => date("c"),
            "php_version" => PHP_VERSION,
            "db_connected" => $dbOk,
        ]
    ]);
}

function handleVerificarCedula(): void {
    $cedula = $_GET["cedula"] ?? $_POST["cedula"] ?? "";
    if (empty($cedula) || !ctype_digit($cedula)) {
        throw new Exception("Cédula inválida");
    }

    $beneficiario = new Discapacitados(1);
    $beneficiario->setcedula($cedula);
    $result = $beneficiario->consultarDiscapacitados();

    echo json_encode([
        "success" => true,
        "exists" => $result !== false && $result !== null,
        "data" => $result ?: null,
    ]);
}

function handleVerificarAtencion(): void {
    $cedula = $_GET["cedula"] ?? $_POST["cedula"] ?? "";
    if (empty($cedula) || !ctype_digit($cedula)) {
        throw new Exception("Cédula inválida");
    }

    $db = getDbConnection();
    $stmt = $db->prepare("
        SELECT ac.numero_aten, ac.cedula, ac.fecha_creada, ac.atencion_solicitada,
               ac.statu, ac.asignado,
               COALESCE(ce.nombre_coordinacion, '(sin asignar a coordinación)') AS nombre_coordinacion,
               COALESCE(u.nombre, 'Desconocido') AS asignado_nombre,
               u.gerencia
        FROM atenciones_coordinaciones ac
        LEFT JOIN usuario u ON ac.asignado = u.cedula
        LEFT JOIN coordinaciones_estadales ce ON u.coordinacion = ce.id
        WHERE ac.cedula = :cedula
        ORDER BY ac.fecha_creada DESC
    ");
    $stmt->execute([":cedula" => $cedula]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        echo json_encode(["success" => true, "existe" => false, "message" => "No se encontraron atenciones para esta cédula"]);
        return;
    }

    foreach ($rows as &$row) {
        $row["nombre_coordinacion"] = mb_convert_encoding($row["nombre_coordinacion"], "UTF-8", "ISO-8859-1");
        $row["asignado_nombre"] = mb_convert_encoding($row["asignado_nombre"], "UTF-8", "ISO-8859-1");
    }

    echo json_encode(["success" => true, "existe" => true, "data" => $rows]);
}

function handleRegistrar(): void {
    $data = getInputData();
    validateRegistroData($data);
    $cedula = $data["cedula"];

    $db = getDbConnection();

    // 1. Verificar cédula duplicada en SIDAII
    $stmt = $db->prepare("SELECT cedula FROM beneficiario WHERE cedula = :cedula LIMIT 1");
    $stmt->execute([":cedula" => $cedula]);
    if ($stmt->fetch()) {
        throw new Exception("La cédula $cedula ya está registrada en el sistema");
    }

    // 2. Resolver IDs
    $estadoId = resolveEstado($db, $data["estado"]);
    $municipioId = resolveMunicipio($db, $data["municipio"], $estadoId);
    $parroquiaId = resolveParroquia($db, $data["parroquia"], $municipioId);
    $discapacidadId = resolveDiscapacidad($db, $data["discapacidad"]);

    // 3. Subir archivos primero (operación más propensa a fallar)
    try {
        handleAllFileUploads($data, $cedula);
    } catch (Exception $e) {
        throw new Exception("Error al subir archivos: " . $e->getMessage());
    }

    // 4. Insertar beneficiario
    $beneficiario = new Discapacitados(1);
    $beneficiario->setcedula($cedula);
    $beneficiario->setnombre($data["nombre"]);
    $beneficiario->setapellido($data["apellido"]);
    $beneficiario->setfecha_naci($data["fecha_naci"]);
    $beneficiario->setemail($data["email"] ?? "");
    $beneficiario->settelefono($data["telefono"] ?? "");
    $beneficiario->setnacionalidad($data["nacionalidad"] ?? "V");
    $beneficiario->setedad(calcularEdad($data["fecha_naci"]));
    $beneficiario->setsexo($data["sexo"]);
    $beneficiario->setcivil($data["edo_civil"] ?? "");
    $beneficiario->sethijos($data["nro_hijo"] ?? 0);
    $beneficiario->setestado($estadoId);
    $beneficiario->setmunicipio($municipioId);
    $beneficiario->setparroquia($parroquiaId);
    $beneficiario->setdiscapacidad($discapacidadId);
    $beneficiario->setatencion_solicitada("0-aten-coo");
    $beneficiario->setcod_carnet($data["certificado"] ?? "");
    $beneficiario->setregistrado_por("99999999");
    $beneficiario->setfecha_registro(date("Y-m-d H:i:s"));

    if (!$beneficiario->insertarDiscapacitados()) {
        throw new Exception("Error al insertar beneficiario");
    }

    try {
        $detalles = new detalles_institucionales(1);
        $detalles->setcedula($cedula);
        $detalles->setproteccion_social($data["proteccion_social"] ?? null);
        $detalles->setdireccion($data["direccion"] ?? "");
        $detalles->insertardetalles();
        $detalles->insertardireccion();

        $atencion = new AtencionesEstadales(1);
        $atencion->setcedula($cedula);
        $atencion->setasignado("99999999");
        $atencion->insertarAtencion();
    } catch (Exception $e) {
        $db->prepare("DELETE FROM beneficiario WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM atenciones_coordinaciones WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM detalles_institucionales WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM direcciones WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $uploadDir = UPLOAD_PATH . "/beneficiarios/" . $cedula;
        if (is_dir($uploadDir)) {
            array_map('unlink', glob("$uploadDir/*.*"));
            rmdir($uploadDir);
        }
        throw $e;
    }

    echo json_encode([
        "success" => true,
        "message" => "Beneficiario registrado exitosamente",
        "data" => ["cedula" => $cedula],
    ]);
}

function getDbConnection(): PDO {
    $db = new ManejadorBD(1);
    return $db->conectar(1);
}

function getInputData(): array {
    $input = file_get_contents("php://input");
    $data = [];
    if (!empty($input)) {
        $parsed = json_decode($input, true);
        if (is_array($parsed)) {
            $data = $parsed;
        }
    }
    return array_merge($data, $_POST);
}

function validateRegistroData(array $data): void {
    $required = ["cedula", "nombre", "apellido", "fecha_naci", "sexo", "estado", "municipio", "parroquia", "discapacidad"];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            throw new Exception("Campo requerido faltante: $field");
        }
    }
    if (!ctype_digit($data["cedula"])) {
        throw new Exception("Cédula debe ser numérica");
    }
}

function resolveEstado(PDO $cnn, string $nombre): int {
    $stmt = $cnn->prepare("SELECT id_estados FROM estados WHERE nombre_estado = :nombre OR id_estados = :id LIMIT 1");
    $stmt->execute([":nombre" => $nombre, ":id" => ctype_digit($nombre) ? $nombre : 0]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        throw new Exception("Estado no encontrado: $nombre");
    }
    return (int)$row["id_estados"];
}

function resolveMunicipio(PDO $cnn, string $nombre, int $estadoId): int {
    $stmt = $cnn->prepare("SELECT id_municipios FROM municipios WHERE (nombre = :nombre OR id_municipios = :id) AND estado = :estado LIMIT 1");
    $stmt->execute([":nombre" => $nombre, ":id" => ctype_digit($nombre) ? $nombre : 0, ":estado" => $estadoId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $stmt = $cnn->prepare("SELECT id_municipios FROM municipios WHERE nombre = :nombre LIMIT 1");
        $stmt->execute([":nombre" => $nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if (!$row) {
        throw new Exception("Municipio no encontrado: $nombre");
    }
    return (int)$row["id_municipios"];
}

function resolveParroquia(PDO $cnn, string $nombre, int $municipioId): int {
    $stmt = $cnn->prepare("SELECT id FROM parroquia WHERE (nombre_parroquia = :nombre OR id = :id) AND municipio = :municipio LIMIT 1");
    $stmt->execute([":nombre" => $nombre, ":id" => ctype_digit($nombre) ? $nombre : 0, ":municipio" => $municipioId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        $stmt = $cnn->prepare("SELECT id FROM parroquia WHERE nombre_parroquia = :nombre LIMIT 1");
        $stmt->execute([":nombre" => $nombre]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    if (!$row) {
        throw new Exception("Parroquia no encontrada: $nombre");
    }
    return (int)$row["id"];
}

function resolveDiscapacidad(PDO $cnn, string $nombre): string {
    $stmt = $cnn->prepare("SELECT id_e FROM discapacid_e WHERE id_e = :id LIMIT 1");
    $stmt->execute([":id" => $nombre]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return (string)$row["id_e"];
    }
    $stmt = $cnn->prepare("SELECT id_e FROM discapacid_e WHERE nombre_e = :nombre LIMIT 1");
    $stmt->execute([":nombre" => $nombre]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row) {
        throw new Exception("Discapacidad no encontrada: $nombre");
    }
    return (string)$row["id_e"];
}

function calcularEdad(string $fechaNaci): int {
    $nacimiento = new DateTime($fechaNaci);
    $hoy = new DateTime();
    return $hoy->diff($nacimiento)->y;
}

function handleAllFileUploads(array $data, string $cedula): void {
    $docsJson = $data["documentos"] ?? [];
    if (!empty($docsJson) && is_array($docsJson)) {
        handleBase64Files($docsJson, $cedula);
        return;
    }

    $individualFields = ["doc_cedula", "doc_informe", "doc_foto", "doc_solicitud"];
    $hasIndividual = false;
    foreach ($individualFields as $f) {
        if (isset($_FILES[$f]) && $_FILES[$f]["error"] === UPLOAD_ERR_OK) {
            $hasIndividual = true;
            break;
        }
    }
    if ($hasIndividual) {
        handleIndividualFileUploads($cedula);
        return;
    }

    $files = $_FILES["documentos"] ?? [];
    if (!empty($files) && is_array($files) && isset($files["name"])) {
        handleArrayFileUploads($files, $cedula);
    }
}

function handleBase64Files(array $documentos, string $cedula): void {
    foreach ($documentos as $field => $doc) {
        if (empty($doc["contenido"]) || empty($doc["nombre"])) continue;
        $contenido = base64_decode($doc["contenido"], true);
        if ($contenido === false) continue;
        $uploadDir = UPLOAD_PATH . "/beneficiarios/" . $cedula;
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $ext = pathinfo($doc["nombre"], PATHINFO_EXTENSION);
        $safeName = $field . "_" . $cedula . "." . $ext;
        file_put_contents($uploadDir . "/" . $safeName, $contenido);
    }
}

function handleIndividualFileUploads(string $cedula): void {
    $map = [
        "doc_cedula" => "copia_cedula",
        "doc_informe" => "informe_medico",
        "doc_foto" => "fotografia",
        "doc_solicitud" => "solicitud",
    ];
    foreach ($map as $inputName => $tableColumn) {
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]["error"] !== UPLOAD_ERR_OK) continue;
        $uploadDir = UPLOAD_PATH . "/beneficiarios/" . $cedula;
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
        $origName = basename($_FILES[$inputName]["name"]);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $safeName = $tableColumn . "_" . $cedula . "." . $ext;
        move_uploaded_file($_FILES[$inputName]["tmp_name"], $uploadDir . "/" . $safeName);
    }
}

function handleArrayFileUploads(array $files, string $cedula): void {
    $uploadDir = UPLOAD_PATH . "/beneficiarios/" . $cedula;
    if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);

    $fileFieldMap = [
        "copia_cedula" => "copia_cedula",
        "partida_nacimiento" => "partida_nacimiento",
        "constancia_estudio" => "constancia_estudio",
        "informe_medico" => "informe_medico",
    ];

    foreach ($fileFieldMap as $fieldName => $tableColumn) {
        if (!isset($files["name"][$fieldName]) || empty($files["name"][$fieldName])) continue;
        $tmpName = $files["tmp_name"][$fieldName];
        $origName = basename($files["name"][$fieldName]);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $safeName = $fieldName . "_" . $cedula . "." . $ext;
        $dest = $uploadDir . "/" . $safeName;
        if (!move_uploaded_file($tmpName, $dest)) {
            throw new Exception("Error al subir archivo: $fieldName");
        }
    }
}
