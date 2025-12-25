<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Verificar si hay archivos en la solicitud
  if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
    // Ruta donde se guardará el archivo (ajusta según tus necesidades)
    $directorioDestino = '';

    // Mover el archivo al directorio de destino
    $nombreArchivo = $_FILES['archivo']['name'];
    $numero_aten = $_POST["numero_aten"];
    $nombre_unico = uniqid() . "." . pathinfo($nombreArchivo, PATHINFO_EXTENSION);
    $rutaCompleta = $directorioDestino . $nombre_unico;

    if (move_uploaded_file($_FILES['archivo']['tmp_name'], $rutaCompleta)) {

      // Archivo subido exitosamente

      // Puedes realizar aquí cualquier procesamiento adicional o almacenar la información en una base de datos

      // Envía una respuesta JSON al cliente (puedes personalizar según tus necesidades)
      
      // Intentar actualizar la base de datos de forma robusta.
      $updated = false;

      // Si la sesion indica gerencia intentamos según esa preferencia
      if (isset($_SESSION["gerencia"]) && $_SESSION["gerencia"] == "2Atc") {
        try {
          require_once("../../../php/01-atenciones.php");
          $aten = new Atenciones(1);
          $aten->setnumero_aten($numero_aten);
          $updated = $aten->subirInforme($nombre_unico) || $updated;
        } catch (Exception $e) {
          error_log('Error actualizando Atenciones (2Atc): '.$e->getMessage());
        }
      }

      if (isset($_SESSION["gerencia"]) && $_SESSION["gerencia"] == "4Gtno") {
        try {
          require_once("../../../php/01-atenciones-estadales.php");
          $atenE = new AtencionesEstadales(1);
          $atenE->setnumero_aten($numero_aten);
          $updated = $atenE->subirInforme($nombre_unico) || $updated;
        } catch (Exception $e) {
          error_log('Error actualizando AtencionesEstadales (4Gtno): '.$e->getMessage());
        }
      }

      // Si no se actualizó por la sesión (o la sesión no estaba definida), intentar con las dos clases por si acaso
      if (!$updated) {
        try {
          require_once("../../../php/01-atenciones.php");
          $aten = new Atenciones(1);
          $aten->setnumero_aten($numero_aten);
          $updated = $aten->subirInforme($nombre_unico) || $updated;
        } catch (Exception $e) {
          error_log('Intento fallback Atenciones fallido: '.$e->getMessage());
        }
      }

      if (!$updated) {
        try {
          require_once("../../../php/01-atenciones-estadales.php");
          $atenE = new AtencionesEstadales(1);
          $atenE->setnumero_aten($numero_aten);
          $updated = $atenE->subirInforme($nombre_unico) || $updated;
        } catch (Exception $e) {
          error_log('Intento fallback AtencionesEstadales fallido: '.$e->getMessage());
        }
      }

      // Responder indicando si la actualización en BD tuvo éxito o no
      if ($updated) {
        echo json_encode(['mensaje' => 'Archivo subido con éxito', 'archivo' => $nombre_unico]);
      } else {
        // Aun así devolvemos éxito de subida del archivo pero informamos que no se actualizó la BD
        echo json_encode(['mensaje' => 'Archivo subido al servidor, pero no se pudo actualizar la base de datos', 'archivo' => $nombre_unico]);
      }
    } else {
      // Error al mover el archivo
      echo json_encode(['error' => 'Error al mover el archivo']);
    }
  } else {
    // No se recibió el archivo o hubo un error en la transferencia
    echo json_encode(['error' => 'No se recibió el archivo o hubo un error en la transferencia']);
  }
} else {
  // Método de solicitud incorrecto
  echo json_encode(['error' => 'Método de solicitud incorrecto']);
}
