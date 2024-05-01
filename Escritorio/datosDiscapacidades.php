<?php


$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

$discapacidad=$_POST["general"];/*  $_POST["estado"]; */




$sqls = "SELECT id_e,nombre_e FROM `discapacid_e` WHERE `general` = '$discapacidad'";


$resultado = mysqli_query($conexionss, $sqls);

$cadena = '<label>Discapacidad Especifica</label>
<select name="D-especifica" id="D-especifica" require>';

while($ver=mysqli_fetch_row($resultado)){
    $cadena=$cadena.'<option value='.$ver[0].'>'.$ver[1].'</option>';

}



echo $cadena."</select>";

?>