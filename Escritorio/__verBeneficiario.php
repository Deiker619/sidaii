<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Beneficiario: <?php echo $rol ?></span>

        </div>
    </div>


    <?php

    include_once("../php/01-discapacitados.php");

    $cedula = $_REQUEST["cedula"];
    $aten =  new Discapacitados(1);

    $aten->setcedula($cedula);
    $consulta = $aten->consultarDiscapacitados();
    $cantidadRegistros = count($consulta);

    if ($consulta) { ?>
        <div class="cont-registro">



            <div class="container">
                <?php if ($rol == "Superusuario") { ?>
                    <div class="botones-beneficiario-sup">
                        <button class="delete-button" onclick="eliminar(<?php echo $cedula; ?>)">
                            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                            </svg>
                        </button>

                        <button class="delete-button" onclick="modificar(<?php echo $cedula; ?>)">
                            <div class="delete-svgIcon" viewBox="0 0 448 512">
                                <i class='bx bx-group'></i>
                            </div>
                        </button>
                    </div>

                <?php } ?>

                <form action="" method="">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Cedula</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $consulta["cedula"] ?> ">
                                </div>

                                <div class="input-field">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $consulta["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido" value="<?php echo $consulta["apellido"] ?>">
                                </div>

                              

                                <div class="input-field">
                                    <label> Correo</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consulta["email"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Telefono</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consulta["telefono"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Certificado</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="certificado" id="certificado" value="<?php echo $consulta["certificado"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Numero de hijos</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nro_hijo" id="nro_hijo" value="<?php echo $consulta["nro_hijo"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Registrado por la persona</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="registrado_por" id="registrado_por" value="<?php echo $consulta["registrado_por"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Fecha del registro</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consulta["fecha_registro"] ?>">
                                </div>



                                <div class="input-field">
                                    <label>Discapacidad</label>
                                    <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $consulta["nombre_e"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>estado</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consulta["nombre_estado"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Municipio</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consulta["nombre_municipio"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Parroquia</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consulta["nombre_parroquia"] ?>">
                                </div>
                                <?php 
                                $consulta = $aten->consultarDirecciones() ?? "Sin dirección" ?>
                                 <div class="input-field">
                                    <label>Dirección</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consulta["descripcion"] ?>">
                                </div>

                                <?php
                                $cuidador = $aten->detalles_cuidador();

                                if ($cuidador) {  ?>





                                    <div class="input-field">
                                        <label>Nombre del cuidador o representante</label>
                                        <input type="text" placeholder="Ingresa el nombre de cuidador" name="nombre-cuidador" id="cuidador" value="<?php echo $cuidador["nombre"] ?>">

                                    </div>

                                    <div class="input-field">
                                        <label>Cedula del cuidador o representante</label>
                                        <input type="number" placeholder="ingresa cedula cuidador" id="cedula_cui" name="cedula-cuidador" value="<?php echo $cuidador["cedula_r"] ?>">
                                    </div>





                                <?php

                                }
                                ?>

                                <?php
                                $institucionales = $aten->Detalles_institucionales();

                                if ($institucionales) {  ?>


                                    <div class="input-field">
                                        <label>¿Recibe proteccion social?</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="proteccion_social" id="proteccion_social" value="<?php echo $institucionales["proteccion_social"] ?>">
                                    </div>



                                <?php

                                }
                                ?>

                                <?php
                                $emprendimiento = $aten->detalles_emprendimiento();

                                if ($emprendimiento) {  ?>


                                    <div class="input-field">
                                        <label>Nombre emprendimiento</label>
                                        <input type="email" required readonly name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["nombre_emprendimiento"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Rif</label>
                                        <input type="email" required readonly name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["rif_emprendimiento"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Area comercial</label>
                                        <input type="email" required readonly name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["area_comercial"] ?>">
                                    </div>


                                    <div class="input-field">
                                        <label>Banco del credito que uso</label>
                                        <input type="email" required readonly name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["banco"] ?>">
                                    </div>





                                <?php

                                }
                                ?>










                            </div>
                            <?php if ($rol == "Superusuario") { ?>


                                <!-- <a href="modifica/modificarBen" class="a-simple"> <button class="nextBtn" name="modificar" id="modificar">
                                    <ion-icon name="send-outline">Modificar</ion-icon>
                                    <span class="btnText"><i class='bx bx-right-arrow-circle'></i></span>
                                </button>
                                </a> -->
                            <?php } ?>


                        </div>
                    </div>



                </form>
            </div>
        </div>



    <?php

    }
    ?>







    <?php
    include_once("parteabajo.php");
    ?>


    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>

    <script>
        function eliminar(p1) {


            var cedula = p1;
            console.log(cedula);


            Swal.fire({
                icon: "question",
                title: '¿Desea eliminar este beneficiario?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `No eliminar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $.ajax({
                        type: "GET",
                        url: "eliminar/eliminarbeneficiario.php",
                        data: {
                            cedula: cedula


                        },
                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se elimino correctamente este beneficiario',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                window.location = "Beneficiarios.php";
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
                    Swal.fire('Changes are not eliminated', '', 'info')
                }
            })
        }

        function modificar(p1) {
            url = 'modificarBeneficiario.php?cedula=' + p1

            window.location.href = url;
        }
    </script>