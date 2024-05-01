<?php
include_once("partearriba.php");
?>

<!-- Contenido -->


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Remitidos: <?php echo $rol ?></span>
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
        <div class="personas-conatencion" style="justify-content:right; align-items: baseline">
            <div class="botones__especiales">
                    <button class="Btn export">

                        <div class="sign">
                            <i class='bx bx-export'></i>
                        </div>

                        <div class="text_boton">Remitidos de gerencia</div>
                    </button>
                    
                    
                </div>
            <a class="enlace" style="background-color: #0e9cd4; color:#fff" href="">Registros aceptados</a>
            <a class="enlace" style="background-color: #f03e31; color:#fff" href="">Registros Rechazados</a>
        </div>

        <h2>Personas remitidas</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Remitido por</th>
                    <th>fecha de remicion</th>
                    <th>remitido de</th>
                    <th>Motivo</th>
                    <th></th>
                    <th></th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/6-remitir.php");
                $aten = new remitido(1);
                $aten->setdepartamento($gerencia);
                if($rol =="Superusuario" || $rol =="Administrador" || $rol =="coorA" || $gerencia =="2Atc"){
                    $consulta = $aten->consultarTodosRemitidoss();
                }else{
                    $aten->setcoordinacion($coordi);
                    $consulta = $aten->consultarTodosRemitidossXCoordinacion();

                }
                echo $gerencia;
                echo $coordi;
               
               
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["id"] ?></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["por"] ?></td>
                            <td><?php echo $registros["fecha"] ?></td>
                            <td><?php echo $registros["gerencia_remitente"] ?></td>
                            <td><?php echo $registros["motivo"] ?></td>
                            <!-- <td style="color: red;">Cita sin dar</td> -->
                            <td><a href="--aceptar_infraestructura.php?id=<?php echo  $registros["id"]; ?>" class="remitir" id="aceptar">Aceptar reg</a></td>
                            <td><a href="--rechazar_remitidos.php?id=<?php echo  $registros["id"]; ?>" class="eliminar" id="rechazar">Rechazar reg</a></td>
                          
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