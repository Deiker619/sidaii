<?php
include_once("partearriba.php");
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Operacion estadal: <?php echo $rol ?></span>
        </div>
    </div>


   <!--  <a href="reportes/reportes_oac.php"> <button class="download-button">
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
        </button></a> -->
    <div class="tabla-atencion" id="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->




<!-- 
        <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div> -->
        <br>

        <h2>Personas con atencion</h2>
        <h2>Total: <?php include_once("../php/01-atenciones-estadales.php");
                    $aten = new AtencionesEstadales(1);
                    if($rol =="Superusuario"){  /* 22/8/2023     */
                        $consulta = $aten->consultarTodosAtencionesa();
                    }else{
                        $aten->setcoordinacion($coordi);
                        $consulta = $aten->consultarTodosAtencionesaPOR();
                    }
                    echo count($consulta); ?></h2>

        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Asis. Recibida</th>
                    <th>Ayuda. tecnica</th>
                    <th>Status</th>
                    <th></th>
                    <!-- <th></th>
                    <th></th> -->
                </tr>
            </thead>
            <tbody id="refresh">
                <?php



                include_once("../php/01-atenciones-estadales.php");
                $aten = new AtencionesEstadales(1);
                if($rol =="Superusuario" || $rol=="Administrador"){  /* 22/8/2023     */
                    $consulta = $aten->consultarTodosAtencionesa();
                }else{
                    $aten->setcoordinacion($coordi);
                    $consulta = $aten->consultarTodosAtencionesaPOR();
                }
                
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {

                        echo '<tr>

                             <td>' . $registros["cedula"] . '</td>' .
                            '<td>' . $registros["nombre"] . '</td>' .
                            '<td>' . $registros["apellido"] . '</td>' .
                            '<td>' . $registros["nombre_estado"] . '</td>' .
                            '<td>' . $registros["nombre_e"] . '</td>' .
                            '<td>' . $registros["atencion_brindada"] . '</td>' .
                            '<td>' . $registros["atencion_recibida"] . '</td>' .
                            '<td style="color: green;">Atendido</td>';
                            if($registros["atencion_brindada"]=="-ayudatec"){?>
                                <td style="padding: 0;"><a href="reportes/reporteAtencionOP.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="cargar" style="margin: 5px" > <i class='bx bx-download'></i></a></td>
                                <?php
                              }else{
                                  echo '<td></td>';
                              }
                    }
                }
                ?>


            </tbody>
        </table>
    </div>

    <canvas id="graficaxbrindada" class="chart2" style="width: 300px; height:100px"></canvas>

    <script>
        $(document).ready(function() {
            $("#buscador").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#refresh tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                });
            });

        });
    </script>
    <?php
    include_once("parteabajo.php");
    ?>
        <script src="graficas/graficasEstadales/graficasAtencionesRecibidas.js"></script>