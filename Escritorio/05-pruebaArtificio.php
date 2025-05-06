<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Pruebas en marcha: <?php echo $rol ?></span>
        </div>
    </div>



    <div class="reportes-totales">

        <!-- reportes 1 -->
        <div class="reporte">
            <a href="04-ortesisyProtesis.php">Sección principal</a>
        </div>
        <div class="reporte">
            <a href="04-tomaMedidas.php">Toma de medidas y evaluación</a>
        </div>
        <!-- <div class="reporte">
            <a href=""></a>
        </div>
        <div class="reporte">
            <a href=""></a>
        </div> -->
        <!-- reportes 1 -->

        <!-- reportes 1 -->
    </div>



    <div class="tabla-atencion">
        <div class="personas-conatencion"><a class="enlace" href="05-pruebaDada.php">Pruebas hechas</a></div>
        <h2>Pruebas por hacer</h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Artificio de prueba</th>
                    <th>Fecha de la prueba</th>
                    <th>Medidas</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-02-cita_protesis.php");
                $aten = new citas_protesis(1);
                $consulta = $aten->consultarTodasCitasSindar_prueba();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["id"] ?></td>
                            <td> <a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>

                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["artificio"] ?></td>
                            <td><?php echo $registros["fecha_prueba"] ?></td>
                            <td><a onclick="verDescripcion('<?php echo $registros['descripcion'] ?>','<?php echo $registros['medidas'] ?>')" class="remitir">Ver medidas</a></td>

                            <td><a onclick="finalizarPrueba('<?php echo $registros['id'] ?>')">Finalizar proceso</a></td>
                            <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>

                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        function verDescripcion(p1, p2) {
            Swal.fire({
                title: 'Descripción del requerimiento:',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1AA83E',
                html: `<details>
                        <summary>Requerimiento principal</summary>
                        <p>${p1}</p>
                    </details>
                    
                    <details>
                        <summary>Medidas</summary>
                        <p>${p2}</p>
                    </details>
                    `,
            })
        }

        function finalizarPrueba(p1) {
            var id = p1
            Swal.fire({
                title: '¿Desea finalizar proceso?:',
                confirmButtonText: 'Si, ya se ha probó el artificio',
                showCancelButton: true,
                cancelButtonColor: "#d33",
                confirmButtonColor: '#1AA83E',
            }).then((result) => {
                if (result.isConfirmed) {
                   
                    // Enviar los datos por AJAX
                    $.ajax({
                        type: "POST",
                        url: "../php/procesamientoFinalizarPrueba.php",
                        data: {
                            id: id,
                          
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Operación exitosa'
                            }).then(function() {
                                location.reload();
                            });

                            if (!data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo registrar la solicitud, verifique datos"
                                }).then(function() {
                                    location.reload();
                                });
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data
                            });
                        }
                    });
                }
            });
        }
    </script>

    <?php
    include_once("parteabajo.php");
    ?>