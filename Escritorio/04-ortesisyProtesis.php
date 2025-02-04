<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y protesis: <?php echo $rol ?></span>
        </div>
    </div>
    <div class="tabla-atencion">
        <h2>Citas dadas para ortesis y protesis</h2>
        <div class="Informe medico">
            <button class="pdf" id="selectPdfButton" style="background:white;box-shadow: none; border:none;">
                <div class="sign">
                    <h3 style="color:rgb(77, 77, 77)">Inserte el informe medico</h3>
                    <i class='bx bx-file' style="color: #fa1030;"></i>
                </div>
                <input type="file" accept="application/pdf" style="display: none;" id="pdfInput">
            </button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Codigo de cita</th>
                    <th>Status</th>
                    <th>Fecha de cita</th>
                    <th></th>
                    <th></th>
                    <th>Informe medico</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-02-cita_protesis.php");
                $aten = new citas_protesis(1);
                $consulta = $aten->consultarTodasCitasDadas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["id"] ?></td>
                            <td style="color: green;">Cita dada</td>
                            <td><?php echo $registros["fecha_cita"] ?></td>
                            <td><a class="cargar" href="15-verHistoriaMedica.php?codigo_cita=<?php echo  $registros["id"] ?>">Ver historia M.</a></td>
                            <td><a href="" class="eliminar">Eliminar Reg</a></td>
                            <td>
                                <?php
                                $pdfPath = 'informesMedicos/informe_' . $registros["cedula"] . '.pdf';
                                $pdfPathWithNumber = 'informesMedicos/informe_' . $registros["cedula"] . '_*.pdf'; // Esto debería coincidir con el patrón que estás viendo

                                // Verificamos si el archivo existe con el nombre normal
                                if (file_exists($pdfPath)) {
                                    echo '<a href="' . $pdfPath . '" target="_blank"><i class="bx bx-file" style="color: #fa1030;"></i></a>';
                                }
                                // Verificamos si el archivo existe con el número extra
                                elseif (glob($pdfPathWithNumber)) {
                                    echo '<a href="' . glob($pdfPathWithNumber)[0] . '" target="_blank"><i class="bx bx-file" style="color: #fa1030;"></i></a>';
                                } else {
                                    echo 'No disponible';
                                }
                                ?>

                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.getElementById('selectPdfButton').addEventListener('click', function() {
            Swal.fire({
                title: 'Ingrese la cedula',
                input: 'text',
                inputLabel: 'Cedula',
                inputPlaceholder: 'Introduzca la cedula',
                showCancelButton: true,
                confirmButtonText: 'Buscar',
                cancelButtonText: 'Cancelar',
                preConfirm: (cedula) => {
                    if (cedula) {
                        return cedula;
                    } else {
                        Swal.showValidationMessage('Por favor ingrese la cedula')
                    }
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    var cedula = result.value;
                    verificarCedulaYSubirPdf(cedula);
                }
            });
        });

        function verificarCedulaYSubirPdf(cedula) {
            // Verificar si la cédula está en la base de datos
            fetch('../php/pdfInforme.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'cedula=' + cedula
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Si la cédula está verificada, proceder a cargar el PDF
                        cargarPdf(cedula);
                    } else {
                        Swal.fire('Error', data.message, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Hubo un problema con la conexión', 'error');
                });
        }

        function cargarPdf(cedula) {
            var inputFile = document.getElementById('pdfInput');
            inputFile.click();
            inputFile.onchange = function(event) {
                var file = event.target.files[0];
                if (file) {
                    var formData = new FormData();
                    formData.append('pdf', file);
                    formData.append('cedula', cedula);

                    fetch('../php/pdfInforme.php', {
                            method: 'POST',
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Éxito', 'PDF cargado exitosamente', 'success');
                            } else {
                                Swal.fire('Error', 'Hubo un problema al cargar el PDF', 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Hubo un problema con la conexión', 'error');
                        });
                }
            };
        }
    </script>

    <?php
    include_once("parteabajo.php");
    ?>