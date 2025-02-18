<?php
include_once("partearriba.php");
include_once("../php/12-informes_medicos.php") // Incluye la clase informes_medicos
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="stylesprotesis.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Evalucaciones medicas: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                <form id="form_agregar">
                    <div class="messageBox">
                        <input required="" placeholder="Ingrese la cedula para agregar" type="text" id="messageInput" />
                        <button id="sendButton" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                                <path
                                    fill="none"
                                    d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                                <path
                                    stroke-linejoin="round"
                                    stroke-linecap="round"
                                    stroke-width="33.67"
                                    stroke="#6c6c6c"
                                    d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                            </svg>
                        </button>
                    </div>
                </form>
                <div style="display: flex; justify-content: center; align-items: center;"></div>
            </div>
        </div>
        <h2>Informes medicos</h2>
        <table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Cedula</th>
            <th>Nombre</th>
            <th>PDF</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $informes = new informes_medicos(1); // Crea una instancia de la clase
        $registros = $informes->consultarInformes(); // Obtiene los registros
        foreach ($registros as $registro) {
            echo "<tr>
                <td>{$registro['id']}</td>
                <td>{$registro['cedula']}</td>
                <td>{$registro['nombre']}</td>
                <td>";
                if (!empty($registro['pdf_path'])) {
                    echo "<a href='{$registro['pdf_path']}' target='_blank'><i class='bx bxs-file-pdf' style='color: red; font-size: 24px;'></i></a>";
                } else {
                    echo "<a href='subir_pdf.php?cedula={$registro['cedula']}' style='cursor: pointer;'>
                            <i class='bx bx-folder' style='color: green; font-size: 24px;'></i>
                          </a>";
                }
            echo "</td>
                <td><a onclick='eliminar({$registro['id']})' class='eliminar'>Eliminar Reg</a></td>
            </tr>";
        }
        ?>
    </tbody>
</table>
    </div>
    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        function eliminar(p1) {
            var id = p1;
            Swal.fire({
                title: `¿Desea eliminar esta registro?`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#1AA83E',
                denyButtonText: `No eliminar`,
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../php2/__eliminar_informe.php",
                        data: {
                            eliminar: eliminar,
                            id: id
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

        function add_servicio() {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                },
                willClose: () => {
                    location.reload();
                }
            });
            let cedula = $('#messageInput').val();
            var cedulauser = <?php echo json_encode($cedulauser); ?>;

            console.log(cedula);

            $.ajax({
                type: "POST",
                url: "../php2/__agregar_servicio_infraestructura.php",
                data: {
                    servicio: 'informe_medico',
                    cedula: cedula,
                    cedulauser: cedulauser
                },
                success: function(data) {
                    console.log(data);
                    if (data.code == 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No se encontro ningun beneficiario con esa cedula',
                            footer: '<a href="01-atencionCiuInfraestructura.php">Ir a registrar</a>'
                        });
                    }

                    if (data.code == 200) {
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        $('#form_agregar').on('submit', function(event) {
            event.preventDefault();
            add_servicio();
        });
    </script>
    <?php
    include_once("parteabajo.php");
    ?>