<?php
include_once("partearriba.php");
?>
<!-- contenido -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Registro de beneficiario: <?php echo $rol ?> </span>
        </div>
    </div>
    <section class="modal">


        <div class="modal__container">
            <div class="modal__header">
                <a href="" class="modal__close">Cerrar</a>
            </div>
            <h4>Resultados de busqueda:</h4>

            <div class="resumen" id="resumen__search" style="margin-top: 0; flex-direction:column; align-items:normal">


            </div>


        </div>

    </section>

    <?php if ($rol == "Superusuario" || $rol=="Administrador") { ?>

        <div class="botones-header">
            <a href="reportes/reportegeneralOAC.php"> <button class="download-button">
                    <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg> Generar Reporte</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>

            <a href="reportes/reporteSemanalOP.php"> <button class="download-button">
                    <div class="docs seis"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Reporte Semanal</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>
            
            <a onclick="BuscarAtencionesMes()"> <button class="download-button">
                    <div class="docs tres"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Reporte: Mensual</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>

            <a href="reportes/reporteDiscapacidadOP.php"> <button class="download-button">
                    <div class="docs cinco"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Reporte: Discapacidad</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>
            <a href="reportes/reporteAyudaTecnicaOP.php"> <button class="download-button">
                    <div class="docs cuatro"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Reporte: Ayuda tecnica</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>

            <a href="reportes/reporteCoordinacionOP.php"> <button class="download-button">
                    <div class="docs dos"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>Reporte: Coordinaciones</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>
            <!-- <a target="_blank" href="respaldo/respaldo.php"> <button class="download-button ">
                    <div class="docs dos"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg> Generar respaldo</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button></a> -->

        </div>
        <div class="reporte">

        </div>
    <?php } ?>

    <div class="saludo">
        <div class="date-saludo">

        </div>
        <div class="contenedor-saludo">
            <div class="text">
                <h1 class="text-saludo">Bienvenido/a, <span style="color:aliceblue"> <?php echo $NombreUsuarioActivo . " [" . $rol . "]"; ?></span></h1>
                <a href="#atenciones"><button class="boton-saludo">
                        ir a la tabla de atenciones
                    </button></a>

            </div>
            <div class="contenedor-img">
                <img src="./img/saludo.png" alt="" srcset="">
            </div>
        </div>
    </div>
    <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados();
        $sincarnet = $dis->consultageneralsincarnet();

        include_once("../php/01-atenciones-estadales.php");
        $aten = new AtencionesEstadales(1);

        $atenciones =  $aten->contarTodasAtencionesa();

        function CalculoPorcentaje($a, $b)
        {

            $porcentaje = (count($a) / count($b)) * 100;
            return $porcentaje;
        }

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
                        <div class="progress-bar" style="width:<?php echo CalculoPorcentaje($atenciones, $consulta)  . "%" ?>;">
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
                        <div class="progress-bar" style="width:<?php echo CalculoPorcentaje($sincarnet, $consulta)  . "%" ?>">
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
                        <div class="progress-bar" style="width:<?php echo (count($consulta) / 1000) * count($consulta) . "%" ?>;">
                            <span class="progress-bar-text"></span>
                        </div>
                    </div>
                    <span> <a href="Beneficiarios.php" class="ir"><i class='bx bxs-right-top-arrow-circle'></i></a></span>
                </div>
            </div>
        </div>

        <!--       <div class="box box2">
            <i class='bx bxs-user-badge'></i>
            <span class="link-name"><a href="sincarnet.php">Sin carnet </a></span>
            <span class="number"><?php echo count($sincarnet) ?></span>
        </div>

        <div class="box box3">
            <i class='bx bx-group'></i>
            <span class="link-name"><a href="Beneficiarios.php">Beneficiarios </a></span>
            <span class="number"><?php echo count($consulta); ?></span>

        </div> -->
    </div>




    <!-- Graficas dia, mes, año -->
    <canvas id="graficasXestados"></canvas>
    <canvas id="graficasXdiscapacidadES" class="chart2" style="height: 200px;"></canvas> <!-- Graficas general -->
    <div class="graficas">
        <div class="tarjetas-graficas">
            <canvas id="graficasXdiscapacidad"></canvas>
        </div>
        <div class="tarjetas-graficas">
            <canvas id="grafica_sexo"></canvas>
        </div>

    </div>
    <div class="graficas">
        <!-- Cargar archivos -->

        <div class="tarjetas-graficas dos">


            <form class="upload">
                <div class="upload_body">
                    <i class='bx bx-file'></i>
                    <p id="texto_upload">Arrastra archivo para cargar</p>


                </div>

                <div class="btn-conteiner">
                    <a class="btn-content" href="Archivos.php">
                        <span class="btn-title">Ver archivos</span>
                        <span class="icon-arrow">
                            <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                    <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                    <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                </g>
                            </svg>
                        </span>
                    </a>
                </div>


                <!-- <footer class="upload_footer">
                            <label for="upload_input" class="upload_buttom" >
                                <p><span>or</span> choose file</p>
                                <input type="file" id="upload_input" />
                            </label>

                        
                        </footer> -->
                <!--  <input type="submit" class="btnText"> -->
            </form>
        </div>


        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por edad</h2>
            <canvas id="graficaporedad"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones totales por año</h2>
            <canvas id="bar-chart2"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por meses</h2>
            <canvas id="bar-chart3"></canvas>
        </div>
    </div>
    <div class="graficas">
        <!-- Cargar archivos -->





        <canvas id="grafica_tipoayuda" style="height: 200px"></canvas>



    </div>

    <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "coorA") { ?>
        <div class="acordeon">
            <br>

            <div class="tab">
                <input type="checkbox" name="acc" id="acc1">
                <label for="acc1">
                    <h2>C-E</h2>
                    <h3> Lista de coordinaciones por estado</h3>
                </label>
                <div class="tab-background"></div>
                <div class="content">


                    <div class="resumen">


                        <?php
                        include_once("../php/10-coordinaciones-estadales.php");
                        $dis = new Coordinacion(1);

                        $consulta = $dis->consultarCoordinacionesXatenciones();

                        foreach ($consulta as $registros) {

                        ?>

                            <div class="cardd">
                                <div class="title">
                                    <span>

                                    </span>
                                    <p class="title-text">
                                        atenciones
                                    </p>
                                    <p class="percent">

                                        <?php echo $registros["atenciones"] ?>
                                    </p>
                                </div>
                                <div class="data">
                                    <p>
                                        <a href="14,1-verCoodinacion.php?coordinacion=<?php echo $registros["coordinacion"] ?>" class="enlace_especial"><?php echo $registros["nombre_coordinacion"] ?></a>
                                    </p>

                                    <div class="range">
                                        <div class="fill">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php
                        }

                        $dis->__destruct();

                        ?>


                    </div>
                </div>
            </div>
        </div>

    <?php } ?>

    <div class="reportes-totales">
        <?php
        include_once("../php/01-atenciones-estadales.php");
        $aten = new AtencionesEstadales(1);
        $consulta = $aten->consultarTodosAtencionesPorStatus();
        $cantidadRegistros = count($consulta);

        $atendido = 0;
        $seguimiento = 0;
        $sinatender = 0;
        $espera = 0;

        if ($consulta) {
            foreach ($consulta as $registros) {

                if ($registros["statu"] == "Atendido") {
                    $atendido = $registros["cantidades"];
                }

                if ($registros["statu"] == "En seguimiento") {
                    $seguimiento = $registros["cantidades"];
                }

                if ($registros["statu"] == "Sin atencion") {
                    $sinatender = $registros["cantidades"];
                }

                if ($registros["statu"] == "En espera") {
                    $espera = $registros["cantidades"];
                }
            }
        }

        ?>



        <div class="reporte">
            <h3>Solicitudes: <b style="color: orange">En seguimiento</b></h3>
            <div class="detalles">
                <details>
                    <h1 style="color: orange"><?php echo $seguimiento; ?></h1>
                    <!-- <h6 class="exito">+2%</h6> -->
                </details>
                <p class="detalles-texto">Hay <?php echo $seguimiento; ?> personas en seguimiento, sigamos asi.</p>
            </div>
        </div>

        <div class="reporte">
            <h3>Solicitudes: <b style="color: #0e9cd4;">En espera</b></h3>
            <div class="detalles">
                <details>
                    <h1 style="color: #0e9cd4;"><?php echo $espera; ?></h1>
                    <!--     <h6 class="exito">+2%</h6> -->
                </details>
                <p class="detalles-texto">Hay <?php echo $espera; ?> personas en espera, sigamos asi.</p>
            </div>
        </div>

        <div class="reporte">
            <h3>Solicitudes: <b style="color: green;">Atendidas</b></h3>
            <div class="detalles">
                <details>
                    <h1 style="color: green;"><?php echo $atendido; ?></h1>
                    <!-- <h6 class="exito">+2%</h6> -->
                </details>
                <p class="detalles-texto">Se han atendido <?php echo $atendido; ?> personas en total</p>
            </div>
        </div>

        <div class="reporte">
            <h3>Solicitudes: <b style="color: red;">Sin atender</b></h3>
            <div class="detalles">
                <details>
                    <h1 style="color: red;"><?php echo $sinatender; ?></h1>
                    <!--  <h6 class="exito">+2%</h6> -->
                </details>
                <p class="detalles-texto">Faltan <?php echo $sinatender; ?> personas en total para atender, sigamos asi.</p>
            </div>
        </div>


    </div>



    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div class="botones__especiales">
                <button class="Btn export">

                    <div class="sign">
                        <i class='bx bx-export'></i>
                    </div>

                    <div class="text_boton"><a class="enlace_especial" href="01-remitidos_oac.php"> Remitidos a otras</a></div>

                </button>
                <button class="Btn import">

                    <div class="sign">
                        <i class='bx bx-import'></i>
                    </div>

                    <div class="text_boton"> <a class="enlace_especial" href="01-remitidos_a.php">Remitidos a gerencia</a> </div>
                </button>
                <button class="Btn guide">

                    <div class="sign"><i class='bx bx-user-voice'></i></div>

                    <div class="text_boton"><a class="enlace_especial" href="14,6-orientacionesEstadales.php"> Orientados</a></div>
                </button>



            </div>



            <a class="enlace" href="14,5-atencionEstadalRecibida.php">Personas con atenciones recibidas</a>

        </div>
        <h2>Personas para atencion estadal</h2>


        <!-- <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div>
        <br> -->

        <table id="atencionE">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Area de registro</th>
                    <th>Status</th>
                    <th>Solicitud</th>
                    <th></th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody id="atenciones">

                <?php
                include_once("../php/01-atenciones-estadales.php");
                $aten = new AtencionesEstadales(1);
                if ($coordi) {
                    $aten->setcoordinacion($coordi);
                    $consulta = $aten->consultarTodosAtenciones();
                } else {
                    $consulta = $aten->consultarTodosAtencionesAdmin();
                }

                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><a class="cedula" id="verBeneficiario" href="modificarAtencionOP.php?numero_aten=<?php echo $registros['numero_aten']; ?>"><?php echo $registros["numero_aten"] ?></a></td>
                            <td><a class="cedula" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["nombre_estado"] ?></td>
                            <td><?php echo $registros["nombre_e"] ?></td>

                            <td style="color: blue;">Coordinacion Estadal [<?php echo $registros["nombre_coordinacion"] ?>]</td>

                            <?php if ($registros["atencion_solicitada"]) { ?>
                                <td>
                                    <a class="cargar-solicitud" href="reportes/reporteCargarSolicitudesOP.php?numero_aten=<?php echo $registros["numero_aten"]; ?>"><?php echo $registros["atencion_solicitada"] ?></a>

                                </td>
                            <?php } else { ?>
                                <td><a class="cargar" id="cargar" onclick='cargar(<?php echo $registros["numero_aten"] ?>)'>Solicitud</a></td>
                            <?php  } ?>


                            <?php if ($registros["statu"] == "Sin atencion") { ?><!-- OJO: Mejorar -->

                                <td style="color: red;"><?php echo $registros["statu"]; ?></td>
                            <?php } else if ($registros["statu"]) { ?>
                                <td style="color:#0e9cd4;"><?php echo $registros["statu"]; ?></td>
                            <?php } ?>
                            <td><a href="14,3-asignarAtencionEstadal.php?numero_aten=<?php echo $registros["numero_aten"] ?>">Dar atencion</a></td>
                            <td><a href="01,10-seguimiento_estadal.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="remitir"> Seguimiento</a></td>
                            <?php if ($rol == "Superusuario" || $rol == "Administrador") { ?>
                                <td><a onclick='eliminar(<?php echo $registros["numero_aten"]; ?>)' class="eliminar">Eliminar Reg</a></td>
                            <?php } else {
                                echo "<td></td>";
                            } ?>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<!--Javascript del acordeon-->
