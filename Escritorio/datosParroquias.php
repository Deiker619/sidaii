<?php


$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

$municipio=$_POST["municipio"];/*  $_POST["estado"]; */




$sqls = "SELECT id, nombre_parroquia FROM parroquia WHERE municipio='$municipio'";


$resultado = mysqli_query($conexionss, $sqls);

$cadena = '<label>Parroquia</label>
<select name="parroquia" id="parroquia" require>';

while($ver=mysqli_fetch_row($resultado)){
    $cadena=$cadena.'<option value='.$ver[0].'>'.$ver[1].'</option>';

}



echo $cadena."</select>";

?>