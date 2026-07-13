<?php

$conexion = mysqli_connect('localhost', 'fmjgh', 'misionfmjgh', 'conapdis');

$camp_municipio = $_POST['camp_municipio'];

$sql = "SELECT id, nombre_parroquia FROM parroquia WHERE municipio='$camp_municipio'";

$resultado = mysqli_query($conexion, $sql);

$cadena = '<label>Parroquia</label>
<select name="camp_parroquia" id="camp_parroquia" required>
<option value="">Seleccione una parroquia</option>';

while ($ver = mysqli_fetch_row($resultado)) {
    $cadena .= '<option value=' . $ver[0] . '>' . $ver[1] . '</option>';
}

echo $cadena . '</select>';
