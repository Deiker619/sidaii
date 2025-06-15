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
                                <td><a class="reasignar-cita" onclick="reasignarFecha('<?php echo $registros['id']; ?>', '<?php echo $registros['nombre']; ?>', '<?php echo $registros['fecha_cita']; ?>')">
                                        Reasignar la cita
                                    </a></td>
                            <?php   } else { ?>
                                <td><a onclick="enviarEmail('<?php echo $registros['email'] ?>')" class="remitir">Enviar notificacion</a></td>
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

       function reasignarFecha(id, nombre, fechaActual) {
    // Extraer solo la fecha (sin hora)
    const fechaActualSolo = fechaActual.split(' ')[0];
    const hoy = new Date().toISOString().slice(0, 10);

    Swal.fire({
        title: `Seleccione en el calendario la fecha de la cita a cambiar para ${nombre}`,
        html: `
            Fecha actual: <b>${fechaActualSolo}</b>
            <div style="margin-top: 1rem;">
                <input type="date" 
                    id="fecha-selector" 
                    value="${fechaActualSolo}" 
                    min="${hoy}"
                    style="padding: 8px; border-radius: 4px; border: 1px solid #ddd; width: 100%">
            </div>
        `,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Confirmar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#009fec',
        preConfirm: () => {
            const selectorFecha = document.getElementById('fecha-selector').value;
            if (!selectorFecha) {
                Swal.showValidationMessage('Debe seleccionar una fecha');
                return false;
            }
            return selectorFecha;
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const nuevaFecha = result.value;
            Swal.fire({
                title: 'Confirmar cambio',
                html: `¿Está seguro de cambiar la fecha a <b>${formatDateForDisplay(nuevaFecha)}</b>?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#009fec',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then((confirmResult) => {
                if (confirmResult.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "07-reasignarFechaAudiometria.php",
                        data: {
                            id: id,
                            nueva_fecha: formatDateForServer(nuevaFecha)
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Fecha actualizada',
                                    text: response.message || 'La fecha ha sido reasignada correctamente',
                                    willClose: () => window.location.reload()
                                });
                            } else {
                                Swal.fire('Error', response.message || 'Error al actualizar la fecha', 'error');
                            }
                        },
                        error: function(xhr) {
                            Swal.fire('Error', 'Ocurrió un error al comunicarse con el servidor', 'error');
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        }
    });
}

        // Funciones auxiliares para formatear fechas
        function formatDateForServer(dateString) {
            return dateString + ' 00:00:00'; // Agrega hora mínima para compatibilidad con servidor
        }

        function formatDateForDisplay(dateString) {
            const options = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            return new Date(dateString).toLocaleDateString('es-ES', options);
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

        function enviarEmail(b) {
            let correo = b
            let email = true;


            /* No tiene correo */
            if (correo) {
                Swal.fire({
                    title: "¿Desea enviar una notificación al correo registrado?",
                    html: "<b>Correo: </b>" + b + "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, enviar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        asignarAtencion();
                        $.ajax({
                            type: "POST",
                            url: "reportes/enviarNotificacionAudiometria.php",
                            data: {

                                correo: correo,

                            },
                            success: function(data) {
                                console.log(data)
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer);
                                        toast.addEventListener('mouseleave', Swal.resumeTimer);



                                    },
                                    willClose: () => {

                                        window.location.href = "07-audiometriaRecibida.php"
                                    }
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Enviado exitosamente',
                                });


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
                    }
                });
            } else {
                const {
                    value: atencion
                } = Swal.fire({
                    title: 'Agrega el correo personalizado',
                    input: 'email',
                    inputLabel: 'Introduce el correo para enviar comprobante',
                    inputValue: correo,
                    footer: "Esta persona no tiene correo registrado",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Debes escribir algo'
                        }

                        if (value) {
                            correo = value;

                            asignarAtencion();
                            $.ajax({
                                type: "POST",
                                url: "reportes/enviarEmail.php",
                                data: {
                                    numero_aten: numero_aten,
                                    correo: correo,

                                },
                                success: function(data) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);



                                        },
                                        willClose: () => {

                                            window.location.href = "07-audiometriaRecibida.php"
                                        }
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Enviado exitosamente',
                                    });

                                    if (!data) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: "No se pudo registrar la solicitud, verifique datos"
                                        }).then(function() {
                                            window.location = "01,2-atenciones.php";
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

                        }
                    }

                })
            }
            /* Si tiene correo */

        }
    </script>

    <?php
    include_once("parteabajo.php");
    ?>