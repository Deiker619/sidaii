<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>
<div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->
            <h2>Personas con Ayuda tecnica entregada</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Discapacidad</th>
                        <th>id de ayuda tec</th>
                        <th>Tipo de ayuda dada</th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        include_once("../php/01-01-ayudas_tec.php");
                        $aten = new Ayudas_tec (1);
                        $consulta = $aten->consultarTodasAyudas_tecRecibidas();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                      
                    <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["nombre_discapacidad"] ?></td>
            
                        <td><?php echo $registros["id"] ?></td>
                        <td><?php echo $registros["nombre_tipoayuda"] ?></td>
                        <td style="color: green;">Ayuda tecnica dada</td>
                        <td><a href="eliminar/eliminarayudatec.php?id=<?php echo $registros["id"]?>" class="eliminar">Eliminar Reg</a></td>
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
