<?php      
include_once("partearriba.php");
?>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Desarrollo social: <?php echo $rol ?></span>
        </div>
    </div>
<div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="04-tomasAsignadas.php">Talleres dados</a></div> -->
            <h2>Nuevas solicitudes encuentros</h2>
            <table>
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Cedula</th>
                        <th>Estado</th>
                        <th>Solicitud</th>
                        <th></th>
                        <th></th>
                       
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        include_once("../php/05-solicitud_encuentro.php");
                        $aten = new solicitud_encuentro (1);
                        $consulta = $aten->consultarTodasSolicitudes();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                        <td><?php echo $registros["id"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["estado"] ?></td>
                        <td><?php echo $registros["solicitud"] ?></td>
                        <td><a href="09-desarrolloS-encuentrosAsig.php?id=<?php echo $registros["id"]?>">Asignar actividad</a></td>
                        <td><a href="eliminar/solic_encuentro.php?id=<?php echo $registros["id"]?>" class="eliminar">Eliminar Reg</a></td>
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
