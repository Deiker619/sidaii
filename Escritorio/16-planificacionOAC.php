<?php
include_once("partearriba.php");
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Planifiación y presupuesto <b>OAC</b>: <?php echo $rol ?></span>
        </div>
    </div>
    <?php if ($rol == "Superusuario") { ?>
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
            <a href="reportes/reporteSemanalOAC.php"> <button class="download-button">
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

            <a href="reportes/reporteDiscapacidadOAC.php"> <button class="download-button">
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
            <a href="reportes/reporteAyudaTecnicaOAC.php"> <button class="download-button">
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
    <?php } ?>


    <div class="reporte">

    </div>

    <!--  <div class="saludo">
        <div class="date-saludo">

        </div>
        <div class="contenedor-saludo">
            <div class="text">
                <h1 class="text-saludo">Bienvenido/a, <span style="color:aliceblue"> <?php echo $NombreUsuarioActivo . " [" . $rol . "]"; ?></span></h1>
                <div class="botones-saludo">
                    <a href="#atenciones"><button class="boton-saludo">
                            ir a la tabla de atenciones
                        </button>
                    </a>
                    <a href="01,12-solicitudes.php"><button class="boton-saludo dos">
                            Ver artificios solicitados
                        </button>
                    </a>
                </div>

            </div>
            <div class="contenedor-img">
                <img src="./img/saludo.png" alt="" srcset="">
            </div>
        </div>
    </div> -->


    <!--  <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados();
        $sincarnet = $dis->consultageneralsincarnet();

        include_once("../php/01-atenciones.php");
        $aten = new Atenciones(1);

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
                        <div class="progress-bar" style="width:<?php echo CalculoPorcentaje($sincarnet, $consulta)  . "%" ?>;">
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

    </div>
 -->


    <!-- reportes 1 -->
    <!--   <div class="reportes-totales">
        <div class="reporte">
            <h3>Personas atendidas</h3>
            <div class="detalles">
                <details>
                    <h1>2000</h1>
                    <h6 class="exito">+2%</h6>
                </details>
                <p class="detalles-texto">Se han atendido 2000 personas en total, sigamos asi.</p>
            </div>
        </div> 
    </div> -->
    <!-- reportes 1 -->
    <!--     <div class="reporte">
            <h3>Personas atendidas</h3>
            <div class="detalles">
                <details>
                    <h1>2000</h1>
                    <h6 class="exito">+2%</h6>
                </details>
                <p class="detalles-texto">Se han atendido 2000 personas en total, sigamos asi.</p>
            </div>
        </div> -->
    <!-- reportes 1 -->
    <!-- <div class="reporte">
            <h3>Personas atendidas</h3>
            <div class="detalles">
                <details>
                    <h1>2000</h1>
                    <h6 class="exito">+2%</h6>
                </details>
                <p class="detalles-texto">Se han atendido <i>2000</i> personas en total, sigamos asi.</p>
            </div>
        </div> -->
    <!-- reportes 1 -->
    <!-- <div class="reporte">
            <h3>Personas atendidas</h3>
            <div class="detalles">
                <details>
                    <h1>2000</h1>
                    <h6 class="exito">+2%</h6>
                </details>
                <p class="detalles-texto">Se han atendido 2000 personas en total, sigamos asi.</p>
            </div>
        </div>
    </div>

     Final de reportes -->


    <!-- Graficas dia, mes, año -->
    <canvas id="chart2"></canvas>
    <canvas id="bar-chart" class="chart2" style="height: 200px;"></canvas> <!-- Graficas general -->
    <div class="graficas">
        <div class="tarjetas-graficas">
            <canvas id="graficaspordiscapacidadg"></canvas>
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



    <!-- Graficas dia, mes, año -->

    <!-- Tablas para mostrar discapacitados y asignar atencion -->
    <div class="reportes-totales">
        <?php
        include_once("../php/01-atenciones.php");
        $aten = new Atenciones(1);
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

    <div class="boxes" style="margin-top: 12px; justify-content: space-around; ">
        <div class="cardinfo">
            <?php
                include_once("../php/02-jornadas.php");
                $aten = new Jornadas(1);
                $aten->setid("2Atc");
                $aten->getid();
                $consulta = $aten->consultarTodosJornadasPorGerencia();
                $cantidadRegistros = count($consulta);
            ?>
            <div class="cardinfo-details">
                <p class="cardinfo-title">Jornadas totales</p>
                <h1 class="cardinfo-body"><?php echo $cantidadRegistros ?></h1>
            </div>
            <button class="cardinfo-button">More info</button>
        </div>
        <div class="cardinfo">
        <?php
                    include_once("../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultadeSolicitudesEntregadas();
                    $cantidadRegistros = count($consulta); 
                    ?>
            <div class="cardinfo-details">
                <p class="cardinfo-title">Ayudas tecnicas en total entregadas</p>
                <h1 class="cardinfo-body"><?php echo $cantidadRegistros ?></h1>
            </div>
            <button class="cardinfo-button">More info</button>
        </div>
        <div class="cardinfo">
            <div class="cardinfo-details">
                <p class="cardinfo-title">Encuentros totales</p>
                <h1 class="cardinfo-body"><?php echo $cantidadRegistros ?></h1>
            </div>
            <button class="cardinfo-button">More info</button>
        </div>
        <div class="cardinfo">
            <div class="cardinfo-details">
                <p class="cardinfo-title">Beneficiarios atendidos totales</p>
                <h1 class="cardinfo-body"><?php echo $cantidadRegistros ?></h1>
            </div>
            <button class="cardinfo-button">More info</button>
        </div>

    </div>

    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-bar-chart-alt-2'></i>
            <span class="link-name">Solicitudes <b>OAC</b></span>
        </div>
    </div>

    <div class="graficas">
        <div class="tabla-atencion">


            <h2 style="color: red">Solicitudes</h2>
            <table id="atencion">
                <thead>
                    <tr>

                        <th>Nombre de la solicitud</th>
                        <th>Cantidad</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultadeSolicitudes();
                    $cantidadRegistros = count($consulta);

                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["atencion_solicitada"] ?></td>
                                <td><?php echo $registros["cantidad"] ?></td>

                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="tabla-atencion">


            <h2 style="color:green">Artificios entregados</h2>
            <table id="atencion">
                <thead>
                    <tr>

                        <th>Nombre de la solicitud</th>
                        <th>Cantidad</th>


                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultadeSolicitudesEntregadas();
                    $cantidadRegistros = count($consulta);

                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["atencion_solicitada"] ?></td>
                                <td><?php echo $registros["cantidad"] ?></td>

                            </tr>
                    <?php
                        }
                    } else {
                        echo "Ocurrió un error para mostrar datos";
                    }
                    ?>

                </tbody>
            </table>
        </div>

    </div>

    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-bar-chart-alt-2'></i>
            <span class="link-name">Jornadas <b>OAC</b></span>
        </div>
    </div>

    <div class="tabla-atencion">


        <h2>Jornadas en total realizadas</h2>
        <table id="atencion">
            <thead>
                <tr>

                    <th>Gerencia</th>
                    <th>Cantidad de Jornadas realizadas</th>


                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/02-jornadas.php");
                $aten = new Jornadas(1);
                $aten->setid("2Atc");
                $aten->getid();
                $consulta = $aten->consultarTodosJornadasPorGerencia();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["Nombre"]; ?></td>
                            <td><?php echo $registros["cantidad_jornadas"]; ?></td>

                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
        <h2>JORNADAS </h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>Estado</th>
                    <th>Municipio</th>
                    <th>Parroquia</th>
                    <th>Numero de Personas a atender</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/02-jornadas.php");
                $aten = new Jornadas(1);
                $consulta = $aten->consultarTodosJornadas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {

                    foreach ($consulta as $registros) {
                        if ($registros["gerencia"] == "2Atc") {
                ?>
                            <tr>

                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["nombre_parroquia"] ?></td>
                                <td><?php echo $registros["numero_personas"] ?></td>
                                <td><a href="02-AsignarJornada.php?id=<?php echo $registros["id"] ?>">Ver jornada</a></td>
                                <?php if ($rol == "Superusuario") { ?>
                                    <td><a onClick="eliminar(<?php echo $registros["id"] ?>)" class="eliminar">Eliminar Reg</a></td>
                                <?php } else {
                                    echo "<td></td>";
                                } ?>
                            </tr>
                <?php
                        }
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


</div>

</div>
<?php
include_once("parteabajo.php");
?>
<script src="main.js"></script>
<script src="script.js"></script>
<script src="graficas/OAC/buscarAtencionesMes.js"></script>