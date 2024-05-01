<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y Protesis: <?php echo $rol ?></span>
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

        $atenciones =  $aten->contarTodasAtencionesa();

        ?>
        <div class="box box1">
            <i class='bx bx-first-aid'></i>
            <span class="link-name">Atenciones</span>
            <span class="number"><?php echo count($atenciones) ?></span>
        </div>

        <div class="box box2">
            <i class='bx bxs-user-badge'></i>
            <span class="link-name"><a href="sincarnet.php">Sin carnet </a></span>
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
            <a href="04-tomaMedidas.php">Toma de medidas</a>
        </div>
        <div class="reporte">
            <a href="04-ortesisyProtesis.php">Citas</a>
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
        <div class="personas-conatencion"><a class="enlace" href="05-pruebaDada.php">Pruebas hechas</a></div>
        <h2>Pruebas por hacer</h2>
        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>id de la Prueba</th>
            
                    <th>Artificio de prueba</th>
                    <th>Fecha de prueba</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-04-pruebaArtificio.php");
                $aten = new prueba_artificio(1);
                $consulta = $aten->consultarTodasPruebasSindar();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["id"] ?></td>
                    
                            <td><?php echo $registros["nombre_artificio"] ?></td>
                            <td><?php echo $registros["fecha_pruebas"] ?></td>
                            <?php if ($registros["statu"]) {
                                echo '<td>'.$registros["statu"].'</td>';
                            }else{?>
                            <td style="color: red;">Personas sin probar artificio</td>
                            <?php }?>
                            <td><a href="05-asignarPrueba.php?id=<?php echo $registros["id"] ?>">Probar artificio</a></td>
                            <td><a href="" class="eliminar">Eliminar Reg</a></td>
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