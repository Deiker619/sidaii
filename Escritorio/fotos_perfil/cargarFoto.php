<?php

session_start();
// Configuración de la carpeta de destino
$directorio_subida = "";

// Validación del archivo
if (isset($_FILES["foto_perfil"]) && $_FILES["foto_perfil"]["error"] === 0) {

  // Obtener información del archivo
  $nombre_archivo = $_FILES["foto_perfil"]["name"];
  $tipo_archivo = $_FILES["foto_perfil"]["type"];
  $temporal_archivo = $_FILES["foto_perfil"]["tmp_name"];

  // Validar tipo de archivo
  $tipos_permitidos = ["image/jpeg", "image/png", "image/gif"];
  if (!in_array($tipo_archivo, $tipos_permitidos)) {
    echo "Error: Solo se admiten archivos JPG, PNG o GIF.";
    exit;
  }

  // Generar nombre único para el archivo
  $nombre_unico = uniqid() . "." . pathinfo($nombre_archivo, PATHINFO_EXTENSION);

  // Mover el archivo a la carpeta de destino
  if (move_uploaded_file($temporal_archivo, $directorio_subida . $nombre_unico)) {

    include_once("../../php/03-usuario.php");
    $foto = new Usuario(1);
    $_SESSION["profile_photo"] = $nombre_unico;
    $foto->InsertarFotoPerfil($nombre_unico, $_SESSION["cedula"]);
    session_write_close();

    function redireccionar($url){ 
      ob_start();   // Se utiliza para solucionar el error de  headers already sent 
      $host=$_SERVER['HTTP_HOST'];  //Devuelve la direccion web: Ejemplo: www.cantv.net
      //echo "Host: ".$host."<br>";
      $uri=rtrim(dirname($_SERVER['PHP_SELF']), '/\\'); //Devuelve el Directorio desde donde se esta ejecutando la pagina que invoca la funcion.
      //echo "Uri: ".$uri."<br>";
      header("Location: http://$host$uri/$url"); //Redirecciona a la Pagina Solicitada
      ob_flush();  // Se utiliza para solucionar el error de  headers already sent 
    }
  
    redireccionar("../__MiPerfil.php");	
  
    echo "La foto de perfil se ha subido correctamente.";

  } else {
    echo "Error: No se pudo subir la foto de perfil.";
  }

} 
 
if(isset($_POST["eliminar"])){
  unlink($_POST["eliminar"]);
  require_once("../../php/03-usuario.php");
  $usuario = new Usuario(1);
  $usuario->setcedula($_SESSION["cedula"]);
  $usuario->EliminarFotoPerfil();
  $_SESSION["profile_photo"] = null;
}