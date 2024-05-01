
    <?php
    include_once("partearriba.php");
    ?>

    <div class="dash-contenido">
        <div class="overview">
            <div class="titulo">
                <i class='bx bxs-dashboard'> </i>
                <span class="link-name">Audiometria: <?php echo $rol ?></span>
            </div>
        </div>

        <div class="boxes">

                    <?php 
                        include_once("../php/01-discapacitados.php");
                        $dis = new Discapacitados(1);

                        $consulta = $dis->consultarTodosDiscapacitados();
                        $sincarnet = $dis->consultageneralsincarnet();

                        include_once("../php/01-atenciones.php");
                        $aten = new Atenciones(1);

                       $atenciones =  $aten ->contarTodasAtencionesa();
                        
                    ?>
        <div class="box box1">
            <i class='bx bx-first-aid'></i>
            <span class="link-name">Atenciones</span>
            <span class="number"><?php echo count($atenciones) ?></span>
        </div>

        <div class="box box2">
            <i class='bx bxs-user-badge'></i>
            <span class="link-name"><a href="sincarnet.php">Sin certificado</a></span>
            <span class="number"><?php echo count($sincarnet) ?></span>
        </div>

        <div class="box box3">
            <i class='bx bx-group'></i>
            <span class="link-name"><a href="Beneficiarios.php">Beneficiarios </a></span>
            <span class="number"><?php echo count($consulta); ?></span>

        </div>
 </div>

        <div class="reportes-totales">

            <!-- reportes 1 -->
            <div class="reporte">
                <a href="04-ortesisyProtesis.php">Citas</a>
            </div>
            <div class="reporte">
                <a href="">Prueba de artificio</a>
            </div>
            <!-- <div class="reporte">
            <a href=""></a>
        </div>
        <div class="reporte">
            <a href=""></a>
        </div> -->
            <!-- reportes 1 -->

            <!-- reportes 1 -->
        </div>

       
        <div class="tabla-atencion">
            <div class="personas-conatencion"><a class="enlace"href="07-audiometriaRecibida.php">Citas dadas de audiometria</a></div>
            <h2>Audiometrias por hacer</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>id de la cita</th>
                        <th>Atencion Solicitada</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/01-06-audiometria.php");
                    $aten = new audiometria(1);
                    $consulta = $aten->consultarTodasCitasSindar();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["atencion_solicitada"] ?></td>
                                <td style="color: red;">Sin dar cita</td>
                                <td><a href="07-asignarAudiometria.php?id=<?php echo $registros["id"] ?>">Dar cita</a></td>
                                <td><a href="eliminar/eliminara_audio.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>

 <?php
     include_once("parteabajo.php");
 ?>


