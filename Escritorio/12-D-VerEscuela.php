<?php
include_once("partearriba.php");
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


    <div class="cont-registro">

        <div class="container">

            <?php
            include_once("../php/7-escuela-comunitaria.php");
            $numero = $_REQUEST["id"];
            $aten = new escuela(1);

            $aten->setid($numero);
            $registro = $aten->consultarescuela();
            ?>

            <header>
                <?php echo "Codigo de taller: " . $numero ?>

            </header>


            <form action="" method="post">
                <div class="reportes-totales" style="display: block; margin: 0">

                    <!-- reportes 1 -->
                    <div class="reporte">

                        <?php
                        include_once("../php/7-escuela-comunitaria.php");
                        $numero = $_REQUEST["id"];

                        ?>
                        <a href="12-D-Modulos.php?id=<?php echo $numero ?>">Ver o agregar Modulos</a>
                    </div>

                </div>
                <a href=""></a>
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles del taller</span>
                        <div class="fields">

                            <div class="input-field">
                                <label>Fecha de inicio</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["fecha_inicio"] ?>">
                            </div>


                            <div class="input-field">
                                <label>Fecha de final</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["fecha_final"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Comunidad</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["comunidad"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Tema</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["Tema"] ?>">
                            </div>

                            <div class="input-field">
                                <label>estado</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["estado"] ?>">
                            </div>
                            <div class="input-field">
                                <label>municipio</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["municipio"] ?>">
                            </div>
                            <div class="input-field">
                                <label>parroquia</label>
                                <input type="text" placeholder="Ingresa el nombre" required readonly value="<?php echo $registro["parroquia"] ?>">
                            </div>

                        </div>

                    </div>
                </div>


            </form>





        </div>


        <div class="container" style="border-color: #1AA83E; margin-top: 20px">

            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> Registrar participantes para el taller </span>
                        <div class="fields">

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
                                <input type="number" placeholder="Ingresa el telefono " required name="telefono" id="telefono">
                            </div>
                            <div class="input-field">
                                <label>Fecha de nacimiento</label>
                                <input type="date" placeholder="Ingresa fecha de nacimiento" required id="fecha_naci" name="fecha_naci">
                            </div>


                            <div class="input-field">
                                <label>Edad</label>
                                <input type="number" readonly placeholder="Ingresa tu edad" required id="edad" name="edad">
                            </div>
                            <div class="input-field">
                                <label>Sexo</label>
                                <select name="sexo" id="sexo" require>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Nacionalidad</label>
                                <select name="nacionalidad" id="nacionalidad">
                                    <option value="V">Venezolano</option>
                                    <option value="E">Extranjero</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa el apellido " required name="email" id="email">
                            </div>

                            <div class="input-field">
                                <label>Taller</label>
                                <input type="number" placeholder="Ingresa el nombre " required name="numero_escuela" id="numero_escuela" readonly value="<?php echo $numero ?>">
                            </div>

                            <div class="input-field">
                                    <label>Tipo de discapacidad</label>
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







        <div class="tabla-atencion">
            <h2>Participantes</h2>
            <table id="atencion">
                <thead>
                    <tr>
                       
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Parroquia</th>
                     <!--    <th></th> -->
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/participante_escuela.php");
                    $aten = new participante_escuela(1);
                    $aten->setid_curso($numero);
                    $consulta = $aten->consultarTodosParticipantes();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["telefono"] ?></td>
                                <td><?php echo $registros["email"] ?></td>
                            
                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre_municipio"] ?></td>
                                <td><?php echo $registros["nombre_parroquia"] ?></td>
                                <!-- <td><a href="" class="eliminar">Eliminar Reg</a></td> -->
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
                        var telefono = $("#telefono").val();
                        var email = $("#email").val();
                        var numero_escuela = $("#numero_escuela").val();
                        var discapacidad = $("#discapacidad").val();
                        var estado = $("#estado").val();
                        var municipio = $("#municipio").val();
                        var parroquia = $("#parroquia").val();
                        var fecha_naci = $("#fecha_naci").val();
                        var edad = $("#edad").val();
                        var sexo = $("#sexo").val();
                        var nacionalidad = $("#nacionalidad").val()

                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "12-D-registroParticipante.php",

                            data: {
                                cedula: cedula,
                                nombre: nombre,
                                apellido: apellido,
                                telefono: telefono,
                                email: email,
                                numero_escuela: numero_escuela,
                                discapacidad: discapacidad,
                                estado: estado,
                                municipio: municipio,
                                parroquia: parroquia,
                                edad: edad, 
                                sexo: sexo,
                                fecha_naci: fecha_naci, 
                                nacionalidad: nacionalidad
                            },

                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Registro exitoso el participante',
                                    'text': data,

                                }).then(function() {
                                    window.location = "12-D-VerEscuela.php?id=<?php echo $numero ?>";
                                    /*  $("#cedula").attr("readonly","readonly");
                                     $("#nombre").attr("readonly","readonly");
                                     $("#apellido").attr("readonly","readonly");
                                     $("#numero_jornada").attr("readonly","readonly");
                                     $("#discapacidad").attr("readonly","readonly");
                                     $("#tipo_ayuda_tec").attr("readonly","readonly");
                                     */

                                })
                                if (data == 2) {
                                    Swal.fire({
                                    'icon': 'error',
                                    'title': 'No se pudo realizar la operación',
                                    'text': "La persona ya esta registrada en el taller",

                                }).then(function() {
                                    window.location = "12-D-VerEscuela.php?id=<?php echo $numero ?>";
                                    /*  $("#cedula").attr("readonly","readonly");
                                     $("#nombre").attr("readonly","readonly");
                                     $("#apellido").attr("readonly","readonly");
                                     $("#numero_jornada").attr("readonly","readonly");
                                     $("#discapacidad").attr("readonly","readonly");
                                     $("#tipo_ayuda_tec").attr("readonly","readonly");
                                     */

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
                })
            })
        </script>
        <?php
        include_once("parteabajo.php");
        ?>