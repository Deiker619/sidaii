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
    $copiaCedula = $aten->ConsultarCopiaCedula($cedula);
    $partida = $aten->ConsultarPartidaNacimiento($cedula)??null;
    $cantidadRegistros = count($consulta);

    if ($consulta) { ?>
        <div class="cont-registro">



            <div class="container">
                <header>

                </header>


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
                <?php if ($consulta["edad"] > 9) { ?>
                    <div class="header-beneficiario">
                        <div class="profile_beneficiario dos">
                            <div class="foto-beneficiario">
                                <?php if ($copiaCedula) { ?>
                                    <img src="documentos/cedula_beneficiarios/<?php echo $copiaCedula["archivo"]; ?>" alt="" srcset="" alt="foto dl beneficiario">

                                <?php } else { ?>
                                    <img src="profile.png" alt="" srcset="" alt="foto dl beneficiario">

                                <?php } ?>
                            </div>



                        </div>





                        <hr>

                        <div class="profile_beneficiario dos">
                            <form action="documentos/cedula_beneficiarios/cargarFoto.php" method="post" enctype="multipart/form-data">
                                <?php if (!$copiaCedula) { ?>
                                    <input type="file" name="foto_perfil" accept="image/*" required>
                                    <input type="text" name="cedula_beneficiario" style="display: none;" value="<?php echo $consulta["cedula"] ?>">
                                    <button type="submit">Subir foto</button>
                                <?php } ?>




                            </form>
                            <?php if ($copiaCedula) { ?>
                                <button class="buttons" type="button" onclick="eliminarCopiaCedula('<?php echo $copiaCedula['archivo'] ?>', '<?php echo $cedula ?>', '<?php echo $copiaCedula['id'] ?>')">
                                    <span class="buttons__text" style="transform: translateX(9px);">Eliminar foto</span>
                                    <span class="buttons__icon">
                                        <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <title></title>
                                            <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                                            <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
                                        </svg>
                                    </span>
                                </button>
                            <?php  } ?>

                        </div>


                    </div>
                <?php } ?>


                <?php if ($consulta["edad"] < 9) { ?>
                    <?php if (!$partida) { ?>
                        <span style="color: red;"> Cargue la partida de nacimiento al menor</span>
                    <?php }  ?>
                    <div class="header-beneficiario">
                        
                        <div class="profile_beneficiario dos">
                            <div class="foto-beneficiario">
                                <?php if ($partida) { ?>
                                    <img src="pdf.png" alt="" srcset="" alt="foto dl beneficiario">
                                    <a href="documentos/partidas_nacimiento/<?php echo $partida["archivo"]; ?>">Ver partida</a>

                                <?php } else { ?>
                                    <img src="subir.png" alt="" srcset="" alt="foto dl beneficiario">

                                <?php } ?>
                            </div>



                        </div>





                        <hr>

                        <div class="profile_beneficiario dos">
                            
                            <form action="documentos/partidas_nacimiento/cargarPartida.php" method="post" enctype="multipart/form-data">
                                <?php if (!$partida) { ?>
                                    <input type="file" name="foto_perfil" accept="image/*,application/pdf" required>
                                    <input type="text" name="cedula_beneficiario" style="display: none;" value="<?php echo $consulta["cedula"] ?>">
                                    <button type="submit">Subir documento</button>
                                <?php } ?>




                            </form>
                            <?php if ($partida) { ?>
                                <button class="buttons" type="button" onclick="eliminarPartida('<?php echo $partida['archivo'] ?>', '<?php echo $cedula ?>', '<?php echo $partida['id'] ?>')">
                                    <span class="buttons__text" style="transform: translateX(9px);">Eliminar documento</span>
                                    <span class="buttons__icon">
                                        <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <title></title>
                                            <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                                            <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
                                        </svg>
                                    </span>
                                </button>
                            <?php  } ?>

                        </div>


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


    <div class="titulo">
        <i class='bx bxs-dashboard'> </i>
        <span class="link-name">Historico: </span>

    </div>


    <button class="accordion2">OAC </button>
    <div class="panel2">
        <div class="container-time">
            <div id="timeline">
                <?php
                $aten->setcedula($cedula);
                $consulta = $aten->historico();

                foreach ($consulta as $key => $registros) {
                    $key = $key + 1; ?>
                    <?php if ($key % 2 != 0) { ?>
                        <div class="timeline-block">
                            <?php if ($registros['nombre_tipoayuda']) { ?>
                                <div class="timeline-year right" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_atencion"])) ?></strong></div> <!-- timeline-year -->
                                <div class="timeline-content" data-anime-left="scroll-left">
                                    <p>En la fecha <strong><?php echo date("d-m-Y", strtotime($registros["fecha_atencion"])) ?> </strong> <strong style="color:#2aa8e0"> Recibió </strong> un/a <strong><?php echo $registros["nombre_tipoayuda"]; ?></strong>. Su ID: <strong> <?php echo $registros["numero_aten"] ?></strong>
                                        <br>

                                        <small>Estatus: <strong style="color:#1AA83E"> Atendido </strong></small>
                                    </p>

                                    <br>
                                    <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                        <a class="certificado" href=""> <i class='bx bx-download'></i>Certificado entrega</a>
                                        <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>
                                        <a class="informe-medico" href=""><i class='bx bx-download'></i>Informe medico</a>

                                    </div>
                                </div> <!-- timeline-content -->
                            <?php } else { ?>
                                <div class="timeline-year right" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_solicitud"])) ?></strong></div> <!-- timeline-year -->
                                <div class="timeline-content dos" data-anime-left="scroll-left">
                                    <p>En la fecha <strong> <?php echo date("d-m-Y", strtotime($registros["fecha_solicitud"]));  ?></strong> <strong style="color:#2aa8e0"> solicitó </strong> un/a <strong> <?php echo $registros["atencion_solicitada"]; ?></strong>
                                        a las <strong> <?php echo date("H:i:s", strtotime($registros["fecha_solicitud"])) ?></strong>. Su
                                        ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                        <br>

                                        <small>Estatus: <strong style="color:#2aa8e0">En espera </strong></small>
                                    </p>
                                    <br>
                                    <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                        <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>

                                    </div>
                                </div> <!-- timeline-content -->
                            <?php } ?>
                        </div>
                    <?php } ?>

                    <?php if ($key % 2 == 0) { ?>
                        <div class="timeline-block">
                            <?php if ($registros['nombre_tipoayuda']) { ?>
                                <div class="timeline-year left" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_atencion"])) ?></strong></div> <!-- timeline-year -->
                                <div class="timeline-content" data-anime-right="scroll-right">
                                    <p>En la fecha <strong><?php echo date("d-m-Y", strtotime($registros["fecha_atencion"])) ?></strong> <strong style="color:#2aa8e0"> Recibió </strong> un/a <strong><?php echo $registros["nombre_tipoayuda"]; ?></strong>
                                        ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                        <br>

                                        <small>Estatus: <strong style="color:#1AA83E"> Atendido </strong></small>
                                    </p>
                                    <br>
                                    <div class="historico-item" style="display: flex; gap:5px;  flex-wrap:wrap">
                                        <a class="certificado" href=""> <i class='bx bx-download'></i>Certificado entrega</a>
                                        <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>
                                        <a class="informe-medico" href=""><i class='bx bx-download'></i>Informe medico</a>

                                    </div>

                                </div> <!-- timeline-content -->
                            <?php } else { ?>
                                <div class="timeline-year left" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_solicitud"])) ?></strong></div> <!-- timeline-year -->
                                <div class="timeline-content" data-anime-right="scroll-right">
                                    <p>En la fecha <strong> <?php echo date("d-m-Y", strtotime($registros["fecha_solicitud"]));  ?></strong> <strong style="color:#2aa8e0"> solicitó </strong>un/a <strong> <?php echo $registros["atencion_solicitada"]; ?></strong>
                                        a las <strong> <?php echo date("H:i:s", strtotime($registros["fecha_solicitud"])) ?></strong>.
                                        ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                        <br>

                                        <small>Estatus: <strong style="color:#2aa8e0">En espera </strong></small>
                                    </p>
                                    <br>
                                    <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                        <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>

                                    </div>
                                </div> <!-- timeline-content -->
                            <?php } ?>
                        </div>
                    <?php } ?>

                <?php } ?>









            </div>



        </div>
    </div>
    <br>
    <br>

    <button class="accordion3">Operación estadal</button>
    <div class="panel3">
        <div id="timeline">
            <?php
            $aten->setcedula($cedula);
            $consulta = $aten->historicoOP();

            foreach ($consulta as $key => $registros) {
                $key = $key + 1; ?>
                <?php if ($key % 2 != 0) { ?>
                    <div class="timeline-block">
                        <?php if ($registros['nombre_tipoayuda']) { ?>
                            <div class="timeline-year right" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_atencion"])) ?></strong></div> <!-- timeline-year -->
                            <div class="timeline-content" data-anime-left="scroll-left">
                                <p>En la fecha <strong><?php echo date("d-m-Y", strtotime($registros["fecha_atencion"])) ?> </strong> <strong style="color:#2aa8e0"> Recibió </strong> un/a <strong><?php echo $registros["nombre_tipoayuda"]; ?></strong>
                                    en la coordinacion de <strong> <?php echo $registros["nombre_coordinacion"] ?></strong>. ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                    <br>

                                    <small>Estatus: <strong style="color:#1AA83E"> Atendido </strong></small>
                                </p>

                                <br>
                                <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                    <a class="certificado" href=""> <i class='bx bx-download'></i>Certificado entrega</a>
                                    <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>
                                    <a class="informe-medico" href=""><i class='bx bx-download'></i>Informe medico</a>

                                </div>
                            </div> <!-- timeline-content -->
                        <?php } else { ?>
                            <div class="timeline-year right" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_solicitud"])) ?></strong></div> <!-- timeline-year -->
                            <div class="timeline-content" data-anime-left="scroll-left">
                                <p>En la fecha <strong> <?php echo date("d-m-Y", strtotime($registros["fecha_solicitud"]));  ?></strong> <strong style="color:#2aa8e0"> solicitó </strong> un/a <strong> <?php echo $registros["atencion_solicitada"]; ?></strong>
                                    a las <strong> <?php echo date("H:i:s", strtotime($registros["fecha_solicitud"])) ?></strong> en la Coordinación de <strong> <?php echo $registros["nombre_coordinacion"] ?></strong>.
                                    ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                    <br>

                                    <small>Estatus: <strong style="color:#2aa8e0">En espera </strong></small>
                                </p>
                                <br>
                                <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                    <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>

                                </div>
                            </div> <!-- timeline-content -->
                        <?php } ?>
                    </div>
                <?php } ?>

                <?php if ($key % 2 == 0) { ?>
                    <div class="timeline-block">
                        <?php if ($registros['nombre_tipoayuda']) { ?>
                            <div class="timeline-year left" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_atencion"])) ?></strong></div> <!-- timeline-year -->
                            <div class="timeline-content" data-anime-right="scroll-right">
                                <p>En la fecha <strong><?php echo date("d-m-Y", strtotime($registros["fecha_atencion"])) ?></strong> <strong style="color:#2aa8e0"> Recibió </strong> un/a <strong><?php echo $registros["nombre_tipoayuda"]; ?></strong>
                                    en la coordinacion de <strong> <?php echo $registros["nombre_coordinacion"] ?></strong>. ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                    <br>

                                    <small>Estatus: <strong style="color:#1AA83E"> Atendido </strong></small>
                                </p>
                                <br>
                                <div class="historico-item" style="display: flex; gap:5px;  flex-wrap:wrap">
                                    <a class="certificado" href=""> <i class='bx bx-download'></i>Certificado entrega</a>
                                    <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>
                                    <a class="informe-medico" href=""><i class='bx bx-download'></i>Informe medico</a>

                                </div>

                            </div> <!-- timeline-content -->
                        <?php } else { ?>
                            <div class="timeline-year left" data-anime="scroll"><strong><?php echo date("Y", strtotime($registros["fecha_solicitud"])) ?></strong></div> <!-- timeline-year -->
                            <div class="timeline-content" data-anime-right="scroll-right">
                                <p>En la fecha <strong> <?php echo date("d-m-Y", strtotime($registros["fecha_solicitud"]));  ?></strong> <strong style="color:#2aa8e0"> solicitó </strong>un/a <strong> <?php echo $registros["atencion_solicitada"]; ?></strong>
                                    a las <strong> <?php echo date("H:i:s", strtotime($registros["fecha_solicitud"])) ?></strong> en la Coordinación de <strong> <?php echo $registros["nombre_coordinacion"] ?></strong>.
                                    ID <strong> <?php echo $registros["numero_aten"] ?></strong>
                                    <br>

                                    <small>Estatus: <strong style="color:#2aa8e0">En espera </strong></small>
                                </p>
                                <br>
                                <div class="historico-item" style="display: flex; gap:5px; flex-wrap:wrap">
                                    <a class="solicitud-bene" href=""><i class='bx bx-download'></i>Solicitud</a>

                                </div>
                            </div> <!-- timeline-content -->
                        <?php } ?>
                    </div>
                <?php } ?>

            <?php } ?>









        </div>
    </div>





    <?php
    include_once("parteabajo.php");
    ?>


    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script src="timeline.js"></script>

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

                    asignarAtencion();
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

        function eliminarCopiaCedula(p1, p2, p3) {
            console.log(p1);
            console.log(p2);
            eliminar = p1;
            cedula = p2;
            id = p3


            asignarAtencion();
            $.ajax({
                type: "POST",
                url: "documentos/cedula_beneficiarios/cargarFoto.php",
                data: {
                    eliminar: eliminar,
                    cedula: cedula,
                    id: id


                },
                success: function(data) {
                    location.reload()
                    console.log(data)
                },
                error: function(data) {
                    console.log(data)
                }
            })
        }
        function eliminarPartida(p1, p2, p3) {
            console.log(p1);
            console.log(p2);
            eliminar = p1;
            cedula = p2;
            id = p3


            asignarAtencion();
            $.ajax({
                type: "POST",
                url: "documentos/partidas_nacimiento/cargarPartida.php",
                data: {
                    eliminar: eliminar,
                    cedula: cedula,
                    id: id


                },
                success: function(data) {
                    location.reload()
                    console.log(data)
                },
                error: function(data) {
                    console.log(data)
                }
            })
        }

        function modificar(p1) {
            url = 'modificarBeneficiario.php?cedula=' + p1

            window.location.href = url;
        }
    </script>


    <script>
        var acc = document.getElementsByClassName("accordion2");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>

    <script>
        var acc = document.getElementsByClassName("accordion3");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                    panel.style.maxHeight = null;
                } else {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
        }
    </script>