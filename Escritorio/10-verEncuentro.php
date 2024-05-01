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
            include_once("../php/05-encuentro.php");
            $numero = $_REQUEST["id"];
            $aten = new encuentro(1);

            $aten->setid($numero);
            $registro = $aten->consultarEncuentro();
            ?>

            <header>
                <?php echo "Codigo del taller: " . $numero ?>

            </header>


            <form action="" method="post">
                <div class="form">
                    <div class="details personal">
                        <span class="title">Detalles del taller</span>
                        <div class="fields">

                            <div class="input-field">
                                <label>Fecha de taller</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly value="<?php echo $registro["fecha_encuentro"] ?>">
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

            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title"> Registrar participantes para el encuentro </span>
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
                                <input type="email" placeholder="Ingresa el email " required name="email" id="email">
                            </div>

                            <div class="input-field">
                                <label>Taller</label>
                                <input type="number" placeholder="Ingresa el nombre " required name="numero_encuentro" id="numero_encuentro" readonly value="<?php echo $numero ?>">
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
                        <th>id</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Edad</th>
                        <th>Nacionalidad</th>
                        <th>Fecha nacimiento</th>
                        <th>Discapacidad</th>
                        <th>Sexo</th>
                        
                    
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/05-participante_encuentro.php");
                    $aten = new participante_encuentro(1);
                    $aten->setencuentro($numero);
                    $consulta = $aten->consultarTodosParticipantes();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["telefono"] ?></td>
                                <td><?php echo $registros["edad"] ?></td>
                                <td><?php echo $registros["nacionalidad"] ?></td>
                                <td><?php echo $registros["fecha_naci"] ?></td>
                                <td><?php echo $registros["nombre_e"] ?></td>
                                <td><?php echo $registros["sexo"] ?></td>
                              
                        
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
                        var telefono = $("#telefono").val();
                        var fecha = $("#fecha_naci").val();
                        var edad = $("#edad").val();
                        var sexo = $("#sexo").val();
                        var nacionalidad = $("#nacionalidad").val();
                        var email = $("#email").val();

                        var parroquia = $("#parroquia").val();
                        var discapacidadE = $("#D-especifica").val();
                        var numero_encuentro = $("#numero_encuentro").val();
                        var discapacidad = $("#discapacidad").val();

                        console.log(cedula, nombre, apellido, telefono, fecha, edad, sexo, nacionalidad, email, parroquia, discapacidadE, numero_encuentro, discapacidad)

                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientoParticipanteEncuentro.php",

                            data: {
                                cedula: cedula,
                                nombre: nombre,
                                apellido: apellido,
                                telefono: telefono,
                                fecha: fecha,
                                edad: edad,
                                sexo: sexo,
                                nacionalidad: nacionalidad,
                                email: email,
                                parroquia: parroquia,
                                discapacidadE: discapacidadE,
                                numero_encuentro: numero_encuentro,
                                discapacidad: discapacidad
                            },

                            success: function(data) {
                                console.log(data);

                                if (data.trim() == "2") {
                                    Swal.fire({
                                        'icon': 'error',
                                        'title': 'Ya ' + nombre + ' esta registrado',
                                        'text': 'Ya se encuentra registrado como participante',

                                    }).then(function() {
                                        window.location = "10-verEncuentro.php?id=<?php echo $numero ?>";

                                    })
                                };
                                if (data.trim() == "1") {
                                    Swal.fire({
                                        'icon': 'success',
                                        'title': 'Se registró a ' + nombre + ' exitosamente',
                                        'text': 'Participante registrado',

                                    }).then(function() {
                                        window.location = "10-verEncuentro.php?id=<?php echo $numero ?>";

                                    })
                                };

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