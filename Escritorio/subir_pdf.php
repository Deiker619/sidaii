<?php
include_once("partearriba.php");
include_once("../php/12-informes_medicos.php"); // Incluye la clase informes_medicos
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="stylesprotesis.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Subir PDF para la cédula: <?php echo $_GET['cedula']; ?></span>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
               
                <div style="display: flex; justify-content: center; align-items: center;"></div>
            </div>
        </div>
        <h2>Archivos PDF</h2>
        <table id="tabla-pdf">
            <thead>
                <tr>
                    <th>Nombre del archivo</th>
                    <th>Acciones</th>
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

                // Procesar la subida del archivo
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['pdf'])) {
                    $archivo_nombre = basename($_FILES['pdf']['name']);
                    $archivo_temporal = $_FILES['pdf']['tmp_name'];
                    $ruta_archivo = "{$carpeta_usuario}/{$archivo_nombre}";

                    if (move_uploaded_file($archivo_temporal, $ruta_archivo)) {
                        echo "<script>alert('Archivo subido correctamente.');</script>";
                    } else {
                        echo "<script>alert('Error al subir el archivo.');</script>";
                    }
                }

                // Listar los archivos PDF en la carpeta del usuario
                $archivos = glob("{$carpeta_usuario}/*.pdf");
                if (count($archivos) > 0) {
                    foreach ($archivos as $archivo) {
                        $nombre_archivo = basename($archivo);
                        echo "<tr>
                            <td>{$nombre_archivo}</td>
                            <td>
                                <a href='{$archivo}' target='_blank'><i class='bx bxs-file-pdf' style='color: red; font-size: 24px;'></i></a>
                                <a onclick='eliminarArchivo(\"{$archivo}\")' class='eliminar'>Eliminar</a>
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

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
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
                    success: function(data) {
                        console.log(data);
                        Swal.fire({
                            icon: 'success',
                            title: data.message
                        }).then(function() {
                            window.location.reload();
                        });

                        if (!data.message) {
                            Swal.fire({
                                icon: 'error',
                                title: "No se pudo completar la solicitud"
                            }).then(function() {
                                window.location.reload();
                            });
                        }
                    },
                    error: function(data) {
                        Swal.fire({
                            'icon': 'error',
                            'title': 'Oops...',
                            'text': data
                        });
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info');
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