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
            <span class="link-name">Desarrollo social: <?php echo $rol ?></span>
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
        </div> -->
    </button></a>
    
    <div class="cont-registro">

        <div class="container">

            <header>
                Crear nuevo taller
            </header>

            <form action="" method="post" >
                <div class="form">

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
                                <label>Comunidad</label>
                                <input type="text" id="comunidad" name="comunidad">
                            </div>

                            <div class="input-field dos">
                                <label>Fecha de inicio de actividad</label>
                                <input type="date" id="fecha_encuentro" name="fecha_encuentro">
                            </div>

                            <div class="input-field dos">
                                <label>Fecha de fin de actividad</label>
                                <input type="date" id="fin_encuentro" name="fin_encuentro">
                            </div>

                            <div class="input-field dos">
                                <label>Nombre del taller</label>
                                <input type="text" id="curso" name="curso">
                            </div>



                        </div>




                    </div>




                </div>

                <button class="nextBtn" name="registro" id="registro">
                    <span class="btnText">Crear nuevo taller</span>
                    <ion-icon name="send-outline"></ion-icon>
                </button>

            </form>
        </div>
    </div>
    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
        <h2>Talleres creados:
            <?php
            include_once("../php/7-escuela-comunitaria.php");
            $esc = new escuela(1);
            $contar = $esc->consultarTodasEscuelas();
            echo count($contar);

            ?>
        </h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>fecha inicio</th>
                    <th>fecha final</th>
                    <th>Tema</th>
                    <th>comunidad</th>
                    <th>estado</th>
                    <th>municipio</th>
                    <th>parroquia</th>
                    <th></th>
                    <!-- <th></th> -->
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/7-escuela-comunitaria.php");
                $aten = new escuela(1);
                $consulta = $aten->consultarTodasEscuelas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["id_curso"] ?></td>
                            <td><?php echo $registros["fecha_inicio"] ?></td>
                            <td><?php echo $registros["fecha_final"] ?></td>
                            <td><?php echo $registros["Tema"] ?></td>
                            <td><?php echo $registros["comunidad"] ?></td>
                            <td><?php echo $registros["nombre_estado"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["nombre_parroquia"] ?></td>
                            <td><a href="12-D-VerEscuela.php?id=<?php echo $registros["id_curso"] ?>">Ver taller</a></td>
<!--                             <td><a href="ModificarJornada/modificarBeneficiario.php?id=30165406" class="eliminar">Eliminar Reg</a></td>
 -->                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {
            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var estado = $("#estado").val();
                    var gerencia = <?php echo $gerencia_json; ?>;
                    var municipio = $("#municipio").val();
                    var parroquia = $("#parroquia").val();
                    var comunidad = $("#comunidad").val();
                    var fecha_encuentro = $("#fecha_encuentro").val();
                    var fin_encuentro = $("#fin_encuentro").val();
                    var curso = $("#curso").val();

                    console.log(estado, municipio, parroquia, comunidad, fecha_encuentro, fin_encuentro, curso)


                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "../php/procesamientoescuela.php",
                        data: {
                            estado: estado,
                            municipio: municipio,
                            parroquia: parroquia,
                            comunidad: comunidad,
                            fecha_encuentro: fecha_encuentro,
                            fin_encuentro: fin_encuentro,
                            curso: curso, 
                            gerencia: gerencia
                        },

                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Taller creado exitosamente',
                                'text': data,

                            }).then(function() {
                                window.location = "12-D-escuela-comunitaria.php";
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
                                'text': 'Ocurrió un error en la creación del nuevo taller'
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