<?php
include_once("partearriba.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Reparacion de artificios: <?php echo $rol ?></span>
        </div>
    </div>
    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->
        <h2>Audiometrias dadas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID cita</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Discapacidad</th>
                    <th>Fecha de la cita</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-06-audiometria.php");
                $aten = new audiometria(1);
                $consulta = $aten->consultarTodasCitasDadas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                        <td><a class="cedula" id="verBeneficiario" <?php if ($registros['status'] != 'Reparacion completada') { ?> href="07-audiometriaModificar.php?id=<?php echo $registros['id']; ?>" <?php } ?>><?php echo $registros["id"] ?></a></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["discapacidad"] ?></td>
                            <td><?php echo $registros["fecha_cita"] ?></td>
                            <td style="color: green"><?php echo $registros["status"] ?></td>

                            <?php if ($registros['status'] != 'Audiometria completada') { ?>

                                <td><a onclick="cargar('<?php echo addslashes($registros['descripcion']); ?>', '<?php echo $registros['id']; ?>', '<?php echo $registros['nombre']; ?>')">Cita atendida</a></td>
                            <?php   } else { ?>
                                <td><a class="remitir">Enviar notificacion</a></td>
                            <?php } ?>
                            <td><a onclick="eliminar('<?php echo ($registros['id']); ?>')" class="eliminar">Eliminar Reg</a></td>


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
        function cargar(p1, p2, p3) {
            var id = p2;
            Swal.fire({
                title: `¿Ya fue atendida la audiometria de: ${p3}?`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Si, fue atendida',
                confirmButtonColor: '#1AA83E',
                html: `${p1}`,
                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    let statusModified = 'Audiometria completada'

                    $.ajax({
                        type: "POST",
                        url: "07-asignadaAudiometria.php",
                        data: {
                            statusModified: statusModified,
                            id: id
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: data.message
                            }).then(function() {


                                window.location.reload()
                            })

                            if (!data.message) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo completar la solicitud"
                                }).then(function() {
                                    window.location.reload()
                                })
                            }
                        },
                        error: function(data) {
                            console.log(data)
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Oops...',
                                'text': data
                            })
                        }
                    })




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }
        function eliminar(p1) {
            var id = p1;
            Swal.fire({
                title: `¿Desea eliminar esta reparacion`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#1AA83E',
                html: `Codigo de cita: ${p1}`,
                denyButtonText: `No eliminar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                let eliminar = 'eliminar'
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "07-audiometriaEliminar.php",
                        data: {
                            eliminar: eliminar,
                            id: id
                        },
                        success: function(data) {
                            console.log(data)
                            Swal.fire({
                                icon: 'success',
                                title: data.message
                            }).then(function() {


                                window.location.reload()
                            })

                            if (!data.message) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo completar la solicitud"
                                }).then(function() {
                                    window.location.reload()
                                })
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Oops...',
                                'text': data
                            })
                        }
                    })




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }
    </script>

    <?php
    include_once("parteabajo.php");
    ?>