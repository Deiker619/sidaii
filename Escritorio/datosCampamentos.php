<?php
/**
 * Endpoint AJAX para el dropdown de campamentos transitorios.
 *
 * Recibe el id_parroquia vía POST y devuelve un <select> HTML
 * con los campamentos disponibles para esa parroquia.
 * Sigue el mismo patrón que datos.php y datosParroquias.php.
 */

$conexion = mysqli_connect('localhost', 'fmjgh', 'misionfmjgh', 'conapdis');

$idParroquia = $_POST['parroquia'];

$sql = "SELECT id_campamento, nombre_campamento
        FROM campamentos_transitorios
        WHERE id_parroquia = '$idParroquia'
        ORDER BY nombre_campamento";

$resultado = mysqli_query($conexion, $sql);

$cadena = '<label>Campamento transitorio</label>
<select name="id_campamento" id="id_campamento" required>
<option value="">Seleccione un campamento</option>';

while ($fila = mysqli_fetch_assoc($resultado)) {
    $cadena .= '<option value="' . $fila['id_campamento'] . '">'
             . $fila['nombre_campamento'] . '</option>';
}

echo $cadena . '</select>';
