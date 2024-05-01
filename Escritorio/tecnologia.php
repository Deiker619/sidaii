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
            <span class="link-name">Tecnologia: </span>
        </div>
    </div>

    <a target="_blank" href="respaldo/respaldo.php"> <button class="download-button ">
            <div class="docs dos"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line y2="13" x2="8" y1="13" x1="16"></line>
                    <line y2="17" x2="8" y1="17" x1="16"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> Generar respaldo</div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </button></a>


    <div class="tabla-atencion">



        <h2>Usuarios</h2>

        <!--  <div class="group">
            <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input placeholder="Buscar" id="buscador" type="search" class="inputt">
        </div>
        <br> -->

        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre completo</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Sexo</th>
                    <th>Gerencia</th>
                    <th>Rol</th>
                    <th>Cordinacion</th>
                    <th>Status</th>

                    <th></th>



                </tr>
            </thead>
            <tbody id="atenciones">

                <?php
                include_once("../php/03-usuario.php");
                $aten = new Usuario(1);
                $consulta = $aten->consultarTodosUsuarios();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["email"] ?></td>
                            <td><?php echo $registros["telefono"] ?></td>
                            <td><?php echo $registros["sexo"] ?></td>
                            <td><?php echo $registros["gerencia"] ?></td>
                            <td><?php echo $registros["rol"] ?></td>
                            <td><?php echo $registros["coordinacion"] ?></td>
                            <td><?php echo $registros["bloqueado"] ?></td>
                            <?php if ($registros["bloqueado"] == 1) { ?>

                                <td>
                                    <a class="eliminar" href="../php/cambiar_estado.php?desbloquear=<?php echo $registros["cedula"]; ?>">Desbloquear</a>

                                </td>


                            <?php } else { ?>
                                <td>
                                    <a class="remitir" href="../php/cambiar_estado.php?bloquear=<?php echo $registros["cedula"]; ?>"">Bloquear</a>

                                </td>
                            <?php  } ?>



                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>

        
    </div>
    <div class=" tabla-atencion">



                                        <h2>Actividad de beneficiarios: <i>Eliminados</i></h2>



                                        <table id="atencion">
                                            <thead>
                                                <tr>
                                                    <th>Cedula</th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Fecha de registrado</th>




                                                </tr>
                                            </thead>
                                            <tbody id="atenciones">

                                                <?php
                                                include_once("../php/03-usuario.php");
                                                $aten = new Usuario(1);
                                                $consulta = $aten->ben_eliminados();
                                                $cantidadRegistros = count($consulta);
                                                if ($consulta) {
                                                    foreach ($consulta as $registros) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $registros["cedula"] ?></td>
                                                            <td><?php echo $registros["nombre"] ?></td>
                                                            <td><?php echo $registros["apellido"] ?></td>
                                                            <td><?php echo $registros["fecha_eliminacion"] ?></td>



                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>

                                            </tbody>
                                        </table>

    </div>

    <div class="tabla-atencion">



        <h2>Actividad de beneficiarios: <i>insertados</i></h2>

        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Registrado por</th>
                    <th>Fecha</th>



                </tr>
            </thead>
            <tbody id="atenciones">

                <?php
                include_once("../php/03-usuario.php");
                $aten = new Usuario(1);
                $consulta = $aten->reg_beneficiario();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["registrado_por"] ?></td>
                            <td><?php echo $registros["INSERTADO"] ?></td>





                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>

    <div class="tabla-atencion">



        <h2>Actividad de beneficiarios: <i>Modificados</i></h2>

        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Fecha</th>



                </tr>
            </thead>
            <tbody id="atenciones">

                <?php
                include_once("../php/03-usuario.php");
                $aten = new Usuario(1);
                $consulta = $aten->mod_beneficiario();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>

                            <td><?php echo $registros["fecha"] ?></td>





                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


</div>





<br><br> <br><br><br>
<?php
include_once("parteabajo.php");
?>