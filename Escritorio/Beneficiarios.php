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
    <!-- Boton de reporte -->

    <a href="reportes/reportes.php" target="_blank"> <button class="download-button">
            <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line y2="13" x2="8" y1="13" x1="16"></line>
                    <line y2="17" x2="8" y1="17" x1="16"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> Generar Reporte</div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </button></a>


    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
       <!--  <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div> -->
        <br>
        <h2>Beneficiarios</h2>
        <h2>Total: <?php
                    include_once("../php/01-discapacitados.php");

                    $beneficiario = new Discapacitados(1);
                    $resultados =  $beneficiario->consultageneral();
              /*       $resultados = $consulta['resultados']; */

                    echo count($resultados);
                    ?></h2>
        <!-- Mostrar los resultados -->
        <table id="atencion">
            <thead>
                <tr>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Teléfono</th>
                    <th>Edad</th>
                    <th>Email</th>
                    <th>Certificado</th>
                   
                    <th></th>
                </tr>
            </thead>
            <tbody id="Beneficiarios1">
                <?php foreach ($resultados as $resultado) : ?>
                    <tr>

                        <td><a class="cedula" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $resultado['cedula']; ?>"><?php echo $resultado['cedula']; ?> </a></td>
                        <td><?php echo $resultado['nombre']; ?></td>
                        <td><?php echo $resultado['apellido']; ?></td>
                        <td><?php echo $resultado['nombre_estado']; ?></td>
                        <td><?php echo $resultado['nombre_e']; ?></td>
                        <td><?php echo $resultado['telefono']; ?></td>
                        <td><?php echo $resultado['edad']; ?></td>
                        <td><?php echo $resultado['email']; ?></td>
                        <td><?php echo $resultado['certificado']; ?></td>
                    
                        <?php if ($rol == "Superusuario") { ?>
                            <td>
                                <button class="buttons" type="button" onclick="eliminar(<?php echo $resultado['cedula']; ?>)">
                                    <span class="buttons__text">Eliminar </span>
                                    <span class="buttons__icon">
                                        <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                            <title></title>
                                            <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                                            <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                                            <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
                                        </svg>
                                    </span>
                                </button>
                            </td>
                        <?php }else{
                          echo "<td></td>";
                        } ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Mostrar la paginación -->
        <!--  -->
    </div>


    <?php



    ?>



    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#atencion').DataTable();
        });
    </script>
    <script>
        function eliminar(p1) {


            var cedula = p1;
            console.log(cedula);


            Swal.fire({
                icon: "question",
                title: '¿Desea eliminar este beneficiario?',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `No eliminar`,
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {

                    $.ajax({
                        type: "GET",
                        url: "eliminar/eliminarbeneficiario.php",
                        data: {
                            cedula: cedula


                        },
                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Eliminado: ' + cedula,
                                'text': "se elimino a este beneficiario",
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                window.location = "Beneficiarios.php";
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
                } else if (result.isDenied) {
                    Swal.fire('Changes are not eliminated', '', 'info')
                }
            })
        }


        $(document).ready(function() {
            $("#buscador").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#Beneficiarios1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
                });
            });
        });
    </script>
    <?php
    include_once("parteabajo.php");
    ?>