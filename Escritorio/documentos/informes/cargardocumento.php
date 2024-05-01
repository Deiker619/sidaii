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
      
      if ($_SESSION["gerencia"] == "2Atc") {
        require_once("../../../php/01-atenciones.php");
        $aten = new Atenciones(1);
        $aten->setnumero_aten($numero_aten);
        $aten->subirInforme($nombre_unico);
        echo json_encode(['mensaje' => 'Archivo subido con éxito ', 
                           'Gerencia' => $_SESSION["gerencia"]]);
      }
      
      if ($_SESSION["gerencia"] == "4Gtno") {
        require_once("../../../php/01-atenciones-estadales.php");
        $aten = new AtencionesEstadales(1);
        $aten->setnumero_aten($numero_aten);
        $aten->subirInforme($nombre_unico);
  
          echo json_encode(['mensaje' => 'Archivo subido con éxito ', 
                           'Gerencia' => $_SESSION["gerencia"]]);
   
       
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
