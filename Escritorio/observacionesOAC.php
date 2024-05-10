<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Observaciones: <?php echo $rol ?></span>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.js"></script>
    <?php
    $id = $_REQUEST["id"];
    echo $id; 

    // Conecta con tu base de datos
    $conn = new mysqli('localhost', 'fmjgh', 'misionfmjgh', 'conapdis');

    // Verifica la conexión
    if ($conn->connect_error) {
        die("La conexión ha fallado: " . $conn->connect_error);
    }

    // Selecciona los datos de la tabla 'observacion'
    $sql = "SELECT id, observacion, id_atencion FROM observacion";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Muestra los datos de cada fila
        echo "<table id='miTabla' border='1'>";
        echo "<thead><tr><th>ID</th><th>Observación</th><th>ID Atención</th></tr></thead>";
        echo "<tbody>";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"]. "</td><td>" . $row["observacion"]. "</td><td>" . $row["id_atencion"]. "</td></tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "0 resultados";
    }

    // Cierra la conexión
    $conn->close();
    ?>
</div>

<script>
$(document).ready( function () {
    $('#miTabla').DataTable();
} );
</script>

<?php
include_once("parteabajo.php");
?>
