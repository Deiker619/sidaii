<?php
include_once("partearriba.php");
?>


<!-- contenido -->
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

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Remiciones: <?php echo $rol ?></span>
        </div>
    </div>



    <div class="tabla-atencion">
        <div class="personas-conatencion">



        </div>
        <h2>Personas remitidas</h2>
        <table>
            <thead>
                <tr>
                    <th>Beneficiario</th>
                    <th>Remitido por</th>
                    <th>Fecha de remicion</th>
                    <th>remitido a</th>
                    <th>Motivo</th>
                    <th>Status</th>


                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/6-remitir.php");

                $aten = new remitido(1);

                if ($rol == "Superusuario") {
                    $consulta = $aten->consultarTodosRemitidosSUPERADMIN();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                        ?>
                            <tr>

                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["por"] . " <span style='color: blue;'><b>[" . $registros["gerencia_remitente"] . "]</b></span>" ?></td>
                                <td><?php echo $registros["fecha"] ?></td>
                                <td><?php echo $registros["departamento"] ?></td>
                                <td><?php echo $registros["motivo"] ?></td>

                                <?php if ($registros["statu"] == "Aceptado") { ?>
                                    <td style="color: #38b000"><?php echo  $registros["statu"] ?></td>
                                <?php } elseif ($registros["statu"] == "Rechazado") { ?>
                                    <td style="color: #f16d64"><?php echo  $registros["statu"] ?></td>

                                <?php   }else{
                                    echo "<td></td>";
                                } ?>

                            </tr>
                        <?php
                        }
                    }
                } else {
                    $aten->setgerencia($gerencia);
                    $consulta = $aten->consultarTodosRemitidosOAC();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                        ?>
                            <tr>

                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["por"]  ?></td>
                                <td><?php echo $registros["fecha"] ?></td>
                                <td><?php echo $registros["departamento"] ?></td>
                                <td><?php echo $registros["motivo"] ?></td>

                                <?php if ($registros["statu"] == "Aceptado") { ?>
                                    <td style="color: #38b000"><?php echo  $registros["statu"] ?></td>
                                <?php } elseif ($registros["statu"] == "Rechazado") { ?>
                                    <td style="color: #f16d64"><?php echo  $registros["statu"] ?></td>

                                <?php   } ?>

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

<?php
include_once("parteabajo.php");
?>