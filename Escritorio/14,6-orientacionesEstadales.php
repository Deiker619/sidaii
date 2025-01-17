<?php
include_once("partearriba.php");
?>

<!-- Contenido -->


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Orientados: </span>
        </div>
    </div>

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



    <div class="tabla-atencion">
   

        <h2>Personas orientadas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                   
                    <th>fecha de remicion</th>
                    <th>Motivo</th>
              

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/09-orientacion.php");
                $aten = new orientacion(1);
                if($rol =="Superusuario" || $rol =="Administrador" || $rol =="coorA"){
                    $consulta = $aten->orientacionesADMIN();
                }else{

                $aten->setcoordinacion($coordi);
                $consulta = $aten->orientaciones_dadas_por();
                }


                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                         
                            <td><?php echo $registros["id"] ?></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["fecha_orientacion"] ?></td>
                            <td><?php echo $registros["descripcion"] ?></td>
                          
                            <!-- <td style="color: red;">Cita sin dar</td> -->
                           
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

</div>

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">


</script>
<?php
include_once("parteabajo.php");
?>