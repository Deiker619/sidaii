<?php
try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=localhost;dbname=conapdis", "fmjgh", "misionfmjgh");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener el número total de registros
    $queryTotal = "SELECT COUNT(*) FROM beneficiario";
    $numTotalStmt = $pdo->query($queryTotal);
    $num_total_registros = $numTotalStmt->fetchColumn();

    // Consulta para obtener el número de registros de beneficiarios en el mes actual
    $queryMesActual = "SELECT COUNT(*) FROM beneficiario WHERE fecha_registro >= DATE_FORMAT(CURDATE(), '%Y-%m-01')";
    $numMesActualStmt = $pdo->query($queryMesActual);
    $num_registros_mes_actual = $numMesActualStmt->fetchColumn();

    // Consulta para obtener el número de registros de beneficiarios del mes anterior
    $queryMesAnterior = "SELECT COUNT(*) FROM beneficiario WHERE fecha_registro >= DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01') AND fecha_registro < DATE_FORMAT(CURDATE(), '%Y-%m-01')";
    $numMesAnteriorStmt = $pdo->query($queryMesAnterior);
    $num_registros_mes_anterior = $numMesAnteriorStmt->fetchColumn();

    // Cálculo del porcentaje de registros del mes actual
    $porcentaje_mes_actual = ($num_total_registros > 0) ? round(($num_registros_mes_actual / $num_total_registros) * 100, 1) : 0;

    // Cálculo del porcentaje de registros del mes anterior
    $porcentaje_mes_anterior = ($num_total_registros > 0) ? round(($num_registros_mes_anterior / $num_total_registros) * 100, 1) : 0;

    // Verificar si ya existe un registro para el mes actual en la tabla "porcentajes"
    $queryExisteRegistro = "SELECT COUNT(*) FROM porcentajes WHERE fecha = DATE_FORMAT(CURDATE(), '%M')";
    $existe_registro = $pdo->query($queryExisteRegistro)->fetchColumn();

    if (!$existe_registro) {
        // Insertar un nuevo registro con el porcentaje actual
        $insertQuery = "INSERT INTO porcentajes (fecha, porcentaje) VALUES (DATE_FORMAT(CURDATE(), '%M'), :porcentaje)";
        $insertStmt = $pdo->prepare($insertQuery);
        $insertStmt->bindValue(':porcentaje', $porcentaje_mes_actual);
        $insertStmt->execute();
    } else {
        // Actualizar el registro existente con el nuevo porcentaje
        $updateQuery = "UPDATE porcentajes SET porcentaje = :porcentaje WHERE fecha = DATE_FORMAT(CURDATE(), '%M')";
        $updateStmt = $pdo->prepare($updateQuery);
        $updateStmt->bindValue(':porcentaje', $porcentaje_mes_actual);
        $updateStmt->execute();
    }
    
    // Mostrar el porcentaje y la flecha correspondiente
    echo "<div class='porcentaje_div'><div class='porcentaje'>Porcentaje de registros este mes: $porcentaje_mes_actual%";
    echo ($porcentaje_mes_actual > $porcentaje_mes_anterior) ? "<span class='subida'>▲</span></div></div>" : '<span class="bajada">▼</span></div></div>';
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
