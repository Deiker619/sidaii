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
        <div class="personas-conatencion"><a class="enlace" href="06-reparacionDada.php">Reparaciones dadas</a></div>
            <h2>solicitudes de reparacion</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>id de la cita</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        include_once("../php/01-05-reparacionArtificio.php");
                        $aten = new raparacion_artificio (1);
                        $consulta = $aten->consultarTodasReparacionesSindar();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                      
                        <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["id"] ?></td>
                    
                        <td style="color: red;">Atender reparacion</td>
                        <td><a href="06-asignarReparacion.php?id=<?php echo $registros["id"]?>">Reparar</a></td>
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