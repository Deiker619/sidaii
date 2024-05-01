<?php
include_once("partearriba.php");
?>

<!-- contenido -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> Solicitudes: <?php echo $rol ?> </span>
        </div>
    </div>
    <div class="botones-header">
            <a href="reportes/reportes_solicitudes.php"> <button class="download-button">
                    <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg> Generar Reporte de solicitudes </div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button></a>
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
        <table id="atencion">
            <thead>
                <tr>
                   
                    <th>Nombre de la solicitud</th>
                    <th>Cantidad</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-atenciones.php");
                $aten = new Atenciones(1);
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

    <div class="tabla-atencion">
        
        <h2>Solicitudes</h2>
        <table id="atencion">
            <thead>
                <tr>
                   
                    <th>Nombre de la solicitud</th>
                    <th>Cantidad</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-atenciones.php");
                $aten = new Atenciones(1);
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
