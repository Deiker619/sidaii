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
            include_once("../php/01-04-pruebaArtificio.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new prueba_artificio(1);

            $aten->setid($numero);
            $registro = $aten->consultarPruebas();
            ?>

            <div class="personas-conatencion">
                <div class="botones__especiales">
                   
                    <button class="Btn guide">

                        <div class="sign"><i class='bx bx-repeat'></i></div>

                        <div class="text_boton"><a class="enlace_especial" href="05-reasignarprueba.php?id=<?php echo $numero ; ?>"> Reasignar cita </a></div>
                    </button>
                    


                </div>




            </div>
            <header>
                Probar artificio a <?php echo $registro["nombre"] ?>
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
                                    <label>Codigo de cita</label>
                                    <input type="number" required readonly name="ide" id="ide" value="<?php echo $registro["id"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Probar:</label>
                                    <input type="text" placeholder="Ingresa tu correo electronico" required readonly name="artificio" id="artificio" value="<?php echo $registro["artificio_prueba"] ?>">
                                </div>


                            </div>



                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Finalizar prueba</span>
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
                        var ide = $("#ide").val();
                        var pruebas = "Caso cerrado";

                        console.log(ide)
                        console.log(pruebas)


                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "05-pruebaAsignadas.php",
                            data: {
                                ide: ide,
                                pruebas: pruebas
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se asigno asistencia correctamente',
                                }).then(function() {
                                    window.location = "05-pruebaArtificio.php";
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