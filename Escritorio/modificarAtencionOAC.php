<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atención al ciudadano: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <div class="registrador" style="display: hidde;"><?php


                                                                ?>

                <div class="gerencia" id="gerencia">
                    <?php echo $gerencia ?>
                </div>

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
                Modificar atenciòn <?php $registro["numero_aten"] . " " . $registro["nombre"] . " " . $registro["apellido"]  ?>
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
                                    <label>Fecha</label>
                                    <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo date("Y-m-d") ?>">

                                </div>

                                <div class="input-field">
                                    <label>Elige una solicitud</label>
                                    <select name="atencion_recibida" id="atencion_recibida" require>
                                        <option selected value=''>Ninguna (Para volver a cargarla)</option>
                                        <option value="Silla de ruedas estandar">Silla de ruedas estandar</option>
                                        <option value="Silla de rueda ergonomica N16">Silla de rueda ergonomica N16</option>
                                        <option value="Silla de rueda ergonomica N14">Silla de rueda ergonomica N14</option>
                                        <option value="Silla de rueda ergonomica N18">Silla de rueda ergonomica N18</option>
                                        <option value="Silla de rueda reclinable adulto">Silla de rueda reclinable adulto</option>
                                        <option value="Silla de rueda pediatrica hergonomica">Silla de rueda pediatrica hergonomica</option>
                                        <option value="2Muletas talla S">Muletas talla S</option>
                                        <option value="Muletas talla M">Muletas talla M</option>
                                        <option value="Muletas talla L">Muletas talla L</option>
                                        <option value="Muletas canadienses">Muletas canadienses</option>
                                        <option value="Baston de 1 punto">Baston de 1 punto</option>
                                        <option value="Baston de 4 puntas">Baston de 4 puntas</option>
                                        <option value="Baston de rastreo">Baston de rastreo</option>
                                        <option value="Andadera">Andadera</option>
                                        <option value="Cama Clinica">Cama Clinica</option>
                                        <option value="Colchon Antiescara">Colchon Antiescara</option>
                                        <option value="Silla de ruedas bariátricas">Silla de ruedas bariátricas</option>
                                        <option value="Coche ortopédico pediátrico">Coche ortopédico pediátrico</option>
                                        <option value="Férula">Férula</option>
                                        <option value="Pañales">Pañales</option>
                                    </select>

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
            $(function() {




                $("#registro").click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {

                        var atencion_recibida = $("#atencion_recibida").val();
                        var id = $("#numero_aten").val()




                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientodecarga_solicitud.php",
                            data: {
                                id: id,
                                atencion_recibida: atencion_recibida

                            },
                            success: function(data) {
                                Swal.fire({
                                    icon: 'success',
                                    title: data.trim()
                                }).then(function() {
                                    window.location = "01,2-atenciones.php";
                                })

                                if (!data) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "No se pudo registrar la solicitud, verifique datos"
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
            })
        </script>


        <?php
        include_once("parteabajo.php");
        ?>