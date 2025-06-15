
<?php
// Procesar la subida del archivo ANTES de cualquier salida
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf'])) {
    $cedula = $_GET['cedula'];
    $carpeta_usuario = "pdfs/{$cedula}";
    if (!file_exists($carpeta_usuario)) {
        mkdir($carpeta_usuario, 0777, true);
    }
    $archivo_nombre = basename($_FILES['pdf']['name']);
    $archivo_temporal = $_FILES['pdf']['tmp_name'];
    $ruta_archivo = "{$carpeta_usuario}/{$archivo_nombre}";

    if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
        // Redirigir para evitar reenvío del formulario y mostrar alerta solo una vez
        header("Location: subir_pdf.php?cedula={$cedula}&subido=1");
        exit;
    } else {
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al subir el archivo.'
                });
            });
        </script>";
    }
}

include_once("partearriba.php");
include_once("../php/12-informes_medicos.php"); // Incluye la clase informes_medicos
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="stylesprotesis.css">
<link rel="stylesheet" href="File.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<?php
// Mostrar SweetAlert2 solo si se subió correctamente
if (isset($_GET['subido']) && $_GET['subido'] == 1) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Archivo subido correctamente'
            }).then(function() {
                // Quitar el parámetro 'subido' de la URL sin recargar la página
                if (window.history.replaceState) {
                    const url = new URL(window.location);
                    url.searchParams.delete('subido');
                    window.history.replaceState({}, document.title, url);
                }
            });
        });
    </script>";
}
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Subir PDF para la cédula: <?php echo $_GET['cedula']; ?></span>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div style="display: flex; align-items: center; justify-content: center; gap: 5px;padding: 3px">
                <div style="display: flex; justify-content: center; align-items: center;"></div>
            </div>
        </div>
        <h2>Archivos PDF</h2>
        <table id="tabla-pdf">
            <thead>
                <tr>
                    <th>Nombre del archivo</th>
                    <th style="text-align: center;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Obtener la cédula del usuario desde la URL
                $cedula = $_GET['cedula'];
                $carpeta_usuario = "pdfs/{$cedula}";

                // Crear la carpeta si no existe
                if (!file_exists($carpeta_usuario)) {
                    mkdir($carpeta_usuario, 0777, true);
                }

                // Listar los archivos PDF en la carpeta del usuario
                $archivos = glob("{$carpeta_usuario}/*.pdf");
                if (count($archivos) > 0) {
                    foreach ($archivos as $archivo) {
                        $nombre_archivo = basename($archivo);
                        echo "<tr>
                            <td>{$nombre_archivo}</td>
                            <td style='text-align: center;'>
                            <a href ='{$archivo}' target='_blank' style='display: inline-block; 
                            width: 100px;'>
                            <i class ='bx bxs-file-pdf' style='color: red; font-size:20px;'></i>
                            </a>
                            <a onclick='eliminarArchivo(\"{$archivo}\")' class= 'eliminar' style = 'display: inline-block; width:80px; margin-left:10px;'>
                            Eliminar
                            </a>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No hay archivos subidos.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Subir nuevo PDF</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="pdf" id="pdf" accept="application/pdf" required>
            <button type="submit">Subir PDF</button>
        </form>
    </div>
</div>

<script>
    // Función para eliminar un archivo
    function eliminarArchivo(rutaArchivo) {
        Swal.fire({
            title: `¿Desea eliminar este archivo?`,
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            confirmButtonColor: '#1AA83E',
            denyButtonText: `No eliminar`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "../php2/__eliminar_archivo.php",
                    data: {
                        ruta: rutaArchivo
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.message === 'Archivo eliminado correctamente') {
                            Swal.fire({
                                icon: 'success',
                                title: data.message
                            }).then(function() {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: data.message || "No se pudo completar la solicitud"
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Error al eliminar el archivo'
                        });
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('No se eliminó el archivo', '', 'info');
            }
        });
    }

    // Inicializar DataTables
    $(document).ready(function() {
        $('#tabla-pdf').DataTable();
    });
</script>

<?php
include_once("parteabajo.php");
?>