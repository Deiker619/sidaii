<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Reparacion de artificio: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            /* session_start(); */
            include_once("../php/01-05-reparacionArtificio.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new raparacion_artificio(1);

            $aten->setid($numero);
            $registro = $aten->consultarReparacionModificar();
            ?>

            <header>
                Reparar artificio a <?php echo $registro["nombre"] ?>
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
                                    <input type="text" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $registro["discapacidad"] ?>">
                                </div>





                                <div class="input-field">
                                    <label>Codigo de reparacion</label>
                                    <input type="number" required readonly name="idee" id="idee" value="<?php echo $registro["id"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Artificio a reparar</label>
                                    <input type="text" required name="artificio" id="artificio" value="<?php echo $registro["artificio"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Asignar fecha para la reparacion</label>
                                    <input type="date" required name="fecha_reparacion" id="fecha_reparacion" value="<?php echo $registro["fecha_reparacion"] ?>">
                                </div>

                                
                            </div>
                            <div class="details personal">
                                <span class="title">Observaciones</span>
                                <div class="fields">

                                    <div class="input-field" id="art-ort">
                                        <label>Ingrese la observacion</label>
                                        <textarea name="descripcion" cols="40" rows="10" id="descripcion"><?php echo $registro["descripcion"] ?> </textarea>

                                    </div>


                                </div>

                            </div>


                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Asignar</span>
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
            $(function() {
                $("#registro").click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {
                        var idee = $("#idee").val();
                        var fecha_reparacion = $("#fecha_reparacion").val();
                        let artificio = $('#artificio').val();
                        let descripcion = $("#descripcion").val();

                        console.log(idee)
                        console.log(fecha_reparacion, artificio, descripcion)


                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "06-asignadaReparacion.php",
                            data: {
                                idee: idee,
                                fecha_reparacion: fecha_reparacion,
                                artificio: artificio,
                                descripcion: descripcion
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se asigno asistencia correctamente',
                                }).then(function() {
                                    window.location = "06-reparacionArtificio.php";
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