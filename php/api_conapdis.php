<?php
require_once __DIR__ . "/Config.php";
require_once __DIR__ . "/api_key_auth.php";
require_once __DIR__ . "/01-discapacitados.php";
require_once __DIR__ . "/01-atenciones-estadales.php";
require_once __DIR__ . "/detalles_institucionales.php";
require_once __DIR__ . "/ManejadorBD.php";
require_once __DIR__ . "/MailHelper.php";

define("DOC_CEDULA_PATH",     __DIR__ . "/../Escritorio/documentos/cedula_beneficiarios");
define("DOC_INFORME_PATH",    __DIR__ . "/../Escritorio/documentos/informes");
define("DOC_FOTO_PATH",       __DIR__ . "/../Escritorio/documentos/doc_foto_web");
define("DOC_SOLICITUD_PATH",  __DIR__ . "/../Escritorio/documentos/doc_solicitud_web");

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
    match ($action) {
        "health" => handleHealth(),
        "verificar-cedula" => handleVerificarCedula(),
        "registrar" => handleRegistrar(),
        "discapacidades" => handleListDiscapacidades(),
        "ubicaciones" => handleUbicaciones(),
        "verificar-atencion" => handleVerificarAtencion(),
        default => throw new Exception("Acción no válida", 400),
    };
} catch (PDOException $e) {
    $auth->log("DB_ERROR: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Error interno del servidor"]);
} catch (Exception $e) {
    $auth->log("ERROR: " . $e->getMessage());
    $code = $e->getCode() ?: 400;
    http_response_code(is_numeric($code) && $code >= 400 ? $code : 400);
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

function handleListDiscapacidades(): void {
    $db = getDbConnection();
    $stmt = $db->query("SELECT id_e, nombre_e FROM discapacid_e ORDER BY nombre_e");
    $list = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $list = array_map(fn($row) => [
        "id_e" => $row["id_e"],
        "nombre_e" => $row["nombre_e"]
    ], $list);
    
    echo json_encode(["success" => true, "data" => $list]);
}

function handleUbicaciones(): void {
    $db = getDbConnection();

    // Get all estados
    $estados = $db->query("SELECT id_estados, nombre_estado FROM estados ORDER BY id_estados + 0")->fetchAll(PDO::FETCH_ASSOC);
    // Get all municipios
    $municipios = $db->query("SELECT id_municipios, estado, nombre FROM municipios")->fetchAll(PDO::FETCH_ASSOC);
    // Get all parroquias
    $parroquias = $db->query("SELECT id, municipio, nombre_parroquia FROM parroquia")->fetchAll(PDO::FETCH_ASSOC);

    // Build hierarchy
    $parroquiasByMunicipio = [];
    foreach ($parroquias as $p) {
        $mid = $p["municipio"];
        if (!isset($parroquiasByMunicipio[$mid])) $parroquiasByMunicipio[$mid] = [];
        $parroquiasByMunicipio[$mid][] = $p["nombre_parroquia"];
    }

    $municipiosByEstado = [];
    foreach ($municipios as $m) {
        $eid = $m["estado"];
        if (!isset($municipiosByEstado[$eid])) $municipiosByEstado[$eid] = [];
        $municipiosByEstado[$eid][] = [
            "nombre" => $m["nombre"],
            "parroquias" => $parroquiasByMunicipio[$m["id_municipios"]] ?? []
        ];
    }

    $result = [];
    foreach ($estados as $e) {
        $eid = $e["id_estados"];
        $result[] = [
            "id" => $eid,
            "nombre" => $e["nombre_estado"],
            "municipios" => $municipiosByEstado[$eid] ?? []
        ];
    }

    echo json_encode(["success" => true, "data" => $result], JSON_UNESCAPED_UNICODE);
}

function handleHealth(): void {
    $dbOk = false;
    try {
        $db = getDbConnection();
        $dbOk = true;
    } catch (Exception $e) {
        $dbOk = false;
    }

    echo json_encode([
        "success" => true,
        "message" => "API SIDAII funcionando",
        "data" => [
            "env" => defined('ENV') ? ENV : 'production',
            "timestamp" => date("c"),
            "php_version" => PHP_VERSION,
            "db_connected" => $dbOk,
        ]
    ]);
}

function handleVerificarCedula(): void {
    $cedula = $_GET["cedula"] ?? $_POST["cedula"] ?? "";
    if (empty($cedula) || !ctype_digit((string)$cedula)) {
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
    if (empty($cedula) || !ctype_digit((string)$cedula)) {
        throw new Exception("Cédula inválida");
    }

    $db = getDbConnection();
    $stmt = $db->prepare(<<<SQL
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
    SQL);
    
    $stmt->execute([":cedula" => $cedula]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (!$rows) {
        echo json_encode(["success" => true, "existe" => false, "message" => "No se encontraron atenciones para esta cédula"]);
        return;
    }

    // Data is already UTF-8 from PDO; no conversion needed

    echo json_encode(["success" => true, "existe" => true, "data" => $rows]);
}

function handleRegistrar(): void {
    $data = getInputData();
    validateRegistroData($data);
    $cedula = $data["cedula"];

    $db = getDbConnection();

    // 1. Verificar cédula duplicada
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

    // 3. Subir archivos
    try {
        handleAllFileUploads($data, $cedula);
    } catch (Exception $e) {
        throw new Exception("Error al subir archivos: " . $e->getMessage());
    }

    // 4. Inserción con limpieza en caso de error
    try {
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
        $beneficiario->setdireccion($data["direccion"] ?? "");

        if (!$beneficiario->insertarDiscapacitados()) {
            throw new Exception("Error al insertar beneficiario");
        }

        $detalles = new detalles_institucionales(1);
        $detalles->setcedula($cedula);
        $detalles->setproteccion_social($data["proteccion_social"] ?? null);
        $detalles->setdireccion($data["direccion"] ?? "");
        $detalles->insertardetalles();
        $detalles->insertardireccion();

        // Asignar dinámicamente a un usuario de la coordinación correspondiente
        $asignado = getCoordinadorParaEstado($db, $estadoId);

        $atencion = new AtencionesEstadales(1);
        $atencion->setcedula($cedula);
        $atencion->setasignado($asignado);
        $atencion->insertarAtencion();

        // ─── Envío de correo de confirmación (solo si hay email) ───
        $emailBeneficiario = $data["email"] ?? "";
        if ($emailBeneficiario !== "") {
            try {
                $mailer = new MailHelper();
                $enviado = $mailer->sendRegistroExitoso(
                    $emailBeneficiario,
                    $data["nombre"],
                    $data["apellido"],
                    $cedula
                );
                if (!$enviado) {
                    logError("EMAIL_FALLIDO: {$emailBeneficiario} — {$mailer->getLastError()}");
                }
            } catch (Exception $e) {
                logError("EMAIL_ERROR: {$emailBeneficiario} — " . $e->getMessage());
            }
        }

    } catch (Exception $e) {
        // Rollback manual (ya que usamos múltiples clases con sus propias conexiones)
        $db->prepare("DELETE FROM beneficiario WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM atenciones_coordinaciones WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM detalles_institucionales WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        $db->prepare("DELETE FROM direcciones WHERE cedula = :cedula")->execute([":cedula" => $cedula]);
        
        $docDirs = [DOC_CEDULA_PATH, DOC_INFORME_PATH, DOC_FOTO_PATH, DOC_SOLICITUD_PATH];
        foreach ($docDirs as $dir) {
            foreach (glob($dir . "/*_" . $cedula . ".*") as $file) {
                if (is_file($file)) {
                    unlink($file);
                }
            }
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
    if (!ctype_digit((string)$data["cedula"])) {
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

function getCoordinadorParaEstado(PDO $db, int $estadoId): string {
    // Buscar un coordinador de ese estado
    $stmt = $db->prepare("
        SELECT u.cedula 
        FROM usuario u
        JOIN coordinaciones_estadales ce ON u.coordinacion = ce.id
        JOIN estados e ON ce.codigo = e.codigo
        WHERE e.id_estados = :estado_id AND u.rol = 'Coord'
        LIMIT 1
    ");
    $stmt->execute([':estado_id' => $estadoId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return (string)$row['cedula'];
    }
    
    // Fallback: cualquier usuario de ese estado
    $stmt = $db->prepare("
        SELECT u.cedula 
        FROM usuario u
        JOIN coordinaciones_estadales ce ON u.coordinacion = ce.id
        JOIN estados e ON ce.codigo = e.codigo
        WHERE e.id_estados = :estado_id
        LIMIT 1
    ");
    $stmt->execute([':estado_id' => $estadoId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($row) {
        return (string)$row['cedula'];
    }

    // Fallback final: usuario sistema web
    return "99999999";
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

function getDocPath(string $field): ?string {
    return match ($field) {
        "doc_cedula"    => DOC_CEDULA_PATH,
        "doc_informe"   => DOC_INFORME_PATH,
        "doc_foto"      => DOC_FOTO_PATH,
        "doc_solicitud" => DOC_SOLICITUD_PATH,
        default         => null,
    };
}

function handleBase64Files(array $documentos, string $cedula): void {
    foreach ($documentos as $field => $doc) {
        if (empty($doc["contenido"]) || empty($doc["nombre"])) continue;
        
        $uploadDir = getDocPath($field);
        if ($uploadDir === null) continue;
        
        $contenido = base64_decode($doc["contenido"], true);
        if ($contenido === false) continue;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $ext = pathinfo($doc["nombre"], PATHINFO_EXTENSION);
        $safeName = $field . "_" . $cedula . "." . $ext;
        file_put_contents($uploadDir . "/" . $safeName, $contenido);
    }
}

function handleIndividualFileUploads(string $cedula): void {
    $fieldMap = [
        "doc_cedula"    => DOC_CEDULA_PATH,
        "doc_informe"   => DOC_INFORME_PATH,
        "doc_foto"      => DOC_FOTO_PATH,
        "doc_solicitud" => DOC_SOLICITUD_PATH,
    ];
    
    foreach ($fieldMap as $inputName => $uploadDir) {
        if (!isset($_FILES[$inputName]) || $_FILES[$inputName]["error"] !== UPLOAD_ERR_OK) continue;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        $origName = basename($_FILES[$inputName]["name"]);
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $safeName = $inputName . "_" . $cedula . "." . $ext;
        
        move_uploaded_file($_FILES[$inputName]["tmp_name"], $uploadDir . "/" . $safeName);
    }
}

function handleArrayFileUploads(array $files, string $cedula): void {
    $fieldMap = [
        "copia_cedula"       => DOC_CEDULA_PATH,
        "informe_medico"     => DOC_INFORME_PATH,
        "doc_foto"           => DOC_FOTO_PATH,
        "doc_solicitud"      => DOC_SOLICITUD_PATH,
    ];

    foreach ($fieldMap as $fieldName => $uploadDir) {
        if (!isset($files["name"][$fieldName]) || empty($files["name"][$fieldName])) continue;
        
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
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

/**
 * Log seguro disponible desde cualquier función sin depender de $auth.
 */
function logError(string $msg): void {
    $logDir = __DIR__ . "/logs";
    if (!is_dir($logDir)) {
        mkdir($logDir, 0755, true);
    }
    $line = date("Y-m-d H:i:s") . " [" . ($_SERVER["REQUEST_METHOD"] ?? "?") . " " . ($_GET["action"] ?? "?") . "] " . $msg . PHP_EOL;
    file_put_contents($logDir . "/api.log", $line, FILE_APPEND | LOCK_EX);
}
