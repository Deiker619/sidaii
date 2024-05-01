<?php
$conexions=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

/* GRAFICAS POR ESTADO===================================================================================================================== */
$DttC = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '24';"));
$Amaz = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '1'"));
$Anz = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '2'"));
$Apu = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '3'"));
$Ara = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '4'"));
$Bari = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '5'"));
$Boli = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '6'"));
$Carbb = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '7'"));
$Coje = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '8'"));
$Delt = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '9'"));
$Fal = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '10'"));
$Gua = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '11'"));
$Lar= mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '12'"));
$Miran= mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '14'"));
$Mona = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '15'"));
$NvaEs = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '16'"));
$Portu = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '17'"));
$Sucr = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '18'"));
$Tach = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '19'"));
$Truj = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '20'"));
$Varg = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '21'"));
$Yara = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '22'"));
$Zul = mysqli_fetch_array(mysqli_query($conexions, "SELECT COUNT(*) FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten !='' and beneficiario.estado = '23'"));


$data = array(0 =>$DttC[0],
                1 =>$Amaz[0],
                2 =>$Anz[0],
                3 =>$Apu[0],
                4 =>$Ara[0],
                5 =>$Bari[0],
                6 =>$Boli[0],
                7 =>$Carbb[0],
                8 =>$Coje[0],
                9 =>$Delt[0],
                10 =>$Fal[0],
                11 =>$Gua[0],
                12 =>$Lar[0],
                13 =>$Miran[0],
                14 =>$Mona[0],
                15 =>$NvaEs[0],
                16 =>$Portu[0],
                17 =>$Sucr[0],
                18 =>$Tach[0],
                19 =>$Truj[0],
                20 =>$Varg[0],
                21 =>$Yara[0],
                22 =>$Zul[0]);
echo json_encode($data);

/* END: GRAFICAS POR ESTADOO============================================================================================================ */

/* END: GRAFICAS POR MES============================================================================================================ */


?>