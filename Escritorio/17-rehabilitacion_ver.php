<?php

include_once('partearriba.php');
?>
<?php
include_once("../php2/__rehabilitacion.php");
$aten = new rehabilitacion(1);
$id = $_REQUEST['id'];
$aten->setid($id);
$consulta = $aten->consultarCita();

?>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Aperturar rehabilitacion: <?php echo $rol ?></span>
        </div>
    </div>


    <?php


    if ($consulta) {
    ?>
        <div class="cont-registro">

            <div class="container">
                <header>
                    Aperturar rehabilitación a <?php echo $consulta["nombre"] ?>
                </header>
                <form action="" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">

                                <div class="input-field">
                                    <label>Cedula</label>
                                    <input type="text" required readonly name="cedula" id="cedula" value="<?php echo $consulta["cedula"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Nombre</label>
                                    <input type="text" required readonly name="nombre" id="nombre" value="<?php echo $consulta["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Apellido</label>
                                    <input type="text" required readonly name="apellido" id="apellido" value="<?php echo $consulta["apellido"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Discapacidad</label>
                                    <input type="text" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $consulta["discapacidad"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Codigo de reparacion</label>
                                    <input type="number" required readonly name="idee" id="idee" value="<?php echo $consulta["id"] ?>">
                                </div>




                                <div class="input-field">
                                    <label>Asignar fecha para la 1ra cita de rehabilitacion</label>
                                    <input type="date" required name="fecha_rehabilitacion" id="fecha_rehabilitacion">
                                </div>


                            </div>
                            <div class="details personal">
                                <span class="title">Observaciones</span>
                                <div class="fields">

                                    <div class="input-field" id="art-ort">
                                        <label>Ingrese la observacion</label>
                                        <textarea placeholder="Ingrese una breve descripcion del caso..." name="descripcion" cols="40" rows="10" id="descripcion"></textarea>

                                    </div>


                                </div>

                            </div>


                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText"> Aperturar rehabilitación</span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>


                        </div>
                    </div>


                <?php

            }
                ?>

                </form>
                <script src="../package/dist/sweetalert2.all.js"></script>
                <script src="../package/dist/sweetalert2.all.min.js"></script>

                <script type="text/javascript">
                    $(function() {
                        $("#registro").click(function(e) {
                            var valid = this.form.checkValidity();
                            if (valid) {
                                var tipo = '1'
                                var idee = $("#idee").val();
                                var fecha_rehabilitacion = $("#fecha_rehabilitacion").val();
                                let descripcion = $("#descripcion").val();

                                console.log(idee)
                                console.log(fecha_rehabilitacion, descripcion)


                                e.preventDefault();
                                $.ajax({
                                    type: "POST",
                                    url: "../php2/__procesamientorehabilitacion.php",
                                    data: {
                                        tipo: tipo,
                                        idee: idee,
                                        fecha_rehabilitacion: fecha_rehabilitacion,
                                        descripcion: descripcion
                                    },
                                    success: function(data) {
                                        console.log(data);
                                        Swal.fire({
                                            'icon': 'success',
                                            'title': 'Asignacion de atencion',
                                            'text': 'Se asigno asistencia correctamente',
                                        })/* .then(function() {
                                            window.location = "17-rehabilitacion.php";
                                        }) */
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
                <?php include_once('parteabajo.php'); ?>