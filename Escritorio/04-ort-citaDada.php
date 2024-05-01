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
            <h2>Citas dadas para ortesis y protesis</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
        
                        <th>Codigo de cita</th>
                 
                        <th>Status</th>
                        <th>Fecha de cita</th>
                        <th></th>
                        <th></th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        include_once("../php/01-02-cita_protesis.php");
                        $aten = new citas_protesis (1);
                        $consulta = $aten->consultarTodasCitasDadas();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                      
                        <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
     
                        <td><?php echo $registros["id"] ?></td>
                
                        <td style="color: green;">Cita dada</td>
                        <td><?php echo $registros["fecha_cita"] ?></td>
                    
                        <td><a class="cargar" href="15-verHistoriaMedica.php?codigo_cita=<?php echo  $registros["id"]?>">Ver historia M.</a></td>
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
