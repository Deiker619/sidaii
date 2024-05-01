<?php
include_once("partearriba.php");
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> <?php echo $rol ;?></span>
        </div>
    </div>


    <div class="cont-registro">

        <?php


        $id = $_REQUEST["id"];

        include_once("../php/6-remitir.php");
        $aten = new remitido(1);
        $aten->setid($id);
        $consulta = $aten->consultarRemitidosInfraestructura();
        $cantidadRegistros = count($consulta);


        ?>

        <div class="container">
            <header>

            </header>

            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles Personales</span>
                        <div class="fields">


                            <div class="input-field">
                                <label>Cedula</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $consulta["cedula"]; ?>">
                            </div>

                            <div class="input-field">
                                <label>Nombre:</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $consulta["nombre"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Apellido:</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido" value="<?php echo $consulta["apellido"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Nombre del remitente:</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="por" id="por" value="<?php echo $consulta["por"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Nombre de la gerencia remitente:</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="gerencia_remitente" id="gerencia_remitente" value="<?php echo $consulta["gerencia_remitente"] ?>">
                            </div>


                            <div class="input-field">
                                <label>Fecha</label>
                                <input type="text" placeholder="Ingresa tu correo electronico" required readonly name="fecha" id="fecha" value="<?php echo $consulta["fecha"] ?>">
                            </div>

                            <div class="input-field">
                                <label>Motivo</label>
                                <textarea readonly value=""><?php echo $consulta["motivo"] ?></textarea>
                            </div>




                                    <div class="input-field">
                                        <label>Asignar al area de</label>
                                        <select name="atencion" id="atencion" require>
                                            <?php if ($gerencia == "2Atc" || $gerencia == "4Gtno" || $rol == "Superusuario") { ?>
                                                <option value="1-oac">Atencion a traves de OAC</option>
                                                <option value="2-ayudte">Entrega Ayuda Tecnica</option>
                                                <option value="0-aten-coo">Atencion a traves de coordinacion estadal</option>
                                            <?php } ?>
                                            <?php if ($gerencia == "5Logi" || $rol == "Superusuario") { ?>
                                                <option value="3-orypro">Cita laboratorio ortesis y protesis</option>
                                                <!-- <option value="4-tomedi">Toma Medidas</option>
                                            <option value="5-pruebar">Prueba artifcio</option> -->
                                                <option value="6-repaart">Reparacion Artificio</option>
                                                <option value="7-audiom">Audiometria</option>
                                            <?php } ?>

                                            <!--   <option value="8-calibr">Calibracion de Protesis Auditivas</option>
                                          estamos esperando tipos de protesis auditivas para agregar a la base
                                            <option value="9-soliproa">Solicitud de protesis auditivas</option> -->
                                            <?php if ($gerencia == "3Gtnd" || $rol == "Superusuario") { ?>
                                                <option value="10-partic">Participante de taller</option>
                                                <option value="11-partic">Participante de encuentro</option>
                                            <?php } ?>





                                        </select>
                                    </div>


                        </div>



                        <button class="nextBtn" name="registro" id="registro">
                            <span class="btnText">Enviar</span>
                            <ion-icon name="send-outline"></ion-icon>
                        </button>


                    </div>
                </div>




            </form>


        </div>

    </div>
    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script type="text/javascript">
        $(function() {




            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var cedulauser = <?php echo json_encode($cedulauser); ?>;

                    var status = "Aceptado";
                    var cedula = $("#cedula").val();


                    Swal.fire({
                        title: 'Esta seguro/a que desea enviar estos archivos?',
                        showDenyButton: true,
                        showCancelButton: true,
                        confirmButtonText: 'Enviar',
                        denyButtonText: `Don't save`,
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                           
                            var cedula = $("#cedula").val();
                            var atencion = $("#atencion").val();


                            $.ajax({
                                type: "POST",
                                url: "../php/procesamientodebeneficiario.php",
                                data: {
                                    cedula: cedula,
                                    atencion: atencion,
                                    cedulauser: cedulauser


                                },
                                success: function(data) {
                                    Swal.fire({
                                        'icon': 'success',
                                        'title': 'Asignacion de atencion',
                                        'text': 'Se asigno asistencia correctamente',
                                        'confirmButton': 'btn btn-success'
                                    }).then(function() {
                                        window.location = "04-ort-remitidos.php";
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
                            Swal.fire('Changes are not saved', '', 'info')
                        }
                    })



                    e.preventDefault();

                    $.ajax({
                        type: "POST",
                        url: "--cargar_aceptado_infraestructura.php",
                        data: {

                            status: status,
                            cedula: cedula


                        },
                        success: function(data) {
                            console.log(data);
                        }

                    })


                }
            })
        })
    </script>


    <?php
    include_once("parteabajo.php");
    ?>