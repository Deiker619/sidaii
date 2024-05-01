<?php


$conexions=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

$estado =$_POST["estado"];/*  $_POST["estado"]; */




$sql = "SELECT id_municipios, nombre FROM municipios WHERE estado='$estado'";


$resultado = mysqli_query($conexions, $sql);

$cadena = '<label>Municipio</label>
<select name="municipio" id="municipio" require>';

while($ver=mysqli_fetch_row($resultado)){
    $cadena=$cadena.'<option value='.$ver[0].'>'.$ver[1].'</option>';

}

/* foreach($resultado as $ver){
    $cadena.='<option value='.$ver["id_municipios"].'>'.$ver["nombre"].'</option>';
} */

echo $cadena."</select>";

?>