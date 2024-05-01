<?php
include_once("../../php/10-coordinaciones-estadales.php");
$coordinacion = $_REQUEST["coordinacion"];
$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

$ene = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='01' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));



$feb = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='02' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));


$mar = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='03' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$abr = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='04' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$may = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='05' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$jun = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='06' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$jul = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='07' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$ago = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='08' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$sep = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='09' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$oct = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='10' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$nov = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='11' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$dic = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='12' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));


$mes = array(0 =>$ene[0],
                1 =>$feb[0],
                2 =>$mar[0],
                 3 =>$abr[0],
                4 =>$may[0],
                5 =>$jun[0],
                6 =>$jul[0],
                7 =>$ago[0],
                8 =>$sep[0],
                9 =>$oct[0],
                10 =>$nov[0],
                11 =>$dic[0]);
echo json_encode($mes);
/* 
$abr = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='04' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$may = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='05' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));


$jun = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='06' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$jul = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='07' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$ago = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='08' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$sep = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='09' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$oct = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='10' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$nov = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='11' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));

$dic = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE MONTH(fecha_aten)='12' and coordinaciones_estadales.id = '$coordinacion' and
fecha_aten is NOT null and
atenciones_coordinaciones.por = usuario.cedula AND
usuario.coordinacion = coordinaciones_estadales.id"));
 */