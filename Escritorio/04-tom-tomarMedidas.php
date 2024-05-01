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
            include_once("../php/01-03-toma_medidas.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["codigo_cita"];
            $aten = new toma_medidas(1);

            $aten->setcodigo_cita($numero);
            $registro = $aten->consultarMedidas();
            ?>

            <header>
                Tomar medidas a <?php echo $registro["nombre"] ?>
            </header>
            <div class="fecha" id="fecha_registro"><?php echo date("Y-m-d") ?></div>
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
                                    <label>Atencion Solicitada</label>
                                    <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["atencion_solicitada"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Codigo de cita</label>
                                    <input type="number" required readonly name="ide" id="ide" value="<?php echo $registro["id"] ?>">
                                </div>




                            </div>
                            <!--   <div class="checkboxes">
                                <label class="cl-checkbox">
                                    <input checked="protesis" type="radio" name="artificio" value="protesis" id="protesis">
                                    <span>Artificio: Protesis</span>
                                </label>

                                <label class="cl-checkbox">
                                    <input checked="ortesis" type="radio" name="artificio" value="ortesis" id="ortesis">
                                    <span>Artificio: Ortesis</span>
                                </label>
                            </div>
                            <div class="details personal">
                                <span class="title">Detalles de medidas</span>
                                <div class="fields">

                                    <div class="input-field" id="art-pro">
                                        <label>Elije el artificio para medidas</label>
                                        <select name="artificioP" id="artificioP">
                                            <option value="">Elije una opcion</option>
                                            <?php
                                            include_once("../php/01-03-toma_medidas.php");
                                            $protesis = new toma_medidas(1);

                                            $consulta = $protesis->consultarTodasProtesis();
                                            if ($consulta) {
                                                foreach ($consulta as $consult) {
                                                    echo "<option value =" . $consult["id"] . ">" . $consult["nombre"] . "</option>";
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>

                                    <div class="input-field" id="art-ort">
                                        <label>Elije el artificio para medidas</label>
                                        <select name="artificioO" id="artificioO">
                                            <option value="">Elije una opcion</option>
                                            <?php
                                            include_once("../php/01-03-toma_medidas.php");
                                            $protesis = new toma_medidas(1);

                                            $consulta = $protesis->consultarTodasOrtesis();
                                            if ($consulta) {
                                                foreach ($consulta as $consult) {
                                                    echo "<option value =" . $consult["id"] . ">" . $consult["nombre"] . "</option>";
                                                }
                                            }

                                            ?>

                                        </select>
                                    </div>



                                </div>


                                <div class="details personal">
                                    <span class="title">Elegir fecha de prueba</span>
                                    <div class="fields">

                                        <div class="input-field">
                                            <label>Elije fecha para la prueba de artificio</label>
                                            <input type="date" required name="fecha_prueba" id="fecha_prueba">
                                        </div>

                                    </div>
                                </div>

                                


                            </div> -->
                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Tomar medidas</span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>
                        </div>


                    <?php

                }
                    ?>

                </form>
        </div>
    </div>


</div>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#art-pro").hide();
        mostrarArtificio();

        function mostrarArtificio() {


            $("input[name='artificio']").change(function() {

                console.log(this.value + ":" + this.checked);
                if (this.value == "protesis") {
                    $("#art-ort").hide();
                    $("#art-pro").show();
                    $("#artificioO").prop('selectedIndex', 0);


                }

                if (this.value == "ortesis") {
                    $("#art-ort").show();
                    $("#art-pro").hide();
                    $("#artificioP").prop('selectedIndex', 0);


                }




            });
        }
    })




    $("#artificioO").change(function() {

        var artificio = this.value;
        console.log(artificio);

    })

    $("#artificioP").change(function() {

        var artificio = this.value;
        console.log(artificio);

    })


    $(function() {

        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var ide = $("#ide").val();
                var medidas = $("#medidas").val();
                var fecha_prueba = $("#fecha_prueba").val()
                var fechaActual = $("#fecha_registro").text()
                var cedula = $("#cedula").val();

                var artificio = $("#artificioO").val();

                if (artificio == "") {
                    artificio = $("#artificioP").val();
                }


                console.log("Artificio:" + artificio)
                console.log("Fecha de prueba :" + fecha_prueba)
                console.log("Fecha de prueba :" + fechaActual)




                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "04-tom-medidasTomadas.php",
                    data: {
                        ide: ide,
                        medidas: medidas,
                        fecha_prueba: fecha_prueba,
                        artificio: artificio,
                        fechaActual: fechaActual
                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': 'Se asigno asistencia correctamente',
                        }).then(function() {
                            window.location = "04-tomaMedidas.php";


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

                var atencion = "5-pruebar";
                console.log(atencion);
                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "../php/procesamientodebeneficiario.php",
                    data: {
                        cedula: cedula,
                        atencion: atencion,
                        artificio: artificio,
                        fecha_prueba: fecha_prueba

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