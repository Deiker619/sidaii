<?php

$conexion = mysqli_connect('localhost', 'fmjgh', 'misionfmjgh', 'conapdis');

$camp_estado = $_POST['camp_estado'];

$sql = "SELECT id_municipios, nombre FROM municipios WHERE estado='$camp_estado'";

$resultado = mysqli_query($conexion, $sql);

$cadena = '<label>Municipio</label>
<select name="camp_municipio" id="camp_municipio" required>
<option value="">Seleccione un municipio</option>';

while ($ver = mysqli_fetch_row($resultado)) {
    $cadena .= '<option value=' . $ver[0] . '>' . $ver[1] . '</option>';
}

echo $cadena . '</select>';
