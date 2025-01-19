<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="stylesprotesis.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php
include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);
$laboratorio = $_REQUEST["laboratorio"];

$aten->setid($laboratorio);
$registro = $aten->verLaboratorio();
$estado = $registro["nombre_estado"];
$nombre_lab = $registro["nombre_lab"];
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"><?php echo $registro["nombre_estado"] ?>:<?php echo $registro["nombre_lab"]; ?></span>
        </div>
    </div>

    <!-- <div class="botones-header">
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
    </div> -->

    <!-- <div class="saludo">
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
    </div> -->
    <div class="checkboxes">
        <label class="cl-checkbox">
            <input checked="" type="radio" name="atencion_especial" value="ver_atenciones" id="remitir">
            <span>Ver atenciones</span>
        </label>
        <label class="cl-checkbox">
            <input type="radio" name="atencion_especial" value="registrar_atencion" id="remitir">
            <span>Registrar atencion</span>
        </label>

        <label class="cl-checkbox">
            <input type="radio" name="atencion_especial" value="ver_graficas" id="orientar">
            <span>Ver graficas</span>
        </label>

    </div>

    <div id="registrar_atencion">
        <div class="cont-registro">

            <div class="container">

                <header>
                    Agregar una atencion del estado <span style="color: #0c77e9"><?php echo $registro["nombre_estado"] ?>:<?php echo $registro["nombre_lab"]; ?></span>
                </header>

                <div class="input-group" style="margin-top: 20px; justify-content: right; align-items: center;">
                    <input type="text" class="input" id="searchCedula" name="searchCedula" placeholder="12345678" autocomplete="off">
                    <input class="button--submit" value="Tomar datos" onclick="tomarDatos()" type="button">
                </div>
                <form action="" method="post" class="dos">

                    <div class="form first">

                        <div class="details personal">
                            <span class="title">Detalles del beneficiario</span>
                            <div class="fields">





                                <div class="input-field dos">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="nombre" id="nombre">
                                </div>
                                <div class="input-field dos">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="apellido" id="apellido">
                                </div>
                                <div class="input-field dos">
                                    <label>Cédula</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="cedula" id="cedula">
                                </div>
                                <div class="input-field dos">
                                    <label>Nacionalidad</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="nacionalidad" id="nacionalidad">
                                </div>
                                <div class="input-field dos">
                                    <label>Fecha de nacimiento</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="fecha_naci" id="fecha_naci">
                                </div>
                                <div class="input-field dos">
                                    <label>Edad</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="edad" id="edad">
                                </div>
                                <div class="input-field dos">
                                    <label>Sexo</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="sexo" id="sexo">
                                </div>
                                <div class="input-field dos">
                                    <label>Telefono</label>
                                    <input type="number" placeholder="numero de personas a atender" required name="telefono" id="telefono">
                                </div>


                                <div class="input-field">
                                    <label>Estado</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="estado" id="estado">
                                </div>
                                <div class="input-field">
                                    <label>Municipio</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="municipio" id="municipio">
                                </div>
                                <div class="input-field">
                                    <label>Parroquia</label>
                                    <input type="text" placeholder="numero de personas a atender" required name="parroquia" id="parroquia">
                                </div>



                            </div>




                        </div>
                        <div class="details personal">
                            <span class="title">Servicios prestados</span>
                            <div class="fields">
                                <div class="input-field">
                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="apertura" value="apertura" id="apertura">
                                            <span>Apertura de historia medica</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="toma_medidas" value="toma_medidas" id="toma_medidas">
                                            <span>Toma de medida</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="solicitud_reparacion" value="solicitud_reparacion" id="solicitud_reparacion">
                                            <span>Solicitud de reparacion</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="prueba_marcha" value="prueba_marcha" id="prueba_marcha">
                                            <span>Prueba de marcha</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="asesoria" value="asesoria" id="asesoria">
                                            <span>Asesoria </span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="checkbox" name="entrega" value="entrega" id="entrega">
                                            <span>Entrega</span>
                                        </label>





                                    </div>








                                </div>




                            </div>




                        </div>
                        <div class="details personal">
                            <span class="title">Otros detalles</span>
                            <div class="fields">

                                <div class="input-field dos">
                                    <label>Fecha de registro</label>
                                    <input type="date" placeholder="fecha de registro" required name="fecha_registro" id="fecha_registro">
                                </div>
                                <div class="input-field dos">
                                    <label>Fecha de la asistencia</label>
                                    <input type="date" placeholder="fecha de la asistencia" required name="fecha_asistencia" id="fecha_asistencia">
                                </div>
                                <div class="input-field dos">
                                    <label>N° de expediente</label>
                                    <input type="text" placeholder="fecha de registro" required name="expediente" id="expediente">
                                </div>



                            </div>




                        </div>
                    </div>

                    <button class="nextBtn" name="registro" id="registro">
                        <span class="btnText">Registrar atención</span>
                        <ion-icon name="send-outline"></ion-icon>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div id="ver_graficas">
        <p>ver graficas</p>
        <!-- <div class="boxes">

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

        
        </div> -->


        <!-- <div class="graficas">
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
        </div> -->
    </div>
    


    <div id="ver_atenciones">
        <div class="tabla-atencion">


            <h2>Atenciones otorgadas por: <?php echo $nombre_lab ?> </h2>
            <table id="solicitudes">
                <thead>
                    <tr>

                        <th>ID</th>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Servicio</th>
                        <th>Fecha de registro</th>
                        <th>Fecha de asistencia</th>
                        <th>N° expediente</th>
                        <th></th>
    



                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/01-02-cita_protesis.php");
                    $aten = new citas_protesis(1);
                    $consulta = $aten->consultarAtencionesLaboratorio($laboratorio);
                    $cantidadRegistros = count($consulta);
                    echo $cantidadRegistros;
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td class="sorting_1"><a class="cedula" id="verBeneficiario" <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "Coordinador") { ?> href="20-verAtencionLaboratorio.php?id=<?php echo $registros['id']; ?>" <?php } ?>><?php echo $registros["id"] ?></a></td>
                                <td> <a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>

                                <td><?php echo $registros["nombre_servicio"] ?></td>
                                <td><?php echo $registros["fecha_asistencia"] ?></td>
                                <td><?php echo $registros["fecha_registro"] ?></td>
                                <td><?php echo $registros["expediente"] ?></td>
                                <td><a onclick='eliminar(<?php echo $registros["id"]; ?>)' class="eliminar">Eliminar Reg</a></td>
                              



                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>


    </div>








    <!-- <canvas id="otra" class="chart2"></canvas> -->


    <!-- <div class="graficas">
        




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
    </div> -->


    <!-- <canvas id="graficaxatencion" class="chart2"></canvas>
 -->










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
                    var laboratorio = <?php echo json_encode($laboratorio) ?>;
                    var cedula = $("#cedula").val();
                    var fecha_registro = $("#fecha_registro").val();
                    var fecha_asistencia = $("#fecha_asistencia").val();
                    var expediente = $("#expediente").val();
                    var nombre = $("#nombre").val();
                    var apellido = $("#apellido").val();
                    var discapacidad = $("#discapacidad").val();

                    var servicios = {
                        "apertura": $("#apertura").is(":checked") ? $("#apertura").val() : null,
                        "toma_medidas": $("#toma_medidas").is(":checked") ? $("#toma_medidas").val() : null,
                        "solicitud_reparacion": $("#solicitud_reparacion").is(":checked") ? $("#solicitud_reparacion").val() : null,
                        "prueba_marcha": $("#prueba_marcha").is(":checked") ? $("#prueba_marcha").val() : null,
                        "asesoria": $("#asesoria").is(":checked") ? $("#asesoria").val() : null,
                        "entrega": $("#entrega").is(":checked") ? $("#entrega").val() : null
                    };

                    console.log(servicios);

                    e.preventDefault();
                    asignarAtencion();
                    $.ajax({
                        type: "POST",
                        url: "../php2/__atenciones_laboratorio.php",

                        data: {
                            accion: 'r',
                            laboratorio: laboratorio,
                            cedula: cedula,
                            servicios: JSON.stringify(servicios),
                            fecha_registro: fecha_registro,
                            fecha_asistencia: fecha_asistencia,
                            expediente: expediente,
                        },

                        success: function(data) {
                            console.log(data)
                            if (data.message == 200) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Registro de atencion',
                                    'text': 'Se registro correctamente la atencion',
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {
                                    location.reload();
                                })
                            }
                            if (data.message == 500) {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Registro de atencion',
                                    'text': 'No se pudo registrar la atencion',
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {
                                    location.reload();
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


                }
            })
        })
    </script>
    <?php
    include_once("parteabajo.php");
    ?>


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
                        url: "../php2/__atenciones_laboratorio.php",
                        data: {
                            accion: 'b',
                            id: id
                        },
                        success: function(data) {

                            console.log(data)
                            if (data.message == 200) {

                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Proceso completado',
                                    'text': 'Se elimino correctamente esta atencion',
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {
                                    location.reload()
                                })
                            }
                            if (data.message == 500) {

                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Ocurrió un error',
                                    'text': 'No se pudo eliminar el registro',
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {
                                    window.reload()
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
                    Swal.fire('Changes are not eliminated', '', 'info')
                }
            })
        }
    </script>



    <script>
        function tomarDatos() {

            let cedula = $('#searchCedula').val();

            console.log(cedula)

            $.ajax({
                type: "POST",
                url: "../php2/buscar_datos_beneficiario.php",
                data: {
                    cedula: cedula
                },
                success: function(data) {
                    if (data.message == 404) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'No se encontro ningun beneficiario con esa cedula',
                            footer: '<a href="01-atencionCiuInfraestructura.php">Ir a registrar</a>'
                        })
                    }

                    if (data.message == 200) {
                        console.log(data)
                        $('#nombre').val(data.datos.nombre).prop('readonly', true);
                        $('#apellido').val(data.datos.apellido).prop('readonly', true);
                        $('#cedula').val(data.datos.cedula).prop('readonly', true);
                        $('#nacionalidad').val(data.datos.nacionalidad).prop('readonly', true);
                        $('#fecha_naci').val(data.datos.fecha_naci).prop('readonly', true);
                        $('#edad').val(data.datos.edad).prop('readonly', true);
                        $('#sexo').val(data.datos.sexo).prop('readonly', true);
                        $('#telefono').val(data.datos.telefono).prop('readonly', true);
                        $('#estado').val(data.datos.nombre_estado).attr('data-valor', data.datos.estado).prop('readonly', true);
                        $('#municipio').val(data.datos.nombre_municipio).attr('data-valor', data.datos.municipio).prop('readonly', true);
                        $('#parroquia').val(data.datos.nombre_parroquia).attr('data-valor', data.datos.parroquia).prop('readonly', true);

                    }
                },
                error: function(data) {
                    console.log(data)
                }
            })
        };
    </script>

    <script>
        $("#ver_graficas").hide();
        $("#registrar_atencion").hide();

        function opciones_menu_protesis() {
            $("input[name='atencion_especial']").change(function() {
                console.log(this.value + ":" + this.checked);
                if (this.value == "ver_graficas") {

                    $("#registrar_atencion").hide();
                    $("#ver_graficas").show();
                    $("#ver_atenciones").hide();
                }

                if (this.value == "registrar_atencion") {
                    $("#ver_graficas").hide();
                    $("#registrar_atencion").show();
                    $("#ver_atenciones").hide();
                }
                if (this.value == "ver_atenciones") {
                    $("#ver_graficas").hide();
                    $("#registrar_atencion").hide();
                    $("#ver_atenciones").show();

                }


            });
        }
        opciones_menu_protesis();
    </script>