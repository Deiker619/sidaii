<?php

include_once('partearriba.php');
?>
<?php
include_once("../php2/__rehabilitacion.php");
$aten = new rehabilitacion(1);
$id = $_REQUEST['id'];

$aten->setid($id);
$consulta = $aten->consultarControl();

?>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Proceso activo:<?php echo $id ?></span>
        </div>
    </div>



    <?php


    if ($consulta) {
    ?>
        <div class="cont-registro">

            <div class="container">

                <form action="" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">

                                <div class="input-field">
                                    <label>Codigo de rehabilitacion</label>
                                    <input type="number" required readonly name="id" id="id" value="<?php echo $consulta["rehabilitacion"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Codigo de control</label>
                                    <input type="number" required readonly name="idee" id="idee" value="<?php echo $consulta["id"] ?>">
                                </div>


                                <?php if ($consulta['status'] == 'completo') { ?>
                                    <div class="input-field">
                                        <label>Asignar fecha para el siguiente control</label>
                                        <input type="date" readonly name="fecha_rehabilitacion" id="fecha_rehabilitacion" value="<?php echo $consulta['fecha_cita'] ?>">
                                    </div>
                                <?php } else { ?>

                                    <div class="input-field">
                                        <label>Asignar fecha para el siguiente control</label>
                                        <input type="date"  name="fecha_rehabilitacion" id="fecha_rehabilitacion">
                                    </div>



                                <?php } ?>


                               


                            </div>
                            <div class="details personal">
                                <span class="title">Observaciones de este control: <?php echo $consulta['id'] ?></span>
                                <div class="fields">

                                    <div class="input-field" id="art-ort">
                                        <label>Ingrese la observacion de este control</label>
                                        <textarea placeholder="Ingrese una breve descripcion del caso..." name="descripcion" cols="40" rows="10" id="descripcion">
                                            <?php echo $consulta['descripcion'] ?>
                                        </textarea>

                                    </div>


                                </div>

                            </div>


                            <?php if ($consulta['status'] == 'completo') { ?>
                                'Este control ya se hizo'
                            <?php } else { ?>

                                <button class="nextBtn" name="registro" id="registro">
                                    <span class="btnText"> Confirmar</span>
                                    <ion-icon name="send-outline"></ion-icon>
                                </button>



                            <?php } ?>


                        </div>
                    </div>


                <?php

            }
                ?>




            </div>
        </div>






</div>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var tipo = '1'
                var idee = $("#idee").val();
                var id = $("#id").val();
                var fecha_rehabilitacion = $("#fecha_rehabilitacion").val();
                let descripcion = $("#descripcion").val();

                var new_control = "new_control"
                console.log(idee)
                console.log(fecha_rehabilitacion, descripcion)


                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../php2/__procesamientorehabilitacion.php",
                    data: {
                        new_control: new_control,
                        id: id,
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
                        })
                        /* .then(function() {
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