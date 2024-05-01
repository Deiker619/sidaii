<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Historia medica: <?php echo $rol ?></span>

        </div>
    </div>


    <?php

    include_once("../php/11-historia_medica.php");
    include_once("../php/12-historia_medica_protesis.php");

    $codigo_cita = $_REQUEST["codigo_cita"];
    $aten =  new historia_medica(1);
    $aten2 = new historia_medica_protesis(1);

    $aten->setcodigo_cita($codigo_cita);
    $aten2->setcodigo_cita($codigo_cita);
    $consultaO = $aten->ConsultarHistoria();
    $consultaP = $aten2->consultarHistoriaProtesis();
    /* $cantidadRegistros = count($consulta); */

    if ($consultaO) { ?>

        <div class="cont-registro">



            <div class="container">
                <?php if ($rol == "Superusuario") { ?>
                    <div class="botones__especiales">
                        <button class="delete-button" onclick="eliminar(<?php echo $codigo_cita; ?>)">
                            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                            </svg>
                        </button>

                        <button class="buttonDownload" onclick="redireccionarO(<?php echo $codigo_cita; ?>)">Download</button>
                    </div>
                <?php } ?>

                <form action="" method="">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles de la historia</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Cedula</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $consultaO["cedula"] ?> ">
                                </div>

                                <div class="input-field">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $consultaO["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido" value="<?php echo $consultaO["apellido"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>estado</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaO["estado"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Municipio</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaO["municipio"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Parroquia</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaO["parroquia"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Discapacidad</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consultaO["discapacidad"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Fecha nacimiento</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consultaO["fecha_naci"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Telefono</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="certificado" id="certificado" value="<?php echo $consultaO["telefono"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Edad</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nro_hijo" id="nro_hijo" value="<?php echo $consultaO["edad"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Sexo</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="registrado_por" id="registrado_por" value="<?php echo $consultaO["sexo"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Artificio</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaO["artificio"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Artificio Medidas</label>
                                    <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $consultaO["artificio_medidas"] ?>">
                                </div>
                                <?php if ($consultaO["diseño"]) {
                                    echo '<div class="input-field">
                                        <label>Diseño</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["diseño"] . ' >
                                    </div>';
                                }
                                ?>
                                <?php if ($consultaO["lado_afectado"]) {
                                    echo '<div class="input-field">
                                        <label>Lado afectado</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["lado_afectado"] . ' >
                                    </div>';
                                }
                                ?>

                                <?php if ($consultaO["zona_del_lado"]) {
                                    echo '<div class="input-field">
                                        <label>Zona del lado</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["zona_del_lado"] . ' >
                                    </div>';
                                }
                                ?>
                                <?php if ($consultaO["nervio"]) {
                                    echo '<div class="input-field">
                                        <label>Nervio</label>'; ?>
                                    <input type="text" placeholder="Ingresa tu correo electrónico" required readonly name="discapacidad" id="discapacidad" value='<?php echo $consultaO["nervio"]; ?>'>
                            </div>





                        <?php } ?>


                        <?php if ($consultaO["solicitud"]) {
                            echo '<div class="input-field">
                                        <label>Solicitud</label>'; ?>
                            <input type="text" placeholder="Ingresa tu correo electrónico" required readonly name="discapacidad" id="discapacidad" value='<?php echo $consultaO["solicitud"]; ?>'>
                        </div>





                    <?php } ?>

                    <?php if ($consultaO["fecha_apertura"]) {
                        echo '<div class="input-field">
                                        <label>Fecha Apertura</label>
                                        <input type="date" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["fecha_apertura"] . ' >
                                    </div>';
                    }
                    ?>

                    <?php if ($consultaO["fecha_medidas"]) {
                        echo '<div class="input-field">
                                        <label>Fecha medidas</label>
                                        <input type="date" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["fecha_medidas"] . ' >
                                    </div>';
                    }
                    ?>
                    <?php if ($consultaO["clasificacion"]) {
                        echo '<div class="input-field">
                                        <label>Clasificacion</label>
                                        <input type="date" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value=' . $consultaO["clasificacion"] . ' >
                                    </div>';
                    }
                    ?>














                    </div>
                    <?php if ($rol == "Superusuario") { ?>


                        <button class="nextBtn" name="registro" id="registro">
                            <span class="btnText"></span>
                            <ion-icon name="send-outline"></ion-icon>
                        </button>
                    <?php } ?>

                </form>
            </div>
        </div>





    <?php

    }

    if ($consultaP) { ?>

        <div class="cont-registro">



            <div class="container">
                <?php if ($rol == "Superusuario") { ?>
                    <div class="botones__especiales">
                        <button class="delete-button" onclick="eliminar(<?php echo $codigo_cita; ?>)">
                            <svg class="delete-svgIcon" viewBox="0 0 448 512">
                                <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z"></path>
                            </svg>
                        </button>

                        <button class="buttonDownload" onclick="redireccionar(<?php echo $codigo_cita; ?>)">Download</button>
                    </div>
                <?php } ?>

                <form action="" method="">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles de la historia</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Cedula</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $consultaP["cedula"] ?> ">
                                </div>

                                <div class="input-field">
                                    <label>Nombre</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $consultaP["nombre"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Apellido</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido" value="<?php echo $consultaP["apellido"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>estado</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaP["estado"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Municipio</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaP["municipio"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Parroquia</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $consultaP["parroquia"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Discapacidad</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consultaP["discapacidad"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Fecha nacimiento</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="email" id="email" value="<?php echo $consultaP["fecha_naci"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Telefono</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="certificado" id="certificado" value="<?php echo $consultaP["telefono"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Edad</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="nro_hijo" id="nro_hijo" value="<?php echo $consultaP["edad"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Sexo</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="registrado_por" id="registrado_por" value="<?php echo $consultaP["sexo"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> Artificio</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="Protesis">
                                </div>
                                <div class="input-field">
                                    <label> Nivel de actividad</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["nivel_actividad"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Lado de amputacion</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["lado_amputacion"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Nivel amputacion</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["nivel_amputacion"] ?>">
                                </div>
                                <div class="input-field">
                                    <label> Zona afectada</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["z_afectada"] ?>">
                                </div>
                                <div class="input-field">
                                    <label> Diseño de la protesis</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["diseno"] ?>">
                                </div>
                            </div>
                            <span class="title">Estado del muñon</span>

                            <div class="fields">

                                <div class="input-field">
                                    <label>Musculatura</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["musculatura"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Forma</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["forma"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Cicatriz</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["cicatriz"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Piel</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["nivel_actividad"] ?>">
                                </div>
                            </div>
                            <!-- Estado del muñon -->


                            <!-- caracteristicas -->

                            <span class="title">Caracteristicas de la protesis</span>


                            <div class="fields">

                                <div class="input-field">
                                    <label>Tipo de rodilla</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["tipo_rodilla"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Tipo de pie</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["tipo_pie"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Tipo de socket</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["tipo_socket"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Clasificacion del socket</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["clasificacion_socket"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Metodo de suspension</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["metodo_suspension"] ?>">
                                </div>
                            </div>

                            <span class="title">Fecha y tecnico</span>


                            <div class="fields">

                                <div class="input-field">
                                    <label>Fecha de apertura</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["fecha_cita"] ?>">
                                </div>
                                <div class="input-field">
                                    <label>Tecnico</label>
                                    <input type="text" placeholder="Ingresa el nombre " required readonly name="fecha_registro" id="fecha_registro" value="<?php echo $consultaP["tipo_pie"] ?>">
                                </div>
                              
                            </div>










                        </div>
                        <?php if ($rol == "Superusuario") { ?>


                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText"></span>
                                <ion-icon name="send-outline"></ion-icon>
                            </button>
                        <?php } ?>

                </form>
            </div>
        </div>





    <?php   } ?>


</div>
</div>














<?php
include_once("parteabajo.php");
?>


<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script>
    function redireccionar(a) {
        url = 'reportes/historia_medica_protesis.php?codigo_cita=' + a;
        window.open(url, "_blank");

    }

    function redireccionarO(a) {
        url = 'reportes/historia_medica.php?codigo_cita=' + a;
        window.open(url, "_blank");

    }
</script>

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
</script>