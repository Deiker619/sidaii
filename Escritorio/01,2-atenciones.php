<?php
include_once("partearriba.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atención al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>
    <!-- Boton de reporte -->
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

    <div class="saludo">
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
    </div>


    <div class="boxes">

        <?php
        include_once("../php/01-discapacitados.php");
        $dis = new Discapacitados(1);

        $consulta = $dis->consultarTodosDiscapacitados() ?? 0;
        $sincarnet = $dis->consultageneralsincarnet() ?? 0;

        include_once("../php/01-atenciones.php");
        $aten = new Atenciones(1);

        $atenciones =  $aten->contarTodasAtencionesa() ?? 0;

        function CalculoPorcentaje($a, $b)
        {


            $porcentaje = (count($a) / count($b)) * 100;

            if ($porcentaje) {
                return $porcentaje;
            } else {
                $porcentaje = 0;
                return $porcentaje;
            }
        }
        ?>

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
                    <p id="texto_upload"><label for="upload-btn">Arrastra archivo para cargar o presiona click en las letras</label></p>


                </div>

                <div class="btn-conteiner">
                    <div class="btns-upload">
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
                        <div class="upload" style="display: none;">
                            <button type="button" class="btn-warning">
                                <i class="fa fa-upload"></i> Buscar documento
                                <input type="file" id="upload-btn">
                            </button>
                        </div>
                    </div>
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


    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div class="botones__especiales">

                <button class="Btn export">

                    <div class="sign">
                        <i class='bx bx-export'></i>
                    </div>

                    <div class="text_boton"><a class="enlace_especial" href="01-remitidos_oac.php"> Remitidos de oac</a></div>
                </button>
                <button class="Btn import">

                    <div class="sign">
                        <i class='bx bx-import'></i>
                    </div>

                    <div class="text_boton"> <a class="enlace_especial" href="01-remitidos_a.php">Remitidos a oac</a> </div>
                </button>
                <button class="Btn guide">

                    <div class="sign"><i class='bx bx-user-voice'></i></div>

                    <div class="text_boton"><a class="enlace_especial" href="01,11-orientados.php"> Orientados</a></div>
                </button>
                <button class="Btn guide solicitud">

                    <div class="sign"><i class='bx bx-accessibility'></i></div>

                    <div class="text_boton"><a class="enlace_especial" href="01,12-solicitudes.php"> Solicitudes</a></div>
                </button>
                <?php if ($rol == "Superusuario" || $rol == "Administrador") { ?>

                    <button class="Btn guide usuario">

                        <div class="sign"><i class='bx bx-user-check'></i></div>

                        <div class="text_boton"><a class="enlace_especial" href="actividad_usuarios.php"> Actividad de usuarios</a></div>
                    </button>

                <?php } ?>




            </div>



            <a class="enlace" href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a>


        </div>
        <h2>Personas sin Atencion</h2>

        <!--  <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div>
        <br> -->


        <table id="atencion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Promotor</th>
                    <th>Solicitud</th>
                    <th>Informe</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                    <th></th>

                    <?php if ($rol == "Administrador" || $rol == "Superusuario") { ?>
                        <th></th>
                    <?php } ?>


                </tr>
            </thead>
            <tbody id="atenciones">


                <?php
                include_once("../php/01-atenciones.php");
                $aten = new Atenciones(1);
                $consulta = $aten->consultarTodosAtenciones();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td class="sorting_1 <?php echo $registros['urgencia'] ?>"><a class="cedula" id="verBeneficiario" <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "Coordinador") { ?> href="modificarAtencionOAC.php?numero_aten=<?php echo $registros['numero_aten']; ?>" <?php } ?>><?php echo $registros["numero_aten"] ?></a></td>
                            <td> <a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["nombre_estado"] ?></td>
                            <td><?php echo $registros["nombre_e"] ?></td>
                            <td>
                                <div style="display: inline-flex; position: relative;">
                                    <?php if ($registros['institucion']) { ?>
                                        <b><small class="tag <?php echo $registros['institucion'] ?>">#<?php echo $registros['institucion']; ?></small></b>
                                    <?php  } ?>
                                    <?php echo $registros["promotor"] ?>
                                </div>
                            </td>



                            <?php if ($registros["atencion_solicitada"]) { ?>

                                <td>


                                    <div style="display:flex;flex-direction:column;gap:6px;align-items:center;">
                                        <?php
                                            $sol = $registros["atencion_solicitada"];
                                            if (strpos($sol, '-') !== false) { ?>
                                                <a class="cargar" style="padding:4px 8px;" onclick='cargar(<?php echo $registros["numero_aten"] ?>)'>Solicitud</a>
                                            <?php } else { ?>
                                                <a class="cargar-solicitud" href="reportes/reporteCargarSolicitudes.php?numero_aten=<?php echo $registros["numero_aten"]; ?>"><?php echo htmlspecialchars($sol); ?></a>
                                            <?php }
                                        ?>
                                    </div>





                                <?php } else { ?>
                                <td><a class="cargar" id="cargar" onclick='cargar(<?php echo $registros["numero_aten"] ?>)'>Solicitud</a></td>
                            <?php  } ?>
                            <?php if (!$registros["informe"]) { ?>
                                <td>
                                    <i class="bx bxs-file-pdf" onclick="subirArchivo(<?php echo $registros['numero_aten']; ?>)"></i>
                                    <i class="fa-solid fa-eye eye-icon" onclick="openInput('<?php echo $registros['numero_aten']; ?>')"></i>
                                </td>
                            <?php } else { ?>
                                <td> <a class="informe" id="verBeneficiario" href="documentos/informes/<?php echo $registros['informe']; ?>"> <?php echo "<i class='bx bx-down-arrow-alt'></i>" ?> </a></td>

                            <?php } ?>

                            <?php if ($registros["statu"] == "Sin atencion") { ?><!-- OJO: Mejorar -->

                                <td style="color: red;"><?php echo $registros["statu"]; ?></td>
                            <?php } else if ($registros["statu"]) { ?>
                                <td style="color:#0e9cd4;"><?php echo $registros["statu"]; ?></td>
                            <?php } ?>

                            <td><a href="01,3-asignarAtencion.php?numero_aten=<?php echo $registros["numero_aten"] ?>">Dar atencion</a></td>
                            <td><a href="01,10-seguimiento.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="remitir"> Seguimiento</a></td>
                            <?php if ($rol == "Superusuario" || $rol == "Administrador") { ?>
                                <td><a onclick='eliminar(<?php echo $registros["numero_aten"]; ?>)' class="eliminar">Eliminar Reg</a></td>
                            <?php } ?>
                            <td>
                                <div class="enviar">
                                    <?php if ($registros["atencion_solicitada"]) { ?>
                                        <div class="enviar_text"> <i class='bx bx-mail-send' onclick="enviarEmail('<?php echo $registros['numero_aten'] ?>','<?php echo $registros['email'] ?? null ?>')" style="color:#3ab556; cursor:pointer"></i></div>
                                    <?php } else { ?>

                                        <div class="enviar_text"> <i class='bx bx-no-entry' style="color:crimson; cursor:not-allowed "></i></div>
                                    <?php } ?>
                                </div>
                            </td>

                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>


        </table>
        <footer class="table-footer">
            <div class="urgencia-contenedor">
                <div class="urgencia-color urgente"></div>
                <label for="">Urgente</label>
            </div>
            <div class="urgencia-contenedor">
                <div class="urgencia-color media"></div>
                <label for="">Media</label>
            </div>
            <div class="urgencia-contenedor">
                <div class="urgencia-color baja"></div>
                <label for="">Baja</label>
            </div>
        </footer>
    </div>


    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>

    <script>
        function enviarEmail(a, b) {
            let correo = b
            let email = true;
            let numero_aten = a;

            /* No tiene correo */
            if (correo) {
                Swal.fire({
                    title: "¿Desea enviar el comprobante al correo registrado?",
                    html: "<b>Correo: </b>" + b + "",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Si, enviar!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        asignarAtencion();
                        $.ajax({
                            type: "POST",
                            url: "reportes/enviarEmail.php",
                            data: {
                                numero_aten: numero_aten,
                                correo: correo,

                            },
                            success: function(data) {
                                console.log(data)
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal.stopTimer);
                                        toast.addEventListener('mouseleave', Swal.resumeTimer);



                                    },
                                    willClose: () => {

                                        window.location.href = "01,2-atenciones.php#atenciones"
                                    }
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Enviado exitosamente',
                                });


                            },
                            error: function(data) {
                                console.log(data)
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Oops...',
                                    'text': data
                                })
                            }
                        })
                    }
                });
            } else {
                const {
                    value: atencion
                } = Swal.fire({
                    title: 'Agrega el correo personalizado',
                    input: 'email',
                    inputLabel: 'Introduce el correo para enviar comprobante',
                    inputValue: correo,
                    footer: "Esta persona no tiene correo registrado",
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return 'Debes escribir algo'
                        }

                        if (value) {
                            correo = value;

                            asignarAtencion();
                            $.ajax({
                                type: "POST",
                                url: "reportes/enviarEmail.php",
                                data: {
                                    numero_aten: numero_aten,
                                    correo: correo,

                                },
                                success: function(data) {
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);



                                        },
                                        willClose: () => {

                                            window.location.href = "01,2-atenciones.php#atenciones"
                                        }
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Enviado exitosamente',
                                    });

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
                    }

                })
            }
            /* Si tiene correo */

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

                    asignarAtencion();
                    $.ajax({
                        type: "GET",
                        url: "eliminar/eliminar_atencion.php",
                        data: {
                            id: id


                        },
                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se elimino correctamente esta atencion',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                window.location = "01,2-atenciones.php";
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



        function cargar(p1) {
            var id = p1;
            Swal.fire({
                title: 'Carga de solicitud a este beneficiario/a? ',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Cargar',
                confirmButtonColor: '#1AA83E',
                html: `
                    <div class="search-reports" style="display: flex; gap: 1px; justify-content: center">
                    <div class="reports-contenedor"><label>Elige una solicitud</label><br>
                        <select name="atencion_recibida" id="atencion_recibida" require>' +
                        '<option value="1-silla.r">Silla de ruedas estandar</option>' +
                        '<option value="1.1-S.E16">Silla de rueda ergonomica N16</option>' +
                        '<option value="1.2-S.E14">Silla de rueda ergonomica N14</option>' +
                        '<option value="1.3-S.E18">Silla de rueda ergonomica N18</option>' +
                        '<option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>' +
                        '<option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>' +
                        '<option value="1.6-SRB">Silla de rueda bariátricas</option>' +
                        '<option value="21-sllm">Silla a motor</option>' +
                        '<option value="27-Sllc">Silla de rueda clinica</option>' +
                        '<option value="30-sllsr">Silla sanitaria sin ruedas</option>' +
                        '<option value="31-sllsr">Silla sanitaria con ruedas</option>' +
                        '<option value="2-MuletasS">Muletas talla S</option>' +
                        '<option value="2-MuletasM">Muletas talla M</option>' +
                        '<option value="2-MuletasL">Muletas talla L</option>' +
                        '<option value="-MuletasCa">Muletas canadienses adultos</option>' +
                        '<option value="12-Mucp">Muletas canadienses pediatricas</option>' +
                        '<option value="20-Rglp">Regleta con punzon</option>' +
                        '<option value="6-andadera">Andadera adulto fija</option>' +
                        '<option value="22-Apm">Andadera pediatrica multifuncional</option>' +
                        '<option value="23-Apr">Andadera pediatrica con ruedas</option>' +
                        '<option value="25-Anpp">Andadera pediatrica posterior</option>' +
                        '<option value="26-Anpf">Andadera pediatrica fija</option>' +
                        '<option value="7-CamaCli">Cama Clinica</option>' +
                        '<option value="8-Col-Anti">Colchon Antiescara</option>' +
                        ' <option value="1.6-SRB">Silla de ruedas bariátricas</option>' +
                        '<option value="1.7-COP">Coche ortopédico pediátrico</option>' +
                        '<option value="28-chorm">Coche ortopedico mediano</option>' +
                        '<option value="29-chorg">Coche ortopedico grande</option>' +
                        '<option value="9-felula">Ferula</option>' +
                        '<option value="8-Grab">Grabadora</option>' +
                        '<option value="11-panales">Pañales</option>' +
                        '<option value="12-Pro-aud">Protesis auditivas</option>' +
                        '<option value="13-Pro-cad">Protesis de Cadera</option>' +
                        '<option value="14-Pro-rod">Protesis de rodilla</option>' +
                        '<option value="15-Pro-den">Protesis Dental</option>' +
                        '<option value="11-Coj">Cojin antiescaras</option>' +
                        '<option value="3-baston">Baston de apoyo</option>' +
                        '<option value="4-baston.p">Baston de 4 puntas</option>' +
                        '<option value="21-Btrpd">Baston de rastreo pediatricos</option>' +
                        '<option value="13-Brpl34">Baston de rastreo plegable numero 34</option>' +
                        '<option value="14-Brpl36">Baston de rastreo plegable numero 36</option>' +
                        '<option value="15-Brpl38">Baston de rastreo plegable numero 38</option>' +
                        '<option value="15-Brpl44">Baston de rastreo plegable numero 44</option>' +
                        '<option value="16-Brpl46">Baston de rastreo plegable numero 46</option>' +
                        '<option value="-bastonRas">Baston de rastreo plegable numero 48</option>' +
                        '<option value="18-Brpl50">Baston de rastreo plegable numero 50</option>' +
                        '<option value="19-Brpl52">Baston de rastreo plegable numero 52</option>' +
                        '<option value="5-ap.audio">Aparato de audiometria</option>' +
                        '<option value="otros">otros</option>' +

                    '</select><br>
                    </div>
                    <div class="reports-contenedor">
                    <label>Urgencia</label><br>
                    <select name="urgencia" id="urgencia" require>' +
                    '<option value="urgente">Urgente</option>' +
                    '<option value="media">Media</option>' +
                    '<option value="baja">Baja</option>' +
                   
                    </select>
                    </div></div>`,
                denyButtonText: `No cargar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    atencion_recibida = $('#atencion_recibida option:selected').text();
                    urgencia = $('#urgencia option:selected').val();

                    console.log(urgencia)
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
                                    asignarAtencion();
                                    $.ajax({
                                        type: "POST",
                                        url: "../php/procesamientodecarga_solicitud.php",
                                        data: {
                                            id: id,
                                            atencion_recibida: atencion_recibida,
                                            urgencia: urgencia

                                        },
                                        success: function(data) {
                                            // Actualizar la celda 'Solicitud' en la tabla sin recargar
                                            try {
                                                var idRow = id;
                                                var texto = atencion_recibida;
                                                var row = $('td.sorting_1 a.cedula').filter(function() { return $(this).text().trim() == idRow.toString(); }).closest('tr');
                                                if (row.length) {
                                                    row.find('td').eq(7).html('<a class="cargar-solicitud" href="reportes/reporteCargarSolicitudes.php?numero_aten='+idRow+'">'+texto+'</a>');
                                                }
                                            } catch (e) {
                                                console.error(e);
                                            }

                                            Swal.fire({ title: data });

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
                            }

                        })


                    } else {
                        asignarAtencion();
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientodecarga_solicitud.php",
                            data: {
                                id: id,
                                atencion_recibida: atencion_recibida,
                                urgencia: urgencia

                            },
                            success: function(data) {
                                    // Actualizar la celda 'Solicitud' en la tabla sin recargar
                                    try {
                                        var idRow = id;
                                        var texto = atencion_recibida;
                                        var row = $('td.sorting_1 a.cedula').filter(function() { return $(this).text().trim() == idRow.toString(); }).closest('tr');
                                        if (row.length) {
                                            row.find('td').eq(7).html('<a class="cargar-solicitud" href="reportes/reporteCargarSolicitudes.php?numero_aten='+idRow+'">'+texto+'</a>');
                                        }
                                    } catch (e) {
                                        console.error(e);
                                    }

                                    Swal.fire({ icon: 'success', title: data });

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




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }
    </script>
    <!-- <script src="graficas_ayudas_tec/graficas.js"></script> -->
    <script src="archivos.js"></script>

    <script>
        function subirArchivo(a) {
            var numero_aten = a;
            Swal.fire({
                title: 'Cargar informe medico',
                input: 'file',
                inputAttributes: {
                    accept: ['application/pdf'], // Limita a archivos PDF, puedes ajustar según tus necesidades
                },
                showCancelButton: true,
                confirmButtonText: 'Subir',
                cancelButtonText: 'Cancelar',
            }).then((file) => {
                if (file.isConfirmed && file.value) {
                    // Crear un objeto FormData y agregar el archivo y el número
                    const formData = new FormData();
                    formData.append('archivo', file.value);
                    formData.append('numero_aten', numero_aten);

                    // Hacer la solicitud AJAX utilizando jQuery
                    asignarAtencion();
                    $.ajax({
                        url: 'documentos/informes/cargardocumento.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            console.log(data);
                            try {
                                const dataJ = JSON.parse(data);
                                Swal.fire(dataJ.mensaje, '', 'success').then(function() {
                                    window.location = "01,2-atenciones.php";
                                });

                            } catch (error) {
                                console.error('Error al analizar la respuesta del servidor como JSON:', error);
                                Swal.fire('Error en el formato de la respuesta del servidor', '', 'error');
                            }
                        },
                        error: function(error) {
                            console.error('Error al subir el archivo:', error);
                            Swal.fire('Error al cargar el archivo', '', 'error');
                        }
                    });
                }
            });
        }
    </script>

    <!-- END Tablas -->

    <?php
    include_once("parteabajo.php");
    ?>
    <script src="main.js"></script>
    <script src="script.js"></script>
    <script src="graficas/OAC/buscarAtencionesMes.js"></script>