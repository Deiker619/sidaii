<?php

session_start();
$name = $_FILES["file"]["name"];
$file = $_FILES["file"]["tmp_name"];
$error = $_FILES["file"]["error"];
$gerencia = $_SESSION["gerencia"];

switch ($gerencia) {
  case '4Gtno':
    $destination = "../uploader/OP/$name";
    break;
  case '2Atc':
    $destination = "../uploader/OAC/$name";
    break;

  default:
    $destination = "../uploader/$name";
    break;
}
$upload = move_uploaded_file($file, $destination);

if ($upload) {
  $res = array(
    "err" => false,
    "status" => http_response_code(200),
    "statusText" => "Archivo $name subido con éxito",
    "files" => $_FILES["file"]
  );
} else {
  $res = array(
    "err" => true,
    "status" => http_response_code(400),
    "statusText" => "Error al subir el archivo $name",
    "files" => $_FILES["file"]
  );
}

echo json_encode($res);
