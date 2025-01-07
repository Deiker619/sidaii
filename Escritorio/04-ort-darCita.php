<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y Protesis: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            /* session_start(); */
            include_once("../php/01-02-cita_protesis.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new citas_protesis(1);

            $aten->setid($numero);
            $registro = $aten->consultarCita();
            ?>

            <header>
                Asignar historia medica a <?php echo $registro["nombre"] ?>
            </header>
            <div class="fecha" id="fecha_registro"><?php echo date("Y-m-d");
                                                    $fecha_aten = date("Y-m-d");
                                                    ?>
                <?php

                if ($registro) {
                ?>
                    <form action="" method="post">
                        <div class="form first">
                            <div class="details personal">
                                <span class="title">Historia medica para toma de medidas</span>
                                <div class="fields">

                                    <div class="input-field">
                                        <label>Cedula</label>
                                        <input type="text" required readonly name="cedula" id="cedula" value="<?php echo $registro["cedula"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Nombre</label>
                                        <input type="text" required readonly name="nombre" id="nombre" value="<?php echo $registro["nombre"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Apellido</label>
                                        <input type="text" required readonly name="apellido" id="apellido" value="<?php echo $registro["apellido"] ?>">
                                    </div>


                                    <div class="input-field">
                                        <label>Discapacidad</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $registro["discapacidad"] ?>">
                                    </div>


                                    <div class="input-field">
                                        <label>Fecha de nacimiento</label>
                                        <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["fecha_naci"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Telefono</label>
                                        <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["telefono"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Edad</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["edad"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Sexo</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["sexo"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Estado</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["estado"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Municipio</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["municipio"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Parroquia</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["parroquia"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Codigo de cita</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["id"] ?>">
                                    </div>


                                    <!-- 
                            <div class="input-field">
                                <label>fecha de entrega</label>
                                <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo date("Y-m-d") ?>" >
                            </div>
 -->

                                    <!--     <div class="input-field">
                                    <label>Laboratorio para la cita:</label>
                                    <select name="laboratorio" id="laboratorio" require>
                                        <option value="4-tomedi">Toma de medidas</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <label>Fecha de la cita:</label>
                                    <input type="date" id="fecha_cita" name="fecha_cita" require>
                                </div> -->


                                </div>

                                <div class="details personal">
                                    <span class="title">Datos tecnicos</span>
                                    <div class="fields">


                                        <div class="checkboxes">
                                            <label class="cl-checkbox">
                                                <input checked="protesis" type="radio" name="artificio" value="-protesis" id="protesis">
                                                <span>Artificio: Protesis</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="artificio" value="-ortesis" id="ortesis">
                                                <span>Artificio: Ortesis</span>
                                            </label>

                                        </div>

                                    </div>



                                </div>
                            





                                <div class="details personal">
                                    <span class="title">Fecha para toma de medidas</span>
                                    <div class="fields">


            
                                        <div class="input-field">
                                            <label>Asigna fecha para toma de medidas</label>
                                            <input type="date" required name="fecha_cita" id="fecha_cita">
                                        </div>



                                    </div>

                                </div>

                                <div class="details personal">
                                    <span class="title">Observaciones</span>
                                    <div class="fields">


                                        <div class="input-field" >
                                            <label>Ingrese la observacion</label>
                                            <textarea id="descripcion" id="" cols="40" rows="10"></textarea>

                                        </div>


                                    </div>

                                </div>

                                <button class="nextBtn" name="registro" id="registro">
                                    <span class="btnText">Dar cita</span>
                                    <ion-icon name="send-outline"></ion-icon>
                                </button>


                            </div>
                        </div>


                    <?php

                }
                    ?>

                    </form>


            </div>
        </div>
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>
        <script src="historiaMedica.js"></script>



        <?php
        include_once("parteabajo.php");
        ?>
        <script>
            function redireccionar(a) {

                url = 'reportes/historia_medica.php?codigo_cita=' + a;

                window.open(url, "_blank");
            }

            function redireccionarP(a) {

                url = 'reportes/historia_medica_protesis.php?codigo_cita=' + a;
                window.open(url, "_blank");
            }
        </script>

        <script type="text/javascript">
            $(function() {
                $("#registro").click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {
                        var laboratorio = $("#laboratorio").val();
                        var id = <?php echo json_encode($numero); ?>;
                        var cedula = $("#cedula").val();
                        var fecha_cita = $("#fecha_cita").val();
                        var fecha_aper = <?php echo json_encode($fecha_aten); ?>;
                        var descripcion = $('#descripcion').val();



                        console.log(fecha_aper, fecha_cita, id, artificio)

                        /* if (artificio == "-protesis") {
                            console.log("Artificio: " + artificio + " Nivel de Actividad: " + nivel_actividad + " Lado de amputacion: " + lado_amp +
                                " Nivel de amputacion: " + nivel_ampu + " Solicitud: " + niveles_AMPU + "Forma: " + forma +
                                "Cicatriz: " + Cicatriz + " Piel: " + piel + " Musculatura: " + Musculatura +
                                "Diseño Protesico: " + diseno_pro + " Tipo de rodilla: " + t_rodilla + " Tipo de pie: " + t_pie +
                                " Tipo de Socket: " + t_socket + " Clasificacion de socket: " + c_socket + " Metodo de suspension: " + Meto_suspension)
                        }

                        if (artificio_para_medidas == "ort-super") {
                            console.log("Artificio: " + artificio + "  Artificio para medidas: " + artificio_para_medidas +
                                " Zona afectada: " + lado_afect + " Diseño Ortesico: " + dis_or + " lado afectado: " + or_afect +
                                " Nervio afectado: " + nervio_afect + " Solicitud: " + a)

                            clasificacion = null
                            cmppp = null

                            console.log(cmppp, clasificacion)

                        }
                        if (artificio_para_medidas == "ort-infe") {
                            console.log("Artificio: " + artificio + "  Artificio para medidas: " + artificio_para_medidas + " Solicitud: " +
                                cmppp + " Clasificacion: " + clasificacion)

                            console.log(dis_or, nervio_afect, a)
                        }
 */





                        e.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientoTomaMedidas.php",
                            data: {
                                artificio: artificio,
                                /* artificio_para_medidas: artificio_para_medidas, */
                                /* lado_afect: lado_afect,
                                dis_or: dis_or,
                                or_afect: or_afect,
                                nervio_afect: nervio_afect,
                                a: a,
                                cmppp: cmppp,
                                clasificacion: clasificacion, */
                                cedula: cedula,
                                fecha_cita: fecha_cita,
                                id: id,
                                fecha_aper: fecha_aper,
                                descripcion: descripcion

                                /* Datos de protesis */
                                /* nivel_actividad: nivel_actividad,
                                nivel_ampu: nivel_ampu,
                                lado_amp: lado_amp,
                                niveles_AMPU: niveles_AMPU, */
                                /*        nivel: nivel, */
                                /* forma: forma,
                                Cicatriz: Cicatriz,
                                piel: piel,
                                Musculatura: Musculatura,
                                diseno_pro: diseno_pro,
                                t_rodilla: t_rodilla,
                                t_socket: t_socket,
                                t_pie: t_pie,
                                c_socket: c_socket,
                                Meto_suspension: Meto_suspension */
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Cita dada para el ' + fecha_cita,
                                    'text': data,
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {

                                    window.location.href = "04-ortesisyProtesis.php"


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