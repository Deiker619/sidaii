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
                    <th>Historia medica</th>
                    <th>Fecha establicida para la toma</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-03-toma_medidas.php");
                $aten = new toma_medidas(1);
                $consulta = $aten->consultarTodasMedidasSindar();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["codigo_cita"] ?></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["artificio"] ?></td>
                            <td><a class="cargar" href="15-verHistoriaMedica.php?codigo_cita=<?php echo  $registros["codigo_cita"] ?>">Ver historia M.</a></td>
                            <td><?php echo $registros["fecha_medidas"] ?></td>
                            <td style="color: red;">Sin tomar medidas</td>
                            <td><a  class="remitir" onclick='cargar(<?php echo $registros["codigo_cita"]?> )'>Tomar medidas</a></td>
                            <td><a href="" class="eliminar">Eliminar Reg</a></td>
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
                html: 
                    '<select name="recibido" id="recibido" require style="width:100%">' +
                    '<option value="Si">Si</option>' +
                    '<option value="No">No</option>' +

                    '</select>'
                    ,
                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    recibido = $('#recibido option:selected').text();
                    console.log(recibido)
                    if (recibido == "Si") {

                        var inputValue = "";

                        const {
                            value: atencion
                        } = Swal.fire({
                            title: 'Cargue el codigo de la toma de medidas',
                            input: 'number',
                            inputLabel: 'Introduce el codigo de la toma',
                            inputValue: inputValue,
                            showCancelButton: true,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Debes escribir algo'
                                }

                                if (value) {
                                    codigo_toma = value;
                                    console.log(recibido, id, codigo_toma)

                                    /* $.ajax({
                                        type: "POST",
                                        url: "../php/procesamientodecarga_solicitud.php",
                                        data: {
                                            id: id,
                                            recibido: recibido,
                                            codigo_toma

                                        },
                                        success: function(data) {
                                            Swal.fire({

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
                                    }) */

                                }
                            }

                        })


                    } /* else {
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
    </script>