<div class="loader-section">
    <span class="loader"></span>
</div>





<?php
include_once("partearriba.php")
?>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-chart'></i>
            <span class="link-name">Resumen: </span>
        </div>
    </div>
    <br>
    <?php

    include_once("porcentajePorMes.php");

    ?>



    <!-- Cajas de informacion del dash -->
    <br>
    <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados();
        $sincarnet = $dis->consultageneralsincarnet();

        include_once("../php/01-atenciones.php");
        $aten = new Atenciones(1);

        $atenciones =  $aten->contarTodasAtencionesa();

        ?>
        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-first-aid'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name">Atenciones</span></a>
                    <span class="number"><?php echo count($atenciones) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:75%;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-id-card'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name"><a href="sincarnet.php">Sin carnet </a></span>
                    <span class="number"><?php echo count($sincarnet) ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:75%;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="sincarnet.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

        <div class="box box1">
            <div class="contenedor-box">


                <div class="boxes1">
                    <div class="cont-box">
                        <i class='bx bx-group'></i>
                    </div>
                </div>
                <div class="boxes2">
                    <span class="link-name"><a href="Beneficiarios.php">Beneficiarios </a></span>
                    <span class="number"><?php echo count($consulta); ?></span>
                    <div class="progress">
                        <div class="progress-bar" style="width:75%;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="Beneficiarios.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

    </div>


    <div class="resumen">
       
        <?php if ($gerencia == "3Gtnd" || $rol == "Superusuario" || $gerencia == "4Gtno") { ?>
            <div class="cards">
                <?php

                include_once("../php/04-taller.php");
                $aten = new taller(1);
                $consulta = $aten->consultarTodosTaller();
                $talleres = count($consulta);

                ?>
                <div class="content">
                    <h2><?php echo $talleres ?></h2>
                    <h3>Talleres total:</h3>
                    <p></p>
                    <a href="08-desarrolloSocial-talleres.php">Ir</a>
                </div>
            </div>



            <div class="cards">
                <?php
                include_once("../php/05-encuentro.php");
                $aten = new encuentro(1);
                $consulta = $aten->consultarTodosEncuentro();
                $encuentros = count($consulta);
                ?>
                <div class="content">
                    <h2><?php echo $encuentros ?></h2>
                    <h3>Encuentros total:</h3>
                    <p></p>
                    <a href="10-encuentros.php">Ir</a>
                </div>
            </div>

            <div class="cards">
                <?php
                include_once("../php/7-escuela-comunitaria.php");
                $esc = new escuela(1);
                $contar = $esc->consultarTodasEscuelas();

                ?>
                <div class="content">
                    <h2><?php echo count($contar) ?></h2>
                    <h3>Cursos:</h3>
                    <p></p>
                    <a href="12-D-escuela-comunitaria.php">Ir</a>
                </div>
            </div>
        <?php } ?>
        <?php if ($gerencia == "2Atc" || $rol == "Superusuario" || $gerencia == "4Gtno") { ?>
            <div class="cards">
                <div class="content">
                    <?php
                    include_once("../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultarTodosAtencionesa();
                    $atenciones = count($consulta);
                    ?>
                    <h2><?php echo $atenciones ?></h2>
                    <h3>Atenciones OAC</h3>
                    <p></p>
                    <a href="01,5-atencionRecibida.php">Ir</a>
                </div>
            </div>
            <div class="cards">
                <?php
                include_once("../php/02-jornadas.php");
                $aten = new Jornadas(1);
                $consulta = $aten->consultarTodosJornadas();
                $jornadas = count($consulta);
                ?>
                <div class="content">
                    <h2><?php echo $jornadas ?></h2>
                    <h3>Jornadas total:</h3>
                    <p></p>
                    <a href="02-jornadas.php">Ir</a>
                </div>
            </div>
        <?php } ?>
        <?php if ($gerencia == "5Logi" || $rol == "Superusuario") { ?>
            <div class="cards">
                <?php
                include_once("../php/01-02-cita_protesis.php");
                $aten = new citas_protesis(1);
                $consulta = $aten->consultarTodasCitasDadas();
                $citas = count($consulta);
                ?>
                <div class="content">
                    <h2><?php echo $citas ?></h2>
                    <h3>Orts. y protesis:</h3>
                    <p></p>
                    <a href="04-ort-citaDada.php">Ir</a>
                </div>
            </div>


            <div class="cards">
                <?php
                include_once("../php/01-03-toma_medidas.php");
                $aten = new toma_medidas(1);
                $consulta = $aten->consultarTodasMedidasDadas();
                $Pruebas = count($consulta);
                ?>
                <div class="content">
                    <h2><?php echo $Pruebas ?></h2>
                    <h3>Toma de medidas:</h3>
                    <p></p>
                    <a href="04-tomasAsignadas.php">Ir</a>
                </div>
            </div>

            <div class="cards">
                <?php
                include_once("../php/01-04-pruebaArtificio.php");
                $aten = new prueba_artificio(1);
                $consulta = $aten->consultarTodasPruebasDadas();
                $prueba = count($consulta);
                ?>
                <div class="content">
                    <h2><?php echo $prueba ?></h2>
                    <h3>Pruebas Art:</h3>
                    <p></p>
                    <a href="05-pruebaDada.php">Ir</a>
                </div>
            </div>



        <?php } ?>
    </div>



    <?php
    include_once("parteabajo.php")
    ?>




    <script>
        function pageLoaded() {
            let loaderSection = document.querySelector('.loader-section');
            loaderSection.classList.add('loaded');
        }

        window.addEventListener('load', pageLoaded);
    </script>