<?php
include_once("partearriba.php");
?>

<?php
try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=localhost;dbname=conapdis", "fmjgh", "misionfmjgh");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los registros de la tabla "porcentajes"
    $query = "SELECT * FROM porcentajes ORDER BY fecha DESC";
    $stmt = $pdo->query($query);

    // Mostrar todos los registros
    echo "<div class='tabla-containerr'>";
    echo "<table>";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "
        <tr>
        <thead>
        <tr>
                    <th>Mes</th>
                    <th>Porcentajes</th>
                    </tr>
                    </thead>

                    <tbody>

            <td>
                <div class='porcentajeMes_div'>
                    <div class='porcentajeMes'>Fecha: {$row['fecha']}
                    </div>
                </div>
            </td>
            <td>
            <div class='porcentajeMes_div'>
                    <div class='porcentajeMes'> Porcentaje: {$row['porcentaje']}%
            </div>
            </td>
        </tr>";
    }

    echo " </tbody> </table>";
    echo "</div>";
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
<br><br><br>
<?php
include_once("parteabajo.php")
?>