<?php
$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");
$coordinacion = $_REQUEST["coordinacion"];

$año = date("Y");

$años = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE year(fecha_aten)=$año and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$year = array(0 =>$años[0],
                        );
echo json_encode($year);

?>