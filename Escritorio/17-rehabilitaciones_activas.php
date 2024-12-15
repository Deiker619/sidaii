<?php 
include_once('partearriba.php');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Rehabilitacion: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="tabla-atencion">
            <div class="personas-conatencion">
                <div class="botones__especiales">
                    <button class="Btn export">

                        <div class="sign">
                            <i class='bx bx-export'></i>
                        </div>

                        <div class="text_boton">Remitidos de gerencia</div>
                    </button>
                    <button class="Btn import">

                        <div class="sign">
                            <i class='bx bx-import'></i>
                        </div>

                      <a href="04-ort-remitidos.php" class="enlace_especial"> <div class="text_boton"> Remitidos a gerencia</a></div>
                    </button>
                    
                </div>
                <a class="enlace " href="17-rehabilitaciones_cerradas.php">Rehabilitaciones cerradas</a>
            </div>
            <h2>Rehabilitaciones activas</h2>
            <table id="atencion">
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>id de la apertura</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php2/__rehabilitacion.php");
                    $aten = new rehabilitacion(1);
                    $consulta = $aten->consultarTodasCitasDadas();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                            <td> <a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["id"] ?></td>
                          
                                <td style="color: blue;">Proceso: <?php echo $registros["status"] ?></td>
                                <td><a class="remitir" href="17-rehabilitacion_proceso.php?id=<?php echo $registros["id"] ?>">Ver proceso</a></td>
                                <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>

</div>


<?php
include_once('parteabajo.php');
?>