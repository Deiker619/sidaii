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
            <span class="link-name">Proceso activo: <?php echo $consulta["nombre"] . " " . $consulta["nombre"] ?></span>
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
                            <span class="title">Detalles del proceso</span>
                            <div class="fields">



                                <div class="input-field">
                                    <label>Codigo de proceso</label>
                                    <input type="number" required readonly name="idee" id="idee" value="<?php echo $id ?>">
                                </div>


                            </div>
                            <div class="details personal">
                                <span class="title">Observaciones</span>
                                <div class="fields">

                                    <div class="input-field" id="art-ort">
                                        <label>Ingrese la observacion</label>
                                        <textarea placeholder="Ingrese una breve descripcion del caso..." name="descripcion" cols="40" rows="10" id="descripcion"><?php echo $consulta['descripcion'] ?></textarea>

                                    </div>


                                </div>

                            </div>

                            <?php if($consulta['status'] !='Caso cerrado'){ ?>
                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText"> Cerrar Caso</span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>
                                <?php } ?>

                        </div>
                    </div>


                <?php

            }
                ?>


                <div style="display: grid;  grid-template-columns: repeat(3, 1fr); gap: 10px;">
                    <?php
                    $aten->setid($id);
                    $avances = $aten->consultarTodosAvancesDeProceso();
                    foreach ($avances as $avance) {
                    ?>
                        <a href="17-rehabilitacion_control.php?id=<?php echo $avance['id'] ?>">


                            <div class="avance">
                                <h3 class="card__title">Codigo de Control: <?php echo $avance['id'] ?>
                            </h3>
                            <span><small><?php echo $avance['status'] ?></small></span>


                                <p class="card__content"><?php echo $avance['descripcion']?? 'No hay descripcion' ?> </p>
                                <div class="card__date">
                                    <b> Fecha de la cita:</b> <?php echo $avance['fecha_cita'] ?>
                                </div>
                                <div class="card__arrow">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="15" width="15">
                                        <path fill="#fff" d="M13.4697 17.9697C13.1768 18.2626 13.1768 18.7374 13.4697 19.0303C13.7626 19.3232 14.2374 19.3232 14.5303 19.0303L20.3232 13.2374C21.0066 12.554 21.0066 11.446 20.3232 10.7626L14.5303 4.96967C14.2374 4.67678 13.7626 4.67678 13.4697 4.96967C13.1768 5.26256 13.1768 5.73744 13.4697 6.03033L18.6893 11.25H4C3.58579 11.25 3.25 11.5858 3.25 12C3.25 12.4142 3.58579 12.75 4 12.75H18.6893L13.4697 17.9697Z"></path>
                                    </svg>
                                </div>
                            </div>

                        <?php } ?>
                        </a>

                </div>

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
                var cerrar_caso = 'cerrar_caso'
                var idee = $("#idee").val();
            

              


                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../php2/__procesamientorehabilitacion.php",
                    data: {
                        cerrar_caso: cerrar_caso,
                        idee: idee,
                       
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