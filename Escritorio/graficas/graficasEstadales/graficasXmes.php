<?php
$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");
$ene = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='01'"));
$feb = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='02';"));
$mar = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='03'"));
$abr = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='04'"));
$may = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='05'"));
$jun = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='06'"));
$jul = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='07'"));
$ago = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='08'"));
$sep = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='09'"));
$oct = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='10'"));
$nov = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='11'"));
$dic = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones_coordinaciones` WHERE  MONTH(fecha_aten)='12'"));


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

?>