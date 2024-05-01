<?php
include_once("partearriba.php");
$gerencia_json = json_encode($gerencia);
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Encuentros: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados();
        $sincarnet = $dis->consultageneralsincarnet();

        include_once("../php/01-atenciones.php");
        $aten = new Atenciones(1);

        $atenciones =  $aten->contarTodasAtencionesa();

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
                        <div class="progress-bar" style="width:75%;">
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
                        <div class="progress-bar" style="width:75%;">
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
                        <div class="progress-bar" style="width:75%;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="Beneficiarios.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

    </div>


    <div class="cont-registro">

        <div class="container">

            <header>
                Agregar nuevo encuentro
            </header>

            <form method="post" class="dos">
                <div class="form first">

                    <div class="details personal">
                        <span class="title">Lugar de encuentro</span>
                        <div class="fields">

                            <div class="input-field dos">
                                <label>Fecha de actividad</label>
                                <input type="date" id="fecha_encuentro" name="fecha_encuentro">
                            </div>


                            <div class="input-field">
                                <label>Estado</label>
                                <select name="estado" id="estado" require>
                                    <option value="0">Seleciona una opcion</option>
                                    <option value="1">Amazonas</option>
                                    <option value="2">Anzoátegui</option>
                                    <option value="3">Apure</option>
                                    <option value="4">Aragua</option>
                                    <option value="5">Barinas</option>
                                    <option value="6">Bolívar</option>
                                    <option value="7">Carabobo</option>
                                    <option value="8">Cojedes</option>
                                    <option value="9">Delta Amacuro</option>
                                    <option value="24">Distrito Capital</option>
                                    <option value="10">Falcon</option>
                                    <option value="11">Guarico</option>
                                    <option value="21">La Guaira</option>
                                    <option value="12">Lara</option>
                                    <option value="13">Mérida</option>
                                    <option value="14">Miranda</option>
                                    <option value="15">Monagas</option>
                                    <option value="16">Nueva Esparta</option>
                                    <option value="17">Portuguesa</option>
                                    <option value="18">Sucre</option>
                                    <option value="19">Tachira</option>
                                    <option value="20">Trujillo</option>
                                    <option value="22">Yaracuy</option>
                                    <option value="23">Zulia</option>
                                </select>
                            </div>

                            <div class="input-field" id="lista2">


                            </div>
                            <div class="input-field" id="lista3">


                            </div>


                            <div class="input-field dos">
                                <label>Actividad</label>
                                <input type="text" id="actividad" name="actividad">
                            </div>

                        </div>




                    </div>




                </div>

                <button class="nextBtn" name="registro" id="registro">
                    <span class="btnText">Registrar</span>
                    <ion-icon name="send-outline"></ion-icon>
                </button>


        </div>
    </div>

    <div class="reportes-totales">

        <!-- reportes 1 -->
        <!-- <div class="reporte">
            <a href="04-ortesisyProtesis.php">Citas</a>
        </div>
        <div class="reporte">
            <a href="05-pruebaArtificio.php">Prueba de artificio</a>
        </div> -->
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
        <?php
        include_once("../php/05-encuentro.php");
        $aten = new encuentro(1);
        $consulta = $aten->consultarTodosEncuentro();
        $cantidadRegistros = count($consulta);
        ?>
        <!-- <div class="personas-conatencion"><a href="04-tomasAsignadas.php">Talleres dados</a></div> -->
        <h2>Encuentros: <?php echo $cantidadRegistros ?></h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Fecha de encuentro</th>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>Parroquia</th>
                    <th>Actividad</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/05-encuentro.php");
                $aten = new encuentro(1);
                $consulta = $aten->consultarTodosEncuentro();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                        if ($registros["gerencia"] == $gerencia || $rol == "Superusuario") {
                ?>
                            <tr>

                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["fecha_encuentro"] ?></td>
                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["nombre_parroquia"] ?></td>
                                <td><?php echo $registros["actividad"] ?></td>
                                <td><a href="10-verEncuentro.php?id=<?php echo $registros["id"] ?>">Ver encuentro</a></td>

                                <?php if ($rol == "Superusuario") { ?>
                                    <td><a href="eliminar/eliminar_encuentro.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>

                                <?php } else {
                                    echo "<td></td>";
                                } ?>

                            </tr>
                <?php
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        $(function() {

            $("#registro").click(function(e) {


                var valid = this.form.checkValidity();
                if (valid) {



                    /* Detalles personales */
                    var fecha_encuentro = $('#fecha_encuentro').val();
                    var estado = $('#estado option:selected').text();
                    var municipio = $('#municipio option:selected').text();
                    var parroquia = $('#parroquia option:selected').text();
                    var gerencia = <?php echo $gerencia_json; ?>;
                    var actividad = $("#actividad").val();




                    e.preventDefault();
                    Swal.fire({
                        title: '¿Desea registrar a esta Jornada? ',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Save',
                        confirmButtonColor: '#1AA83E',
                        html: '<b>Estado: ' + estado + '</b> <br>' +
                            '<b>Municipio: ' + municipio + '</b><br>' +
                            '<b>Parroquia: ' + parroquia + '</b><br>' +
                            '<b>Actividad: ' + actividad + '</b>',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {

                            var estado = $("#estado").val()
                            var gerencia = <?php echo $gerencia_json; ?>;
                            var municipio = $("#municipio").val()
                            var parroquia = $("#parroquia").val()
                            var actividad = $("#actividad").val()

                            console.log(estado, municipio, parroquia, actividad, gerencia, fecha_encuentro);
                            $.ajax({
                                type: "POST",
                                url: "../php/procesamientoencuentro.php",
                                data: {
                                    estado: estado,
                                    municipio: municipio,
                                    parroquia: parroquia,
                                    actividad: actividad,
                                    gerencia: gerencia,
                                    fecha_encuentro: fecha_encuentro




                                },
                                success: function(data) {
                                    console.log(data)
                                    if (data.trim() == "1") {
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Se registró el encuentro exitosamente'
                                        }).then(function() {
                                            window.location = "10-encuentros.php";
                                        })
                                    }

                                    if (data.trim() != "1") {
                                        Swal.fire({
                                            icon: 'error',
                                            title: "No se pudo registrar la jornada"
                                        }).then(function() {
                                            window.location = "10-encuentros.php";
                                        })
                                    }
                                },
                                error: function(data) {
                                    Swal.fire({
                                        'icon': 'error',
                                        'title': 'Oops...',
                                        title: "No se pudo registrar la jornada, espere un momento"

                                    })
                                }
                            })

                        } else if (result.isDenied) {
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })



                }
            })
        })
    </script>

    <?php
    include_once("parteabajo.php");
    ?>