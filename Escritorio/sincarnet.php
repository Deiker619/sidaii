<?php
include_once("partearriba.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Beneficiarios: <?php echo $rol ?></span>
        </div>
    </div>



    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
            <h2>Beneficiarios sin certificado de discapacidad</h2>

<br>
            
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado</th>
                        <th>Discapacidad</th>
                        <th>email</th>
                        <th>edad</th>
                        <th>Certificado</th>
                      
                        
                    </tr>
                </thead>
                <tbody id="scr">

                    <?php 
                        include_once("../php/01-discapacitados.php");
                        $aten = new Discapacitados (1);
                        $consulta = $aten->consultageneralsincarnet();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                      
                        <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["nombre_estado"] ?></td>
                        <td><?php echo $registros["nombre_e"] ?></td>
                        <td><?php echo $registros["email"] ?></td>
                        <td><?php echo $registros["edad"] ?></td>
                        <td><?php echo $registros["certificado"] ?></td>
                       
                      
                    </tr>
                    <?php
                    }
                        }
                    ?>
                    
                </tbody>
            </table>
        </div>


        <script>
$(document).ready(function(){
  $("#buscador").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#scr tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



<?php
 include_once("parteabajo.php");
?>