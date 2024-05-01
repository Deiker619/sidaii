<?php
$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");
$silla = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1-silla.r';"));
$muletas = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '2-muletas';"));
$baston = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '3-baston';"));
$baston4 = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '4-baston.p';"));


$aparato = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '5-ap.audio';"));
$andadera = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '6-andadera';"));
$cama = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '7-CamaCli';"));
$colchon = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '8-Col-Anti';"));
$felula = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '9-felula';"));
$lentes = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '10-lentes';"));


$Pañales = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '11-pañales';"));
$ProtesisA = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '12-Pro-aud';"));
$ProtesisC = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '13-Pro-cad';"));
$ProtesisR = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '14-Pro-rod';"));
$ProtesisD = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '15-Pro-den';"));
/* Hasta aqui funciona */


$E16 = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.1-S.E16';"));
$E18 = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.1-S.E18';"));
$E14 = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.2-S.E14';"));
$SRA = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.4-S.R.A.';"));
$SRPE = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.5-SRPE';"));
$SRB = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.6-SRB';"));
$COP = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `ayudas_tec` WHERE `tipo_ayuda_tec` = '1.7-COP';"));




$ayudas=array(0 =>$silla[0],
1 =>$muletas[0],
2 =>$baston[0],
3 =>$baston4[0],
4 =>$aparato[0],
5 =>$andadera[0],
6 =>$cama[0],
7 =>$colchon[0],
8 =>$felula[0],
9 =>$lentes[0],

10 =>$Pañales[0],
11 =>$ProtesisA[0],
12 =>$ProtesisC[0],
13 =>$ProtesisR[0],
14 =>$ProtesisD[0],
15 =>$E16[0],
16 => $E18[0],
17 => $E14[0],
18 => $SRA[0],
19 => $SRPE[0],
20 => $SRB[0],
21 => $COP[0]);
echo json_encode($ayudas);

?>