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
                    <th>ID de cita</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Artificio</th>
                    <th>Descripcion</th>
                    <th>Fecha establicida para la toma</th>
                    <th>Status</th>
                    <th></th>
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
                            <td><?php echo $registros["fecha_toma"] ?? '10/09/1999' ?></td>
                            <td style="color: red;">Sin tomar medidas</td>
                            <td><a class="remitir" onclick='cargar(<?php echo $registros["id"] ?>)'>Tomar medidas</a></td>
                            <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
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
                            title: 'Seleccione la fecha para la prueba de artificio',
                            html: `
                                    <input type="date" id="fecha_toma" class="swal2-input" placeholder="Selecciona una fecha">
                                    <input type="text" id="medidas" class="swal2-input" placeholder="Ingrese medidas tomadas">
                                `,
                            showCancelButton: true,
                            preConfirm: () => {
                                const fechaToma = document.getElementById('fecha_toma').value;
                                const medidas = document.getElementById('medidas').value;

                                // Validar que ambos campos tengan valor
                                if (!fechaToma) {
                                    Swal.showValidationMessage('Debes seleccionar una fecha');
                                    return false; // Impide cerrar el modal
                                }

                                if (!medidas) {
                                    Swal.showValidationMessage('Debes ingresar una breve descripción de las medidas');
                                    return false; // Impide cerrar el modal
                                }

                                // Devuelve un objeto con ambos valores
                                return {
                                    fechaToma,
                                    medidas
                                };
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const {
                                    fechaToma,
                                    medidas
                                } = result.value; // Extrae valores del objeto result.value

                                console.log('Fecha seleccionada:', fechaToma);
                                console.log('Medidas ingresadas:', medidas);

                                // Enviar los datos por AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "../php/procesamientoPruebaArtificio.php",
                                    data: {
                                        id: id,
                                        fecha_prueba: fechaToma,
                                        descripcion: medidas
                                    },
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Operacion exitosa'
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

        function verDescripcion(p1) {
            Swal.fire({
                title: 'Descripción del requerimiento:',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1AA83E',
                html: p1,
            })
        }
    </script>