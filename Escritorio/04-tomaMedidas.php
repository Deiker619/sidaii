<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Toma de medidas: <?php echo $rol ?></span>
        </div>
    </div>

    <!--  <div class="boxes">

            <?php
            include_once("../php/01-discapacitados.php");
            $dis = new Discapacitados(1);

            $consulta = $dis->consultarTodosDiscapacitados();

            include_once("../php/01-atenciones.php");
            $aten = new Atenciones(1);

            $atenciones =  $aten->contarTodasAtencionesa();

            ?>
            <div class="box box1">
                <i class='bx bx-first-aid'></i>
                <span class="link-name">Citas</span>
                <span class="number"><?php /* echo  */ count($atenciones) ?></span>
            </div>

            <div class="box box2">
                <i class='bx bxs-user-badge'></i>
                <span class="link-name">Carnetizaciones </span>
                <span class="number">50,120</span>
            </div>

            <div class="box box3">
                <i class='bx bx-group'></i>
                <span class="link-name">Beneficiarios </span>
                <span class="number"><?php /* echo */ count($consulta); ?></span>
            </div>
        </div>
 -->
    <div class="reportes-totales">

        <!-- reportes 1 -->
        <div class="reporte">
            <a href="04-ortesisyProtesis.php">Citas</a>
        </div>
        <div class="reporte">
            <a href="05-pruebaArtificio.php">Prueba de artificio</a>
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
        <div class="personas-conatencion"><a class="enlace" href="04-tomasAsignadas.php">Toma de medidas dadas</a></div>
        <h2>Toma de medidas por hacer</h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Artificio</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>

                    <th>Enviar a prueba
                    </th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php
                /*  include_once("../php/01-03-toma_medidas.php");
                $aten = new toma_medidas(1);
                $consulta = $aten->consultarTodasMedidasSindar(); */
                include_once("../php/01-02-cita_protesis.php");
                $aten = new citas_protesis(1);
                $consulta = $aten->consultarTodasCitasSindar_toma_medidas();
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
                            <!-- <td><a class="cargar" href="15-verHistoriaMedica.php?codigo_cita=<?php echo  $registros["codigo_cita"] ?>">Ver historia M.</a></td> -->
                            <td><a onclick="verDescripcion('<?php echo $registros['descripcion'] ?>')">Ver descripcion</a></td>
                            <td><?php echo $registros["fecha_toma"] ?? '00/00/0000' ?></td>
                            <?php if ($registros["status"]) { ?>
                                <?php if ($registros["status"] == 'Medidas tomadas') { ?>
                                    <td style="color: green;">Medidas tomadas </td>
                                <?php }
                            } else { ?>
                                <td style="color: red;">Sin tomar medidas</td>
                            <?php } ?>
                            <td><?php if ($registros["medidas"]) { ?>
                                    <a onclick="verDescripcionM('<?php echo $registros['medidas'] ?>')" class="remitir">Ver medidas</a>

                                <?php } else { ?>

                                    <a class="prueba" onclick='cargar(<?php echo $registros["id"] ?>)'>Tomar medidas</a>
                                <?php } ?>

                            <td><?php if ($registros["apto"]) { ?>
                                    <p class="remitir"> <?php echo $registros['apto'] ?> es apto</p>
                                <?php } else { ?>

                                    <a class="cargar" onclick='evaluar(<?php echo $registros["id"] ?>)'>Evaluación</a>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($registros["apto"] && $registros["medidas"]) { ?>
                                    <div class="enviar_text"> <i class='bx bx-right-arrow-circle' onclick="enviarPrueba('<?php echo $registros['id'] ?>','<?php echo $registros['email'] ?? null ?>')" style="color:#3ab556; cursor:pointer"></i></div>

                                <?php } else { ?>
                                    <div class="enviar_text"> <i class='bx bx-no-entry' style="color:crimson; cursor:not-allowed "></i></div>
                                <?php } ?>
                            </td>
                            <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar</a></td>

                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <?php
    include_once("parteabajo.php");
    ?>
    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        function cargar(p1) {
            var id = p1;
            Swal.fire({
                title: '¿Ya este beneficiario se le hicieron las toma de medidas? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Cargar',
                confirmButtonColor: '#1AA83E',
                html: '<select name="recibido" id="recibido" require style="width:100%">' +
                    '<option value="Si">Si</option>' +
                    '<option value="No">No</option>' +

                    '</select>',
                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    recibido = $('#recibido option:selected').text();
                    console.log(recibido)
                    if (recibido == "Si") {

                        Swal.fire({
                            title: 'Ingrese las medidas ',
                            html: `
                                    <input type="text" id="medidas" class="swal2-input" placeholder="Ingrese medidas tomadas">
                                `,
                            showCancelButton: true,
                            preConfirm: () => {
                                const medidas = document.getElementById('medidas').value;


                                if (!medidas) {
                                    Swal.showValidationMessage('Debes ingresar una breve descripción de las medidas');
                                    return false; // Impide cerrar el modal
                                }

                                // Devuelve un objeto con ambos valores
                                return {
                                    medidas
                                };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const {

                                    medidas
                                } = result.value; // Extrae valores del objeto result.value


                                console.log('Medidas ingresadas:', medidas);

                                // Enviar los datos por AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "../php/procesamientoPruebaArtificio.php",
                                    data: {
                                        id: id,

                                        descripcion: medidas
                                    },
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Medidas cargadas '
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

                        // Inicializar el datepicker de Flatpickr
                        flatpickr("#fecha_toma", {
                            dateFormat: "Y-m-d", // Formato: Año-Mes-Día
                            defaultDate: new Date(), // Fecha por defecto
                            locale: "es" // Opcional, para español
                        });



                    }
                    /* else {
                                           $.ajax({
                                               type: "POST",
                                               url: "../php/procesamientodecarga_solicitud.php",
                                               data: {
                                                   id: id,
                                                   atencion_recibida: atencion_recibida

                                               },
                                               success: function(data) {
                                                   Swal.fire({
                                                       icon: 'success',
                                                       title: data
                                                   }).then(function() {
                                                       window.location = "01,2-atenciones.php";
                                                   })

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
                                       } */




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }

        function enviarPrueba(p1) {
            var id = p1;
            Swal.fire({
                title: '¿Ingrese una fecha para la prueba? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Cargar',
                confirmButtonColor: '#1AA83E',
                html: '<input type="date" id="fecha" class="swal2-input" required placeholder="Ingrese medidas tomadas">',

                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    fecha = $('#fecha').val();
                    id = p1;
                    console.log(fecha);

                    $.ajax({
                        type: "POST",
                        url: "../php2/__agregar_a_prueba.php",
                        data: {
                            id: id,
                            fecha: fecha
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Medidas cargadas '
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


                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }

        function verDescripcionM(p1) {
            Swal.fire({
                title: 'Descripción de las medidas:',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1AA83E',
                html: p1,
            })
        }

        function verDescripcion(p1) {
            Swal.fire({
                title: 'Descripción del requerimiento:',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1AA83E',
                html: `<details>
                        <summary>Descripcion</summary>
                        <p>${p1}</p>
                    </details>
                    
                    `,
            })
        }

        function evaluar(p1) {
            var id = p1;
            Swal.fire({
                title: '¿Este beneficiario está apto?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Cargar',
                confirmButtonColor: '#1AA83E',
                html: `
                    <select name="recibido" id="recibido" required style="width:100%">
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                    </select>
                    <br><br>
            
                `,
                denyButtonText: 'No cargar',
            }).then((result) => {
                if (result.isConfirmed) {
                    let recibido = document.getElementById('recibido').value;
                    let id = p1;


                    let formData = new FormData();
                    formData.append("id", id);
                    formData.append("recibido", recibido);

                    console.log(formData)
                    $.ajax({
                        type: "POST",
                        url: "../php2/__agregar_evaluacion_protesis_proyecto.php",
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data)
                            Swal.fire({
                                icon: 'success',
                                title: 'Cita otorgada en la fecha '
                            }).then(() => {
                                location.reload();
                            });

                            if (!data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo registrar la solicitud, verifique datos"
                                }).then(() => {
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
                } else if (result.isDenied) {
                    Swal.fire('Los cambios no se guardaron', '', 'info');
                }
            });




        }
    </script>