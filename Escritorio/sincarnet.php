<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Beneficiarios: <?php echo $rol ?></span>
        </div>
    </div>



    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
            <h2>Beneficiarios sin carnet</h2>

            <div class="group">
  <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
  <input placeholder="Buscar" id= "buscador" type="search" class="inputt">
</div>
<br>
            <h2>Total: <?php 
             include_once("../php/01-discapacitados.php");
             $aten = new Discapacitados (1);
             $consulta = $aten->consultageneral();
             $cantidadRegistros = count($consulta);
             
             echo $cantidadRegistros;?></h2>
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
                        <th></th>
                        
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
                        <td><a href="eliminar/eliminarbeneficiario.php?cedula=<?php echo $registros["cedula"]?>" class="eliminar">Eliminar Reg</a></td>
                      
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