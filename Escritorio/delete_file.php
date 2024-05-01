<?php
if (isset($_POST['file'])) {
    $file = $_POST['file'];
    session_start();
    $gerencia = $_SESSION["gerencia"];
    switch ($gerencia) {
        case '4Gtno':
            $upload_dir ="uploader/OP";
          break;
        case '2Atc':
            $upload_dir = "uploader/OAC";
          break;
      
        default:
          $upload_dir = "uploader";
          break;
      }
    
    // Define la ruta a la carpeta donde se guardan los archivos cargados
    
    // Elimina el archivo del servidor
    if (unlink("$upload_dir/$file")) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>