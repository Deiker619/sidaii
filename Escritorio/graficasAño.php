<?php
$conexionss=mysqli_connect("localhost","fmjgh","misionfmjgh","conapdis");

$año = date("Y");

$años = mysqli_fetch_array(mysqli_query($conexionss, "SELECT COUNT(*) FROM `atenciones` WHERE  YEAR(fecha_aten)=$año"));

$year = array(0 =>$años[0],
                        );
echo json_encode($year);

?>