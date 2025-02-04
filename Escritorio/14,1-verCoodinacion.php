<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php
include_once("../php/10-coordinaciones-estadales.php");
$coordinacion = $_REQUEST["coordinacion"];
$aten = new coordinacion(1);

$aten->setid($coordinacion);
$registro = $aten->consultarCoordinacion();
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"><?php echo $registro["nombre_coordinacion"]; ?>: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="botones-header">
        <a href="reportes/reporte_solicitudes_OP.php?coordinacion=<?php echo $coordinacion ?>"> <button class="download-button">
                <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line y2="13" x2="8" y1="13" x1="16"></line>
                        <line y2="17" x2="8" y1="17" x1="16"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg> Generar Reporte de solicitudes</div>
                <div class="download">
                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line y2="3" x2="12" y1="15" x1="12"></line>
                    </svg>
                </div>
            </button>
        </a>
    </div>

    <div class="saludo">
        <div class="date-saludo">

        </div>
        <div class="contenedor-saludo">
            <div class="text">
                <h1 class="text-saludo">Bienvenido/a, <span style="color:aliceblue"> <?php echo $NombreUsuarioActivo . " [" . $rol . "]"; ?></span></h1>
                <a href="#atenciones"><button class="boton-saludo">
                        ir a la tabla de atenciones
                    </button></a>

            </div>
            <div class="contenedor-img">
                <img src="./img/saludo.png" alt="" srcset="">
            </div>
        </div>
    </div>
    <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados();
        $sincarnet = $dis->consultageneralsincarnet();

        include_once("../php/01-atenciones-estadales.php");
        $aten = new AtencionesEstadales(1);

        $atenciones =  $aten->contarTodasAtencionesa();

        function CalculoPorcentaje($a, $b)
        {

            $porcentaje = (count($a) / count($b)) * 100;
            return $porcentaje;
        }

        ?>
        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-first-aid'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name">Atenciones</span></a>
                    <span class="number"><?php echo count($atenciones) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:<?php echo CalculoPorcentaje($atenciones, $consulta)  . "%" ?>;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-id-card'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name"><a href="sincarnet.php">Sin carnet </a></span>
                    <span class="number"><?php echo count($sincarnet) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:<?php echo CalculoPorcentaje($sincarnet, $consulta)  . "%" ?>">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="sincarnet.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-group'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name"><a href="Beneficiarios.php">Beneficiarios </a></span>
                    <span class="number"><?php echo count($consulta); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:<?php echo (count($consulta) / 1000) * count($consulta) . "%" ?>;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="Beneficiarios.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

        <!--       <div class="box box2">
            <i class='bx bxs-user-badge'></i>
            <span class="link-name"><a href="sincarnet.php">Sin carnet </a></span>
            <span class="number"><?php echo count($sincarnet) ?></span>
        </div>

        <div class="box box3">
            <i class='bx bx-group'></i>
            <span class="link-name"><a href="Beneficiarios.php">Beneficiarios </a></span>
            <span class="number"><?php echo count($consulta); ?></span>

        </div> -->
    </div>


    <div class="graficas">
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones sin dar</h2>

            <div class="cantidad_registro sindar"><?php
                                                    include_once("../php/10-coordinaciones-estadales.php");
                                                    $aten = new coordinacion(1);
                                                    $aten->setid($coordinacion);
                                                    $reg = $aten->consultarCoordinacionesXatencionesSINDAR();

                                                    if (!$reg) {
                                                        echo "0";
                                                    } else {
                                                        echo $reg["numero"];
                                                    }




                                                    ?> </div>

        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones dadas</h2>

            <div class="cantidad_registro dadas"><?php
                                                    include_once("../php/10-coordinaciones-estadales.php");
                                                    $aten = new coordinacion(1);
                                                    $aten->setid($coordinacion);
                                                    $reg = $aten->consultarCoordinacionesXatencionesDADAS();


                                                    echo $reg["dadas"]

                                                    ?> </div>
        </div>
    </div>

    <?php if ($rol == "Coordinador" || $rol =="Analista") { ?>
        <div class="tabla-atencion" id="atenciones">
            <div class="personas-conatencion">
                <div class="botones__especiales">
                    <button class="Btn export">

                        <div class="sign">
                            <i class='bx bx-export'></i>
                        </div>

                        <div class="text_boton"><a class="enlace_especial" href="01-remitidos_oac.php"> Remitidos a otras</a></div>

                    </button>
                    <button class="Btn import">

                        <div class="sign">
                            <i class='bx bx-import'></i>
                        </div>

                        <div class="text_boton"> <a class="enlace_especial" href="01-remitidos_a.php">Remitidos a gerencia</a> </div>
                    </button>
                    <button class="Btn guide">

                        <div class="sign"><i class='bx bx-user-voice'></i></div>

                        <div class="text_boton"><a class="enlace_especial" href="14,6-orientacionesEstadales.php"> Orientados</a></div>
                    </button>
                    <!--  <button class="Btn guide solicitud">

                    <div class="sign"><i class='bx bx-accessibility'></i></div>

                    <div class="text_boton"><a class="enlace_especial" href="14,7-solicitudes_OP.php"> Solicitudes</a></div>
                </button> -->



                </div>



                <a class="enlace" href="14,5-atencionEstadalRecibida.php">Personas con atenciones recibidas</a>

            </div>
            <h2>Personas para atención estadal</h2>


            <!-- <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div>
        <br> -->

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado</th>
                        <th>Discapacidad</th>
                        <th>Coordinacion</th>
                        <th>Solicitud</th>
                        <th>Informe</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                        <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "Coordinador") { ?>
                            <th></th>
                        <?php } ?>
                        <th></th>



                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/01-atenciones-estadales.php");
                    $aten = new AtencionesEstadales(1);
                    if ($rol == "Administrador" || $rol == "Superusuario") {
                        $consulta = $aten->consultarTodosAtencionesAdmin();
                    } else {

                        $aten->setcoordinacion($coordi);
                        $consulta = $aten->consultarTodosAtenciones();
                    }

                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                                <td class="sorting_1 <?php echo $registros['urgencia'] ?>"><a class="cedula" id="verBeneficiario" <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "Coordinador") { ?> href="modificarAtencionOP.php?numero_aten=<?php echo $registros['numero_aten']; ?>" <?php } ?>> <?php echo $registros["numero_aten"] ?></a></td>
                                <td><a class="cedula" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre_e"] ?></td>

                                <td style="color: blue;">[<?php echo $registros["nombre_coordinacion"] ?>]</td>

                                <?php if ($registros["atencion_solicitada"]) { ?>
                                    <td>
                                        <a class="cargar-solicitud" href="reportes/reporteCargarSolicitudesOP.php?numero_aten=<?php echo $registros["numero_aten"]; ?>"><?php echo $registros["atencion_solicitada"] ?></a>

                                    </td>
                                <?php } else { ?>
                                    <td><a class="cargar" id="cargar" onclick='cargar(<?php echo $registros["numero_aten"] ?>)'>Solicitud</a></td>
                                <?php  } ?>
                                <?php if (!$registros["informe"]) {
                                    echo '<td> <i class="bx bxs-file-pdf" onclick="subirArchivo(' . $registros["numero_aten"] . ')"></i>' . '</td>';
                                } else { ?>
                                    <td> <a class="informe" id="verBeneficiario" href="documentos/informes/<?php echo $registros['informe']; ?>"> <?php echo "<i class='bx bx-down-arrow-alt'></i>" ?> </a></td>

                                <?php } ?>


                                <?php if ($registros["statu"] == "Sin atencion") { ?><!-- OJO: Mejorar -->

                                    <td style="color: red;"><?php echo $registros["statu"]; ?></td>
                                <?php } else if ($registros["statu"]) { ?>
                                    <td style="color:#0e9cd4;"><?php echo $registros["statu"]; ?></td>
                                <?php } ?>
                                <td><a href="14,3-asignarAtencionEstadal.php?numero_aten=<?php echo $registros["numero_aten"] ?>">Dar atención</a></td>
                                <td><a href="01,10-seguimiento_estadal.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="remitir"> Seguimiento</a></td>
                                <?php if ($rol == "Superusuario" || $rol == "Administrador" || $rol == "Coordinador") { ?>
                                    <td><a onclick='eliminar(<?php echo $registros["numero_aten"]; ?>)' class="eliminar">Eliminar Reg</a></td>
                                <?php } ?>
                                <td>
                                    <div class="enviar">
                                        <?php if ($registros["atencion_solicitada"]) { ?>
                                            <div class="enviar_text"> <i class='bx bx-mail-send' onclick="enviarEmail('<?php echo $registros['numero_aten'] ?>','<?php echo $registros['email'] ?? null ?>')" style="color:#3ab556; cursor:pointer"></i></div>
                                        <?php } else { ?>

                                            <div class="enviar_text"> <i class='bx bx-no-entry' style="color:crimson; cursor:not-allowed "></i></div>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
            <footer class="table-footer">
                <div class="urgencia-contenedor">
                    <div class="urgencia-color urgente"></div>
                    <label for="">Urgente</label>
                </div>
                <div class="urgencia-contenedor">
                    <div class="urgencia-color media"></div>
                    <label for="">Media</label>
                </div>
                <div class="urgencia-contenedor">
                    <div class="urgencia-color baja"></div>
                    <label for="">Baja</label>
                </div>
            </footer>
        </div>
    <?php } ?>

    <div class="tabla-atencion">


        <h2>Solicitudes</h2>
        <table id="solicitudes">
            <thead>
                <tr>

                    <th>Nombre de la solicitud</th>
                    <th>Cantidad</th>


                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/10-coordinaciones-estadales.php");
                $aten = new Coordinacion(1);
                $aten->setid($coordinacion);
                $consulta = $aten->consultadeSolicitudes();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["atencion_solicitada"] ?></td>
                            <td><?php echo $registros["cantidad"] ?></td>

                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>







    <canvas id="otra" class="chart2"></canvas>


    <div class="graficas">
        <!-- Cargar archivos -->




        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por Atencion brindada</h2>
            <canvas id="graficaxbrindada"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones totales por Mes</h2>
            <canvas id="graficaxmes"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por Año </h2>
            <canvas id="graficaxaño"></canvas>
        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por sexo</h2>
            <canvas id="graficaxsexo"></canvas>
        </div>
    </div>


    <canvas id="graficaxatencion" class="chart2"></canvas>











    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>


    <!-- Subir Archivos -->
    <script>
        function eliminar(p1) {


            var id = p1;
            console.log(id);


            Swal.fire({
                icon: "question",
                title: '¿Desea eliminar esta atencion?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `No eliminar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    asignarAtencion();
                    $.ajax({
                        type: "GET",
                        url: "eliminar/eliminar_atencion_estadal.php",
                        data: {
                            id: id


                        },
                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Eliminacion de atencion',
                                'text': 'Se elimino correctamente esta atencion',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                location.reload();
                            })
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
                    Swal.fire('Changes are not eliminated', '', 'info')
                }
            })
        }

        function enviarEmail(a, b) {
            let correo = b
            let email = true;
            let numero_aten = a;

            /* No tiene correo */
            if (correo) {
                Swal.fire({
                    title: "¿Desea enviar el comprobante al correo registrado?",
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
                            url: "reportes/enviarEmailOP.php",
                            data: {
                                numero_aten: numero_aten,
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

                                        location.reload();
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
                                url: "reportes/enviarEmailOP.php",
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

                                            location.reload();
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
                                            location.reload();
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

        function subirArchivo(a) {
            var numero_aten = a;
            Swal.fire({
                title: 'Cargar informe medico',
                input: 'file',
                inputAttributes: {
                    accept: ['application/pdf'], // Limita a archivos PDF, puedes ajustar según tus necesidades
                },
                showCancelButton: true,
                confirmButtonText: 'Subir',
                cancelButtonText: 'Cancelar',
            }).then((file) => {
                if (file.isConfirmed && file.value) {
                    // Crear un objeto FormData y agregar el archivo y el número
                    const formData = new FormData();
                    formData.append('archivo', file.value);
                    formData.append('numero_aten', numero_aten);

                    // Hacer la solicitud AJAX utilizando jQuery
                    asignarAtencion();
                    $.ajax({
                        url: 'documentos/informes/cargardocumento.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            try {
                                const dataJ = JSON.parse(data);
                                Swal.fire(dataJ.mensaje, '', 'success').then(function() {
                                    window.location = "14,1-verCoodinacion.php?coordinacion=" + coordinacion;
                                });


                            } catch (error) {
                                console.error('Error al analizar la respuesta del servidor como JSON:', error);
                                Swal.fire('Error en el formato de la respuesta del servidor', '', 'error');
                            }
                        },
                        error: function(error) {
                            console.error('Error al subir el archivo:', error);
                            Swal.fire('Error al cargar el archivo', '', 'error');
                        }
                    });
                }
            });
        }
    </script>
    <script type="text/javascript">
        $(function() {
            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var cedula = $("#cedula").val();
                    var nombre = $("#nombre").val();
                    var apellido = $("#apellido").val();
                    var numero_jornada = $("#numero_jornada").val();
                    var discapacidad = $("#discapacidad").val();
                    var tipo_ayuda_tec = $("#tipo_ayuda_tec").val();

                    e.preventDefault();
                    asignarAtencion();
                    $.ajax({
                        type: "POST",
                        url: "02,2-jornadaAsignada.php",

                        data: {
                            cedula: cedula,
                            nombre: nombre,
                            apellido: apellido,
                            discapacidad: discapacidad,
                            numero_jornada: numero_jornada,
                            tipo_ayuda_tec: tipo_ayuda_tec
                        },

                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se asigno asistencia correctamente',

                            }).then(function() {
                                window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
                                /*  $("#cedula").attr("readonly","readonly");
                                 $("#nombre").attr("readonly","readonly");
                                 $("#apellido").attr("readonly","readonly");
                                 $("#numero_jornada").attr("readonly","readonly");
                                 $("#discapacidad").attr("readonly","readonly");
                                 $("#tipo_ayuda_tec").attr("readonly","readonly");
                                 */

                            })
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
            })
        })
    </script>
    <?php
    include_once("parteabajo.php");
    ?>

    <!-- graficas -->
    <script>
        const grafica = document.querySelector("#otra").getContext("2d");
        const graficaxatencion = document.querySelector("#graficaxatencion").getContext("2d");
        const graficaxbrindada = document.querySelector("#graficaxbrindada").getContext("2d");
        const graficaxmes = document.querySelector("#graficaxmes").getContext("2d");
        const graficaxaño = document.querySelector("#graficaxaño").getContext("2d");
        const graficaxsexo = document.querySelector("#graficaxsexo").getContext("2d");


        var coordinacion = <?php echo json_encode($coordinacion); ?>


        // Realizar la solicitud Ajax usando jQuery

        //Atenciones por discapacidad
        $.ajax({
            url: "graficas/graficas_coordinaciones.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                // Crear arreglos para almacenar los datos del gráfico
                var nombres_discapacidad = [];
                var discapacidades = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombre_discapacidad = data[i].nombre_discapacidad;
                    var discapacidad = data[i].discapacidad;

                    nombres_discapacidad.push(nombre_discapacidad);
                    discapacidades.push(discapacidad);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(grafica, {
                    type: "line",
                    data: {
                        labels: nombres_discapacidad,
                        datasets: [{
                            label: "Atenciones por: Discapacidad",
                            data: discapacidades,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por ayuda
        $.ajax({
            url: "graficas/graficas_por_atenciones.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var nombres_deayuda = [];
                var Ayudas_dadas = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombre = data[i].nombre_tipoayuda;
                    var Ayuda = data[i].Ayudas_dadas;

                    nombres_deayuda.push(nombre);
                    Ayudas_dadas.push(Ayuda);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxatencion, {
                    type: "line",
                    data: {
                        labels: nombres_deayuda,
                        datasets: [{
                            label: "Atenciones por: Tipo de ayuda tecnica",
                            data: Ayudas_dadas,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones brindadas
        $.ajax({
            url: "graficas/graficas_recibidas.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var nombre = [];
                var Recibidas = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombres = data[i].nombre;
                    var Recibidass = data[i].Recibidas;

                    nombre.push(nombres);
                    Recibidas.push(Recibidass);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxbrindada, {
                    type: "line",
                    data: {
                        labels: nombre,
                        datasets: [{
                            label: "Atenciones por: Tipo de atencion",
                            data: Recibidas,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por mes
        $.ajax({
            url: "graficas/graficas_por_mes.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(mes) {
                var valore = eval(mes);
                var ene = valore[0];
                var feb = valore[1];
                var mar = valore[2];
                var abr = valore[3];
                var may = valore[4];
                var jun = valore[5];
                var jul = valore[6];
                var ago = valore[7];
                var sep = valore[8];
                var oct = valore[9];
                var nov = valore[10];
                var dic = valore[11];



                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxmes, {
                    type: "line",
                    data: {
                        labels: ["Ene", "Feb", "Marz", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                            label: "Atenciones por: Mes",
                            data: [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic],
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por año
        $.ajax({
            url: "graficas/graficas_por_año.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(year) {

                var valors = eval(year);
                var años = valors[0];
                console.log(años)

                let tiempo = new Date()
                let año = tiempo.getFullYear().toString();
                console.log(año)
                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxaño, {
                    type: "bar",
                    data: {
                        labels: [año],
                        datasets: [{
                            label: "Asistencias por: año",
                            data: años,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        // Atenciones por sexo
        $.ajax({
            url: "graficas/graficas_por_sexo.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var sexoss = [];
                var cantidadess = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var sexo = data[i].sexos;
                    var cantidad = data[i].cantidades;

                    sexoss.push(sexo);
                    cantidadess.push(cantidad);
                }
                console.log(sexoss)

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxsexo, {
                    type: "line",
                    data: {
                        labels: sexoss,
                        datasets: [{
                            label: "Sexos",
                            data: cantidadess,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
    </script>
    <!--Cargar Solicitudes  -->
    <script>
        $(document).ready(function() {
            var coordinacion = <?php echo json_encode($coordinacion) ?>
        });


        function cargar(p1) {
            var id = p1;

            Swal.fire({
                title: 'Carga de solicitud a este beneficiario/a? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Cargar',
                confirmButtonColor: '#1AA83E',
                html: `
                    <div class="search-reports" style="display: flex; gap: 1px; justify-content: center">
                    <div class="reports-contenedor"><label>Elige una solicitud</label><br>
                        <select name="atencion_recibida" id="atencion_recibida" require>' +
                        '<option value="1-silla.r">Silla de ruedas estandar</option>' +
                        '<option value="1.1-S.E16">Silla de rueda ergonomica N16</option>' +
                        '<option value="1.2-S.E14">Silla de rueda ergonomica N14</option>' +
                        '<option value="1.3-S.E18">Silla de rueda ergonomica N18</option>' +
                        '<option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>' +
                        '<option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>' +
                        '<option value="1.6-SRB">Silla de rueda bariátricas</option>' +
                        '<option value="21-sllm">Silla a motor</option>' +
                        '<option value="27-Sllc">Silla de rueda clinica</option>' +
                        '<option value="30-sllsr">Silla sanitaria sin ruedas</option>' +
                        '<option value="31-sllsr">Silla sanitaria con ruedas</option>' +
                        '<option value="2-MuletasS">Muletas talla S</option>' +
                        '<option value="2-MuletasM">Muletas talla M</option>' +
                        '<option value="2-MuletasL">Muletas talla L</option>' +
                        '<option value="-MuletasCa">Muletas canadienses adultos</option>' +
                        '<option value="12-Mucp">Muletas canadienses pediatricas</option>' +
                        '<option value="20-Rglp">Regleta con punzon</option>' +
                        '<option value="6-andadera">Andadera adulto fija</option>' +
                        '<option value="22-Apm">Andadera pediatrica multifuncional</option>' +
                        '<option value="23-Apr">Andadera pediatrica con ruedas</option>' +
                        '<option value="25-Anpp">Andadera pediatrica posterior</option>' +
                        '<option value="26-Anpf">Andadera pediatrica fija</option>' +
                        '<option value="7-CamaCli">Cama Clinica</option>' +
                        '<option value="8-Col-Anti">Colchon Antiescara</option>' +
                        ' <option value="1.6-SRB">Silla de ruedas bariátricas</option>' +
                        '<option value="1.7-COP">Coche ortopédico pediátrico</option>' +
                        '<option value="28-chorm">Coche ortopedico mediano</option>' +
                        '<option value="29-chorg">Coche ortopedico grande</option>' +
                        '<option value="9-felula">Ferula</option>' +
                        '<option value="8-Grab">Grabadora</option>' +
                        '<option value="11-panales">Pañales</option>' +
                        '<option value="12-Pro-aud">Protesis auditivas</option>' +
                        '<option value="13-Pro-cad">Protesis de Cadera</option>' +
                        '<option value="14-Pro-rod">Protesis de rodilla</option>' +
                        '<option value="15-Pro-den">Protesis Dental</option>' +
                        '<option value="11-Coj">Cojin antiescaras</option>' +
                        '<option value="3-baston">Baston de apoyo</option>' +
                        '<option value="4-baston.p">Baston de 4 puntas</option>' +
                        '<option value="21-Btrpd">Baston de rastreo pediatricos</option>' +
                        '<option value="13-Brpl34">Baston de rastreo plegable numero 34</option>' +
                        '<option value="14-Brpl36">Baston de rastreo plegable numero 36</option>' +
                        '<option value="15-Brpl38">Baston de rastreo plegable numero 38</option>' +
                        '<option value="15-Brpl44">Baston de rastreo plegable numero 44</option>' +
                        '<option value="16-Brpl46">Baston de rastreo plegable numero 46</option>' +
                        '<option value="-bastonRas">Baston de rastreo plegable numero 48</option>' +
                        '<option value="18-Brpl50">Baston de rastreo plegable numero 50</option>' +
                        '<option value="19-Brpl52">Baston de rastreo plegable numero 52</option>' +
                        '<option value="5-ap.audio">Aparato de audiometria</option>' +
                        '<option value="-nebu">Nebulizador</option>' +
                        '<option value="otros">otros</option>' +

                    '</select><br>
                    </div>
                    <div class="reports-contenedor">
                    <label>Urgencia</label><br>
                    <select name="urgencia" id="urgencia" require>' +
                    '<option value="urgente">Urgente</option>' +
                    '<option value="media">Media</option>' +
                    '<option value="baja">Baja</option>' +
                   
                    </select>
                    </div></div>`,
                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    atencion_recibida = $('#atencion_recibida option:selected').text();
                    urgencia = $('#urgencia option:selected').val();
                    if (atencion_recibida == "otros") {

                        var inputValue = "";

                        const {
                            value: atencion
                        } = Swal.fire({
                            title: 'Agrega la solicitud personalizada',
                            input: 'text',
                            inputLabel: 'Introduce la solicitud',
                            inputValue: inputValue,
                            showCancelButton: true,
                            inputValidator: (value) => {
                                if (!value) {
                                    return 'Debes escribir algo'
                                }

                                if (value) {
                                    atencion_recibida = value;

                                    $.ajax({
                                        type: "POST",
                                        url: "../php/procesamientosolicitud_estadal.php",
                                        data: {
                                            id: id,
                                            atencion_recibida: atencion_recibida,
                                            urgencia: urgencia

                                        },
                                        success: function(data) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: data
                                            }).then(function() {
                                                window.location = "14,1-verCoodinacion.php?coordinacion=" + coordinacion;
                                            })

                                            if (!data) {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: "No se pudo registrar la solicitud, verifique datos"
                                                }).then(function() {
                                                    window.location = "14,1-verCoodinacion.php?coordinacion=" + coordinacion;
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


                    } else {
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientosolicitud_estadal.php",
                            data: {
                                id: id,
                                atencion_recibida: atencion_recibida,
                                urgencia: urgencia

                            },
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: data
                                }).then(function() {
                                    window.location = "14,1-verCoodinacion.php?coordinacion=" + coordinacion;
                                })

                                if (!data) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "No se pudo registrar la solicitud, verifique datos"
                                    }).then(function() {
                                        window.location = "14,1-verCoodinacion.php?coordinacion=" + coordinacion;
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




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }
    </script>