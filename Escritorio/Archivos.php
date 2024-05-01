<?php
include_once("partearriba.php");
?>

<!-- Incluye los archivos CSS y Javascript de DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>


    <?php
    // Define la ruta a la carpeta donde se guardan los archivos cargados
    
    switch ($gerencia) {
        case '4Gtno':
            $upload_dir ="uploader/OP";
          break;
        case '2Atc':
            $upload_dir = "uploader/OAC";
          break;
      
        default:
          $upload_dir = "uploader";
          break;
      }
    // Lee los archivos en la carpeta
    $files = scandir($upload_dir);

    // Muestra cada archivo en una tabla
    echo "<table id='example' >";
    echo "<thead><tr><th>Nombre del archivo</th><th>Eliminar</th></tr></thead>";
    echo "<tbody>";
    foreach ($files as $file) {
        // Excluye el archivo uploader.php de la lista
        if ($file != "." && $file != ".." && $file != "uploader.php") {
            echo "<tr><td><a href='$upload_dir/$file'>$file</a></td><td><button class='delete-btn' data-file='$file'>Eliminar</button></td></tr>";
        }
    }
    echo "</tbody>";
    echo "</table>";
    ?>

</div>


<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable();

        // Agrega un evento de clic al botón de eliminar
        $('#example').on('click', '.delete-btn', function() {
            var file = $(this).data('file');



            // Elimina el archivo del servidor
            $.ajax({
                url: 'delete_file.php',
                type: 'POST',
                data: {
                    file: file
                },
                success: function(response) {

                    if (response == 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: "Archivo eliminado"

                        }).then(function() {
                                location.reload();
                            })
                        // Recarga la página
                        

                    } else {
                        alert('Error al eliminar el archivo');
                    }
                }
            });
        });
    });
</script>

<?php
include_once("parteabajo.php");
?>