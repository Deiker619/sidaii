<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Desarrollo social: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            include_once("../php/04-taller.php");
            $numero = $_REQUEST["id"];
            $aten = new taller(1);

            $aten->setid($numero);
            $registro = $aten->consultarTaller();
            ?>

            <header>
                <?php echo "Codigo del taller: " . $numero ?>

            </header>


            <form action="" method="post" class="dos">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles del taller</span>
                        <div class="fields">

                            <div class="input-field">
                                <label>Fecha de taller</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["fecha_taller"] ?>">
                            </div>


                            <div class="input-field">
                                <label>Estado</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["nombre_estado"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Municipio</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["nombre"] ?>">
                            </div>
                            <div class="input-field">
                                <label>Parroquia</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["nombre_parroquia"] ?>">
                            </div>

                            <div class="input-field">
                                <label>actividad</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["actividad"] ?>">
                            </div>
                         

                        </div>

                    </div>
                </div>


            </form>



        </div>

        <div class="container" style="border-color: #1AA83E; margin-top: 20px">

            <form action="" method="post" class="dos tres">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> Registrar participantes para el taller </span>
                        <div class="fields">

                                <div class="input-field" >
                                    <label>Fecha de hoy</label>
                                    <input type="text" required readonly name="fecha_asig" id="fecha_asig" value="<?php echo date("Y-m-d") ?>">
                                </div>

                            <div class="input-field">
                                <label>Cedula</label>
                                <input type="number" placeholder="Ingresa la cedula " required name="cedula" id="cedula">
                            </div>

                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" placeholder="Ingresa el nombre " required name="nombre" id="nombre">
                            </div>


                            <div class="input-field">
                                <label>Apellido</label>
                                <input type="text" placeholder="Ingresa el apellido " required name="apellido" id="apellido">
                            </div>

                            <div class="input-field">
                                <label>Telefono</label>
                                <input type="number" placeholder="Ingresa el apellido " required name="telefono" id="telefono">
                            </div>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa el apellido " required name="email" id="email">
                            </div>

                            <div class="input-field">
                                <label>Codigo de taller</label>
                                <input type="number" placeholder="Ingresa el nombre " required name="numero_escuela" id="numero_escuela" readonly value="<?php echo $numero ?>">
                            </div>

                            <div class="input-field">
                                    <label>Discapacidad</label>
                                    <select name="discapacidad" id="discapacidad" require>

                                        <?php
                                        include_once("../php/01-discapacidades.php");
                                        $discapacidad = new Discapacidad(1);

                                        $consulta = $discapacidad->consultarDiscapacidades();

                                        foreach ($consulta as $i) {
                                            echo '<option value=' . $i["id_disca"] . '>' . $i["nombre_discapacidad"] . '</option>';
                                        }


                                        ?>
                                    </select>
                                </div>
                                <div class="input-field" id="discapacidadE">

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

                           

                        </div>
                        <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Registrar</span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>

                    </div>
                </div>
            </form>


        </div>


    </div>
    <div class="tabla-atencion">
        <h2>Participantes</h2>
        <table>
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>cedula</th>
                    <th>fecha recibido</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/04-participante_taller.php");
                $aten = new participante_taller(1);
                $aten->settaller($numero);
                $consulta = $aten->consultarTodosParticipantes();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["id"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["fecha_recibido"] ?></td>
                            <td><a href="" class="eliminar">Eliminar Reg</a></td>
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

    <script type="text/javascript">
        $(function() {
            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var cedula = $("#cedula").val();
                    var nombre = $("#nombre").val();
                    var apellido = $("#apellido").val();
                    var numero_jornada = $("#numero_jornada").val();
                    var discapacidad = $("#D-especifica").val();
                    var tipo_ayuda_tec = $("#tipo_ayuda_tec").val();

                    e.preventDefault();
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