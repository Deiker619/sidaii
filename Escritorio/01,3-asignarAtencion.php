<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <div class="registrador" style="display: hidde;">
                <?php

                if (isset($_SESSION['cedula'])) {  // Si el usuario inicio sesion correctamente
                    $cedulauser = $_SESSION['cedula'];
                    $NombreUsuarioActivo = $_SESSION['nombre'];
                    $gerencia = $_SESSION["gerencia"];
                }


                ?>

              

            </div>

            <?php
            /* session_start(); */
            include_once("../php/01-atenciones.php");



            $numero = $_REQUEST["numero_aten"];
           
            $aten = new Atenciones(1);

            $aten->setnumero_aten($numero);
            $registro = $aten->consultarAtenciones();
            ?>

            <header>
                Asignacion de tipo asistencia
            </header>
            <?php

            if ($registro) {
            ?>
                <form action="" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Cedula</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $registro["cedula"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $registro["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido" value="<?php echo $registro["apellido"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>estado</label>
                                    <input type="text" placeholder="Ingresa tu Cedula" required readonly name="estado" id="estado" value="<?php echo $registro["estado"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Discapacidad</label>
                                    <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $registro["discapacidad"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Numero Atencion</label>
                                    <input type="number" required readonly name="numero_aten" id="numero_aten" value="<?php echo $registro["numero_aten"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Atencion Solicitada</label>
                                    <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["atencion_solicitada"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>fecha</label>
                                    <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo date("Y-m-d") ?>">
                                </div>


                                <div class="checkboxes">
                                    <label class="cl-checkbox">
                                        <input checked="" type="radio" name="atencion_especial" value="-remitido" id="remitir">
                                        <span>Remitir</span>
                                    </label>

                                    <label class="cl-checkbox">
                                        <input type="radio" name="atencion_especial" value="-orientado" id="orientar">
                                        <span>Orientar</span>
                                    </label>
                                    <label class="cl-checkbox">
                                        <input type="radio" name="atencion_especial" value="-ayudatec" id="entrega">
                                        <span>Entregar ayuda tecnica</span>
                                    </label>
                                </div>





                            </div>

                            <div class="details personal" id="entrega_tecnica">
                                <span class="title">Entrega</span>
                                <div class="fields">


                                    <div class="input-field">
                                        <label>Tipo de ayuda tecnica a ortorgar:</label>
                                        <select name="atencion_recibida" id="atencion_recibida" require>
                                            <option></option>
                                            <!--  <option value="1-silla.r">Silla de ruedas estandar</option>
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
                                            <option value="15-Pro-den">Protesis Dental</option> -->
                                            <option value="1-silla.r">Silla de ruedas estandar</option>
                                            <option value="1.1-S.E16">Silla de rueda ergonomica N16</option>
                                            <option value="1.2-S.E14">Silla de rueda ergonomica N14</option>
                                            <option value="1.3-S.E18">Silla de rueda ergonomica N18</option>
                                            <option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>
                                            <option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>
                                            <option value="1.6-SRB">Silla de rueda bariátricas</option>
                                            <option value="21-sllm">Silla a motor</option>
                                            <option value="27-Sllc">Silla de rueda clinica</option>
                                            <option value="30-sllsr">Silla sanitaria sin ruedas</option>
                                            <option value="31-sllsr">Silla sanitaria con ruedas</option>
                                            <option value="2-MuletasS">Muletas talla S</option>
                                            <option value="2-MuletasM">Muletas talla M</option>
                                            <option value="2-MuletasL">Muletas talla L</option>
                                            <option value="-MuletasCa">Muletas canadienses adultos</option>
                                            <option value="12-Mucp">Muletas canadienses pediatricas</option>
                                            <option value="20-Rglp">Regleta con punzon</option>
                                            <option value="6-andadera">Andadera adulto fija</option>
                                            <option value="22-Apm">Andadera pediatrica multifuncional</option>
                                            <option value="23-Apr">Andadera pediatrica con ruedas</option>
                                            <option value="25-Anpp">Andadera pediatrica posterior</option>
                                            <option value="26-Anpf">Andadera pediatrica fija</option>
                                            <option value="7-CamaCli">Cama Clinica</option>
                                            <option value="8-Col-Anti">Colchon Antiescara</option>
                                            <option value="1.6-SRB">Silla de ruedas bariátricas</option>
                                            <option value="1.7-COP">Coche ortopédico pediátrico</option>
                                            <option value="28-chorm">Coche ortopedico mediano</option>
                                            <option value="29-chorg">Coche ortopedico grande</option>
                                            <option value="9-felula">Ferula</option>
                                            <option value="8-Grab">Grabadora</option>
                                            <option value="11-panales">Pañales</option>
                                            <option value="12-Pro-aud">Protesis auditivas</option>
                                            <option value="13-Pro-cad">Protesis de Cadera</option>
                                            <option value="14-Pro-rod">Protesis de rodilla</option>
                                            <option value="15-Pro-den">Protesis Dental</option>
                                            <option value="11-Coj">Cojin antiescaras</option>
                                            <option value="3-baston">Baston de apoyo</option>
                                            <option value="4-baston.p">Baston de 4 puntas</option>
                                            <option value="21-Btrpd">Baston de rastreo pediatricos</option>
                                            <option value="13-Brpl34">Baston de rastreo plegable numero 34</option>
                                            <option value="14-Brpl36">Baston de rastreo plegable numero 36</option>
                                            <option value="15-Brpl38">Baston de rastreo plegable numero 38</option>
                                            <option value="15-Brpl44">Baston de rastreo plegable numero 44</option>
                                            <option value="16-Brpl46">Baston de rastreo plegable numero 46</option>
                                            <option value="-bastonRas">Baston de rastreo plegable numero 48</option>
                                            <option value="18-Brpl50">Baston de rastreo plegable numero 50</option>
                                            <option value="19-Brpl52">Baston de rastreo plegable numero 52</option>

                                        </select>
                                    </div>


                                </div>
                            </div>

                            <div class="details personal" id="entrega_remitir">
                                <span class="title">Remitir</span>
                                <div class="fields">



                                    <div class="input-field">
                                        <label>Remitir a:</label>
                                        <select name="remit" id="remit">
                                            <option></option>
                                            <option value="5Logi">Gestion logistica y infrastructura</option>
                                            <option value="3Gtnd">Gestion y desarrollo social</option>
                                            <option value="4Gtno">Gestion operativa estadal</option>

                                        </select>

                                    </div>

                                    <div class="input-field" id="coordinacion_div">
                                        <label>Coordinacion estadal</label>
                                        <select name="coordinacion" id="coordinacion">
                                            <option value="" selected></option>
                                            <?php include_once("../php/10-coordinaciones-estadales.php");
                                            $dis = new Coordinacion(1);

                                            $consulta = $dis->consultarCoordinaciones();

                                            foreach ($consulta as $registros) {
                                            ?>
                                                <option value="<?php echo $registros["id"] ?>"><?php echo $registros["nombre_coordinacion"] ?></option>

                                            <?php } ?>
                                        </select>
                                    </div>



                                    <div class="input-field">
                                        <label>Motivo:</label>
                                        <input type="text" name="motivo" id="motivo">
                                    </div>




                                </div>
                            </div>

                            <div class="details personal" id="entrega_orientado">
                                <span class="title">Orientar</span>
                                <div class="fields">



                                    <div class="input-field">
                                        <label>Descripcion de la orientacion:</label>
                                        <input type="text" name="descrip_orientacion" id="descrip_orientacion">
                                    </div>




                                </div>
                            </div>








                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Asignar atencion</span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>


                        </div>
                    </div>


                <?php

            }
                ?>

                </form>


        </div>
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">
            function redireccionar(a) {

                url = 'reportes/reporteAtencion.php?numero_aten=' + a;

                window.open(url, "_blank");
            }
            $(function() {
                var coordinacions = null

                $("#coordinacion_div").hide();
                mostrarCoordinacion();


                $("#remit").change(function() {
                    mostrarCoordinacion();


                });

                $("#coordinacion").change(function() {

                });

                function tomarvalor() {
                    $("select[name='coordinacion']").change(function() {

                        coordinacions = this.value
                        console.log(coordinacions)
                    })
                }


                function mostrarCoordinacion() {
                    if ($("#remit").val() == "4Gtno") {
                        $("#coordinacion_div").show();
                        tomarvalor()


                    } else {
                        $("#coordinacion_div").hide();
                        coordinacions = null;
                        console.log(coordinacions)


                    }
                }

            })




            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {

                    var gerencia = $("#gerencia").text().trim();

                    var registrador = <?php echo json_encode($cedulauser) ?>;
                    var cedula = $("#cedula").val();
                    var nombre = $("#nombre").val();
                    var apellido = $("#apellido").val();
                    var estado = $("#estado").val();
                    var discapacidad = $("#discapacidad").val();
                    var numero_aten = $("#numero_aten").val();
                    var fecha_aten = $("#fecha_aten").val();

                    /*       console.log(fecha_aten);
                          console.log(cedula);
                          console.log(gerencia); */


                    /* entrega */
                    var entrega = $("#entrega").val();
                    var atencion_recibida = $("#atencion_recibida").val();
                    var atencion_solicitada = $("#atencion_solicitada").val();
                    /*  console.log(atencion_recibida) */

                    /* remitir */
                    var remitir = $("#remitir").val();
                    var remit = $("#remit").val();
                    var motivo = $("#motivo").val();

                    /*    console.log(remit)
                       console.log(remitir) */

                    /* orientado */

                    var descrip_orientacion = $("#descrip_orientacion").val();
                    var orientar = $("#orientar").val();

                    coordinacions = $("select[name='coordinacion']").val()
                    console.log(coordinacions);

                    /* console.log(remit) */


                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "01,4-atencionAsignada.php",
                        data: {
                            cedula: cedula,
                            nombre: nombre,
                            coordinacions: coordinacions,
                            apellido: apellido,
                            estado: estado,
                            discapacidad: discapacidad,
                            numero_aten: numero_aten,
                            fecha_aten: fecha_aten,

                            /* ayuda tecnica */
                            atencion_recibida: atencion_recibida,
                            atencion_solicitada: atencion_solicitada,
                            entrega: entrega,

                            /* remitir */
                            remitir: remitir,
                            remit: remit,
                            motivo: motivo,

                            /* descrip_orientacion */
                            descrip_orientacion: descrip_orientacion,
                            orientar: orientar,

                            /* otros */
                            registrador: registrador,
                            gerencia: gerencia




                        },
                        success: function(data) {



                            console.log(data);

                            if (data.mensaje == "entregado") {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': "Ayuda tecnica asignada",
                                    'html': '<b>Ultima fecha que recibio esta ayuda:</b> ' + data.fechaU + "<br>" +
                                        '<b>Fecha Actual:</b> ' + data.fechaA + "<br>" +
                                        '<b>Dias de diferencia: </b>' + data.difer,
                                }).then(function() {
                                    window.location = "01,2-atenciones.php";
                                })
                            }
                            if (data.mensaje == "Noentregado") {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Asignacion de atencion',
                                    'text': "Ayuda tecnica fallida",
                                    'html': '<b>Ultima fecha que recibio esta ayuda:</b> ' + data.fechaU + "<br>" +
                                        '<b>Fecha Actual:</b> ' + data.fechaA + "<br>" +
                                        '<b>Dias de diferencia: </b>' + data.difer,
                                    'footer': "No han pasado los 6 meses de la ultima entrega de este tipo"
                                })
                            }

                            if (data.trim() == "primera") {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion por primera vez',
                                    'text': "Ayuda tecnica entregada",
                                }).then(function() {
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

                                            window.location.href = "01,2-atenciones.php"
                                        }
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: '¿Desea descargar PDF?',

                                        html: '<button onclick="redireccionar(<?php echo $numero ?>)" class="buttonDownload">Download</button>'
                                    });
                                })

                            }
                            if (data == "Remitido") {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion: Remitido',
                                    'text': "Remitido exitosamente",
                                }).then(function() {
                                    window.location = "01,2-atenciones.php";
                                })
                            }
                            if (data.trim() == "Orientado") {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion: Orientado',
                                    'text': "Orientado exitosamente",
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


                }
            })
        </script>


        <?php
        include_once("parteabajo.php");
        ?>