<?php
include_once("partearriba.php");
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> <?php echo $rol; ?></span>
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

                            <hr>

                            <div class="input-field">
                                <label>Motivo de rechazo</label>
                                <input type="text" placeholder="Ingresa el motivo de rechazo" required name="motivo" id="motivo">
                            </div>



                        </div>



                        <button class="nextBtn rechazar" name="registro" id="registro">
                            <span class="btnText">Rechazar</span>
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
                    e.preventDefault();
                    var cedulauser = <?php echo json_encode($cedulauser); ?>;

                    var status = "Rechazado";
                    var cedula = $("#cedula").val();
                    var motivo = $("#motivo").val();
                    console.log(motivo);




                    $.ajax({
                        type: "POST",
                        url: "--cargar_aceptado_infraestructura.php",
                        data: {
                            motivo: motivo,
                            status: status,
                            cedula: cedula


                        },
                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se asigno asistencia correctamente',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                window.location = "01-remitidos_a.php";
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