<?php
require_once("../php/modulos.php");


$id_curso = $_POST["id_curso"];
$profesor = $_POST["profesor"];
$fecha= $_POST["fecha"];
$hora= $_POST["hora"];
$contenido= $_POST["contenido"];
$nombre_modulo= $_POST["nombre_modulo"];

$solicitud = new modulo(1);
$solicitud -> setid_curso($id_curso);
$solicitud -> setprofesor($profesor);
$solicitud -> setfecha($fecha);
$solicitud -> sethora($hora);
$solicitud -> setcontenido($contenido);
$solicitud -> setnombre_modulo($nombre_modulo);
$solicitud -> insertarmodulo();

?>