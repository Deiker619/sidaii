<?php
include_once("partearriba.php");
?>

<!-- contenido -->


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> Seguimiento: <?php echo $rol ?> </span>
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
        
        <h2>Orientaciones dadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha</th>
                    <th>Descripcion</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/09-orientacion.php");
                $aten = new orientacion(1);
                $consulta = $aten->consultarorientacion();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                        <td><a class="cedula"  id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?></a></td>
                            <td><?php echo $registros["nombre"]; ?></td>
                            <td><?php echo $registros["apellido"]; ?></td>
                            <td><?php echo $registros["fecha_orientacion"]; ?></td>
                            <td><?php echo $registros["descripcion"]; ?></td>
                            
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