<script>
    var acc = document.querySelectorAll(".acordeon .tab input[type='checkbox']");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("change", function() {
            var panel = this.nextElementSibling.nextElementSibling.nextElementSibling;
            if (this.checked) {
                panel.style.maxHeight = panel.scrollHeight + "px";
                panel.style.transform = "scaleY(1)";
            } else {
                panel.style.maxHeight = null;
                panel.style.transform = "scaleY(0)";
            }
            saveAccordionState();
        });
    }

    function saveAccordionState() {
        var state = [];
        for (i = 0; i < acc.length; i++) {
            state.push(acc[i].checked);
        }
        localStorage.setItem("accordionState", JSON.stringify(state));
    }

    function restoreAccordionState() {
        var state = JSON.parse(localStorage.getItem("accordionState"));
        if (state) {
            for (i = 0; i < acc.length; i++) {
                acc[i].checked = state[i];
                var panel = acc[i].nextElementSibling.nextElementSibling.nextElementSibling;
                if (state[i]) {
                    panel.style.maxHeight = panel.scrollHeight + "px";
                    panel.style.transform = "scaleY(1)";
                } else {
                    panel.style.maxHeight = null;
                    panel.style.transform = "scaleY(0)";
                }
            }
        }
    }

    window.addEventListener("pageshow", restoreAccordionState);
