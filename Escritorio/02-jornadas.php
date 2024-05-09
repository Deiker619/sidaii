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
            <span class="link-name">Operacion estadal: <?php echo $rol ?></span>
        </div>
    </div>
    <!-- Boton de reporte -->

    <!-- <a href=""> <button class="download-button">
            <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line y2="13" x2="8" y1="13" x1="16"></line>
                    <line y2="17" x2="8" y1="17" x1="16"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> Generar Reporte</div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </button></a>
 -->






    <div class="cont-registro">

        <div class="container">

            <header>
                Agregar una nueva jornada
            </header>

            <form action="" method="post" class="dos">
                <div class="form first">

                    <div class="details personal">
                        <span class="title">Detalles de ubicación</span>
                        <div class="fields">


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
                                <label>Numero de personas a atender</label>
                                <input type="number" placeholder="numero de personas a atender" required name="personas_atender" id="personas_atender">
                            </div>

                        </div>




                    </div>




                </div>

                <button class="nextBtn" name="registro" id="registro">
                    <span class="btnText">Registrar jornada</span>
                    <ion-icon name="send-outline"></ion-icon>
                </button>


        </div>
    </div>




    </form>
    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
        <h2>JORNADAS </h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>Parroquia</th>
                    <th>Numero de Personas a atender</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/02-jornadas.php");
                $aten = new Jornadas(1);
                $consulta = $aten->consultarTodosJornadas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {

                    foreach ($consulta as $registros) {
                        if ($registros["gerencia"] == $gerencia || $rol=="Superusuario") {
                ?>
                            <tr>

                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["nombre_parroquia"] ?></td>
                                <td><?php echo $registros["numero_personas"] ?></td>
                                <td><a href="02-AsignarJornada.php?id=<?php echo $registros["id"] ?>">Ver jornada</a></td>
                                <?php if ($rol == "Superusuario") { ?>
                                    <td><a onClick="eliminar(<?php echo $registros["id"] ?>)" class="eliminar">Eliminar Reg</a></td>
                                <?php }else{
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

</div>

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
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
                    url: "eliminar/jornadas.php",
                    data: {
                        id: id


                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': 'Se asigno asistencia correctamente',
                            'confirmButton': 'btn btn-success'
                        }).then(function() {
                            window.location = "02-jornadas.php";
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

    $(function() {

        $("#registro").click(function(e) {


            var valid = this.form.checkValidity();
            if (valid) {



                /* Detalles personales */
                var estado = $('#estado option:selected').text();
                var municipio = $('#municipio option:selected').text();
                var parroquia = $('#parroquia option:selected').text();
                var personas_atender = $("#personas_atender").val();




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
                        '<b>N° de Personas: ' + personas_atender + '</b>',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {

                        var estado = $("#estado").val()
                        var gerencia = <?php echo $gerencia_json; ?>;
                        var municipio = $("#municipio").val()
                        var parroquia = $("#parroquia").val()
                        var personas_atender = $("#personas_atender").val()

                        console.log(estado, municipio, parroquia, personas_atender, gerencia);
                        asignarAtencion();
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientojornada.php",
                            data: {
                                estado: estado,
                                municipio: municipio,
                                parroquia: parroquia,
                                personas_atender: personas_atender,
                                gerencia: gerencia



                            },
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Jornanda creada"
                                }).then(function() {
                                    window.location = "02-jornadas.php";
                                })

                                if (!data) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "No se pudo registrar la jornada, verifique datos"
                                    }).then(function() {
                                        window.location = "01-atencionCiu.php";
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
        })
    })
</script>

<?php
include_once("parteabajo.php");
?>