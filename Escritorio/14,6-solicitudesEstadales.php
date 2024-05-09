<?php
include_once("partearriba.php");
?>
<?php
include_once("../php/10-coordinaciones-estadales.php");
$coordinacion = $_REQUEST["coordinacion"];
$aten = new coordinacion(1);

$aten->setid($coordinacion);
$registro = $aten->consultarCoordinacion();
?>

<!-- contenido -->


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> solicitudes: <?php echo $rol ?> </span>
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
        
        <h2>Solicitudes</h2>
        <table>
            <thead>
                <tr>
                   
                    <th>Nombre de la solicitud</th>
                    <th>Cantidad</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/10-coordinaciones-estadales.php");
                $aten = new Coordinacion(1);
                $aten->setid("");
                $consulta = $aten->consultadeSolicitudes();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                        
                            <td><?php echo $registros["atencion_solicitada"] ?></td>
                            <td><?php echo $registros["cantidad"]?></td>
                
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
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var cedula = <?php echo $cedula; ?>;
                var descripcion = $("#descripcion").val();
                var fecha = $("#fecha").val();



                e.preventDefault();
                asignarAtencion();
                $.ajax({
                    type: "POST",
                    url: "01,10-seguimientoRegistrar.php",
                    data: {
                        cedula: cedula,
                        descripcion: descripcion,
                        fecha: fecha


                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': 'Se le dio seguimiento exitosamente',
                            'confirmButton': 'btn btn-success'
                        }).then(function() {
                            window.location = "01,2-atenciones.php";
                        })
                    },
                    error: function(data) {
                        Swal.fire({
                            'icon': 'error',
                            'title': 'Oops...',
                            'text': data
                        })
                    }
                })


            }
        })
    })
</script>



<?php
include_once("parteabajo.php");
?>
