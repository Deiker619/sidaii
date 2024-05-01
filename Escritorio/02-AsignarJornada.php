<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Inscripción de personas: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            include_once("../php/02-jornadas.php");
            $numero = $_REQUEST["id"];
            $aten = new Jornadas(1);

            $aten->setid($numero);
            $registro = $aten->consultarJornadas();
            ?>

            <header>
                <?php echo "Numero de id de la Jornada: " . $numero?>
            </header>
            <?php

            if ($registro) {
                $personas_registrar = $registro["numero_personas"];
                $arreglo = array($personas_registrar);

            ?>

                <form action="" method="post" class="dos">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Estado</label>
                                    <input type="text" placeholder="Ingresa el nombre " style="background-color: #1AA83E; color: white;" required readonly value="<?php echo $registro["nombre_estado"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Municipio</label>
                                    <input type="text" placeholder="Ingresa el nombre " style="background-color: #1AA83E; color: white;" required readonly value="<?php echo $registro["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Parroquia</label>
                                    <input type="text" placeholder="Ingresa el nombre " style="background-color: #1AA83E; color: white;" required readonly value="<?php echo $registro["nombre_parroquia"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Numero de personas a atender</label>
                                    <input type="text" placeholder="Ingresa el nombre " style="background-color: #1AA83E; color: white;" required readonly value="<?php echo $registro["numero_personas"] ?>">
                                </div>

                            </div>

                        </div>
                    </div>


                    <?php
                    include_once("../php/02-personasJornadas.php");
                    $persona = new personasJornadas(1);
                    $persona->setnumero_jornada($numero);
                    $consult = $persona->consultarTodosPersonasJornadas();
                    $cantidadRegistros = count($consult);


                    /* $jor = new Jornadas(1);
                   $jor ->setnumero_personas($registro["numero_personas"]);
                   $consults = $jor ->contarJornadas(); */

                    if ($cantidadRegistros < $registro["numero_personas"]) {

                    ?>
                        <form action="" method="post" class="dos tres">
                            <div class="form first">
                                <div class="details personal">
                                    <span class="title">Persona nro. <?php echo ++$cantidadRegistros; ?> </span>
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
                                            <label>numero jornada</label>
                                            <input type="number" placeholder="Ingresa el nombre " required name="numero_jornada" id="numero_jornada" readonly value="<?php echo $numero ?>">
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
                                            <label>Ayuda tecnica dada</label>
                                            <select name="tipo_ayuda_tec" id="tipo_ayuda_tec" require>
                                            <option value="S/N">Sin entrega</option>
                                            <option value="1-silla.r">Silla de ruedas estandar</option>
                                            <option value="1.1-S.E16">Silla de rueda ergonomica N16</option>
                                            <option value="1.2-S.E14">Silla de rueda ergonomica N14</option>
                                            <option value="1.1-S.E18">Silla de rueda ergonomica N18</option>
                                            <option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>
                                            <option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>
                                            <option value="2-MuletasS">Muletas talla S</option>
                                            <option value="2-MuletasM">Muletas talla M</option>
                                            <option value="2-MuletasL">Muletas talla L</option>
                                            <option value="-MuletasCa">Muletas canadienses</option>
                                            <option value="3-baston">Baston de apoyo</option>
                                            <option value="4-baston.p">Baston de 4 puntas</option>
                                    
                                            <option value="6-andadera">Andadera</option>
                                            <option value="7-CamaCli">Cama Clinica</option>
                                            <option value="1.6-SRB">Silla de ruedas bariátricas</option>
                                            <option value="1.7-COP">Coche ortopédico pediátrico</option>
                                            <option value="8-Col-Anti">Colchon Antiescara</option>
                                            <option value="9-felula">Felula</option>
                                            
                                            <option value="11-panales">Pañales</option>
                                            <option value="12-Pro-aud">Protesis auditivas</option>
                                            <option value="13-Pro-cad">Protesis de Cadera</option>
                                            <option value="14-Pro-rod">Protesis de rodilla</option>
                                            <option value="15-Pro-den">Protesis Dental</option>



                                            </select>
                                        </div>



                                        
                                    </div>
                                    <button class="nextBtn" name="registro" id="registro">
                                        <span class="btnText">Registrar</span>
                                        <ion-icon name="send-outline"></ion-icon>
                                    </button>

                                </div>
                            </div>
                        </form>





                <?php

                    } else {
                        echo "Ya se hicieron todos los registros de esta jornada ";
                    }
                }
                ?>


                </form>


        </div>

        <div class="tabla-atencion">
            <h2>Atendidos</h2>
            <table id="atencion">
                <thead>
                    <tr>

                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>cedula</th>
                        <th>Discapacidad</th>
                        <th>Ayuda Tecnica dada</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/02-jornadas.php");
                    $aten = new Jornadas(1);
                    $aten->setnumero_jornadas($numero);
                    $consulta = $aten->PersonasJornadas();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["discapacidad"] ?></td>
                                <td><?php echo $registros["ayuda_tecnica"] ?></td>
                                <td><a onclick='eliminar(<?php echo $registros["id"]; ?>)' class="eliminar">Eliminar Reg</a></td>
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

                                console.log(data)
                                if (data.trim() == "2") {
                                    Swal.fire({
                                        'icon': 'success',
                                        'title': 'Asignacion de atencion',
                                        'text': "Ayuda tecnica asignada",
                                    
                                    }).then(function() {
                                        window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
                                    })
                                }
                                if (data.trim() == "1") {
                                    Swal.fire({
                                        'icon': 'error',
                                        'title': 'Asignacion de atencion',
                                        'text': "Ayuda tecnica fallida",
                                        'footer': "No han pasado los 6 meses de la ultima entrega de este tipo"
                                    })
                                }

                                if (data.trim() == "primera") {
                                    Swal.fire({
                                        'icon': 'success',
                                        'title': 'Asignacion de atencion por primera vez',
                                        'text': "Ayuda tecnica entregada",
                                    }).then(function() {
                                        window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
                                    })
                                }
                                if (data.trim() == "Ya") {
                                    Swal.fire({
                                        'icon': 'error',
                                        'title': 'Esta cedula ya esta registrada en esta jornada',
                                        'text': "Ayuda tecnica no entregada",
                                    }).then(function() {
                                        window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
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

                        $.ajax({
                            type: "GET",
                            url: "eliminar/eliminar_personaJornada.php",
                            data: {
                                id: id


                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se elimino correctamente esta atencion',
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {
                                    window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";

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
        </script>


        <?php
        include_once("parteabajo.php");
      /*   window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>"; */
        ?> 