</script>

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script>
    $(document).ready(function() {
        $("#buscador").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#atenciones tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    function cargar(p1) {
        var id = p1;

        Swal.fire({
            title: 'Carga de solicitud a este beneficiario/a? ',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Cargar',
            confirmButtonColor: '#1AA83E',
            html: '<label>Elige una solicitud</label><br>' +
                '<select name="atencion_recibida" id="atencion_recibida" require>' +
                '<option value="1-silla.r">Silla de ruedas estandar</option>' +
                '<option value="1.1-S.E16">Silla de rueda ergonomica N16</option>' +
                '<option value="1.2-S.E14">Silla de rueda ergonomica N14</option>' +
                '<option value="1.3-S.E18">Silla de rueda ergonomica N18</option>' +
                '<option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>' +
                '<option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>' +
                '<option value="2-MuletasS">Muletas talla S</option>' +
                '<option value="2-MuletasM">Muletas talla M</option>' +
                '<option value="2-MuletasL">Muletas talla L</option>' +
                '<option value="-MuletasCa">Muletas canadienses</option>' +
                '<option value="3-baston">Baston de 1 punto</option>' +
                '<option value="4-baston.p">Baston de 4 puntas</option>' +
                ' <option value="-bastonRas">Baston de rastreo</option>' +
                '<option value="6-andadera">Andadera</option>' +
                '<option value="7-CamaCli">Cama Clinica</option>' +
                '<option value="8-Col-Anti">Colchon Antiescara</option>' +
                ' <option value="1.6-SRB">Silla de ruedas bariátricas</option>' +
                '<option value="1.7-COP">Coche ortopédico pediátrico</option>' +
                '<option value="9-felula">Férula</option>' +
                '<option value="11-panales">Pañales</option>' +
                '<option value="otros">otros</option>' +

                '</select>',
            denyButtonText: `No cargar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                atencion_recibida = $('#atencion_recibida option:selected').text();
                if (atencion_recibida == "otros") {

                    var inputValue = "";

                    const {
                        value: atencion
                    } = Swal.fire({
                        title: 'Agrega la solicitud personalizada',
                        input: 'text',
                        inputLabel: 'Introduce la solicitud',
                        inputValue: inputValue,
                        showCancelButton: true,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Debes escribir algo'
                            }

                            if (value) {
                                atencion_recibida = value;

                                $.ajax({
                                    type: "POST",
                                    url: "../php/procesamientosolicitud_estadal.php",
                                    data: {
                                        id: id,
                                        atencion_recibida: atencion_recibida

                                    },
                                    success: function(data) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: data
                                        }).then(function() {
                                            window.location = "14-coordinacionesEstadales.php";
                                        })

                                        if (!data) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: "No se pudo registrar la solicitud, verifique datos"
                                            }).then(function() {
                                                window.location = "14-coordinacionesEstadales.php";
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
                        }

                    })


                } else {
                    $.ajax({
                        type: "POST",
                        url: "../php/procesamientosolicitud_estadal.php",
                        data: {
                            id: id,
                            atencion_recibida: atencion_recibida

                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: data
                            }).then(function() {
                                window.location = "14-coordinacionesEstadales.php";
                            })

                            if (!data) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo registrar la solicitud, verifique datos"
                                }).then(function() {
                                    window.location = "14-coordinacionesEstadales.php";
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




            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })



    }

    function eliminar(p1) {


        var id = p1;
        console.log(id);


        Swal.fire({
            icon: "question",
            title: '¿Desea eliminar esta atencion?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `No eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                $.ajax({
                    type: "GET",
                    url: "eliminar/eliminar_atencion_estadal.php",
                    data: {
                        id: id


                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Eliminacion de atencion',
                            'text': 'Se elimino correctamente esta atencion',
                            'confirmButton': 'btn btn-success'
                        }).then(function() {
                            window.location = "14-coordinacionesEstadales.php";
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
<!-- <script src="main.js"></script> -->
<script src="mainEstadal.js"></script>
<!-- <script src="graficas_ayudas_tec/graficas.js"></script> -->
<script src="archivos.js"></script>


<!-- END Tablas -->





<?php
include_once("parteabajo.php");
?>
<script src="graficas/graficasEstadales/buscarAtencionesMes.js"></script>