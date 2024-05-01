<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: Ayuda Tecnica <?php echo $rol ?></span>
        </div>
    </div>



    <!-- Boton de reporte -->

    <a href="reportes/reportesAyudasTecnica.php"> <button class="download-button">
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
        </button></a>


    <!-- Graficas dia, mes, año -->


    <canvas id="ayudas_tec" height="150px"></canvas>
    <!-- Tablas para mostrar discapacitados y asignar atencion -->

    <div class="tabla-atencion">
        <div class="personas-conatencion"><a class="enlace" href="01,9-ayudasTecRecibida.php">Personas con ayudas tecnicas recibidas</a></div>
        <h2>Personas asignadas para ayudas tecnicas</h2>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>id de atencion</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-01-ayudas_tec.php");
                $aten = new Ayudas_tec(1);
                $consulta = $aten->consultarTodasAyudas_tec();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["nombre_estado"] ?></td>
                            <td><?php echo $registros["nombre_discapacidad"] ?></td>
                            <td><?php echo $registros["id"] ?></td>
                            <td style="color: red;">Sin recibir la ayuda</td>
                            <td><a href="01,7-ayudasTecAsignar.php?id=<?php echo $registros["id"] ?>">Dar ayuda tecnica</a></td>
                            <td><a href="eliminar/eliminarayudatec.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>



    <!-- END Tablas -->

    <?php
    include_once("parteabajo.php");
    ?>