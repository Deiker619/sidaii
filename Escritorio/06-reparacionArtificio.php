<?php
include_once("partearriba.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y protesis: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion"><a class="enlace" href="06-reparacionDada.php">Citas dadas para repacion</a></div>
        <h2>Solicitudes de reparacion</h2>
        <table>
            <thead>
                <tr>
                    <th>id de la cita</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-05-reparacionArtificio.php");
                $aten = new raparacion_artificio(1);
                $consulta = $aten->consultarTodasReparacionesSindar();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                     
                            <td><?php echo $registros["id"] ?></td>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>

                            <td style="color: red;">Atender reparacion</td>

                            <td><a href="06-asignarReparacion.php?id=<?php echo $registros["id"] ?>">Reparar</a></td>
                            <td><a onclick="eliminar('<?php echo ($registros['id']); ?>')" class="eliminar">Eliminar Reg</a></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        function eliminar(p1) {
            var id = p1;
            Swal.fire({
                title: `¿Desea eliminar esta reparacion`,
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                confirmButtonColor: '#1AA83E',
                html: `Codigo de cita: ${p1}`,
                denyButtonText: `No eliminar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                let eliminar = 'eliminar'
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "06-reparacionEliminar.php",
                        data: {
                            eliminar: eliminar,
                            id: id
                        },
                        success: function(data) {
                            console.log(data)
                            Swal.fire({
                                icon: 'success',
                                title: data.message
                            }).then(function() {


                                window.location.reload()
                            })

                            if (!data.message) {
                                Swal.fire({
                                    icon: 'error',
                                    title: "No se pudo completar la solicitud"
                                }).then(function() {
                                    window.location.reload()
                                })
                            }
                        },
                        error: function(data) {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Oops...',
                                'text': data
                            })
                        }
                    })




                } else if (result.isDenied) {
                    Swal.fire('Changes are not saved', '', 'info')
                }
            })



        }
    </script>
    <?php
    include_once("parteabajo.php");
    ?>