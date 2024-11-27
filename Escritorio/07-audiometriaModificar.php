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
            require_once("../php/01-06-audiometria.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new audiometria(1);

            $aten->setid($numero);
            $registro = $aten->consultarCita();
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
                                    <label>ID</label>
                                    <input type="text" required readonly name="id" id="id" value="<?php echo $registro["id"] ?>">
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
                                    <label>Asignar fecha para la reparacion</label>
                                    <input type="date" required name="fecha_cita" id="fecha_cita" value="<?php echo $registro["fecha_cita"] ?>">
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
                        var id = $("#id").val();
                        var fecha_cita = $("#fecha_cita").val();
                        let descripcion = $("#descripcion").val();

              


                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "07-audiometriaUpdate.php",
                            data: {
                                id: id,
                                fecha_cita: fecha_cita,
                                descripcion: descripcion
                            },
                            success: function(data) {
                                console.log(data)
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se asigno asistencia correctamente',
                                }).then(function() {
                                   
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