<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Audiometria: <?php echo $rol ?></span>
        </div>
    </div>

   

   


    <div class="tabla-atencion">
        <div class="personas-conatencion"><a class="enlace" href="07-audiometriaRecibida.php">Citas dadas de audiometria</a></div>
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