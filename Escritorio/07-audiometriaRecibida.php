<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y protesis: <?php echo $rol ?></span>
        </div>
    </div>
    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->
        <h2>Reparaciones dadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Discapacidad</th>
                    <th>Codigo de prueba</th>
                    <th>Fecha en que se asigno cita</th>
                    <th>Status</th>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-06-audiometria.php");
                $aten = new audiometria(1);
                $consulta = $aten->consultarTodasCitasDadas();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["discapacidad"] ?></td>
                            <td><?php echo $registros["id"] ?></td>
                            <td><?php echo $registros["fecha_cita"] ?></td>
                            <td style="color: green;">cita dada</td>
                            <!--  <td><a href="01,3-asignarAtencion.php?numero_aten=<?php $registros["numero_aten"] ?>">Dar atencion</a></td>
                        <td><a href="" class="eliminar">Eliminar Reg</a></td> -->
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