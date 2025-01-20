<?php
include_once("partearriba.php");
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Personas para apertura de historia medica: <?php echo $rol ?></span>
        </div>
    </div>

    <?php if ($rol == "Administrador" || $rol == "Superusuario" || $rol == "coorA") { ?>
        <div class="acordeon">
            <br>

            <div class="tab">
                <input type="checkbox" name="acc" id="acc1">
                <label for="acc1">
                    <h2>C-E</h2>
                    <h3> Lista de laboratorios por estado</h3>
                </label>
                <div class="tab-background"></div>
                <div class="content">

                    <div class="resumen">

                        <?php
                        include_once("../php/01-02-cita_protesis.php");
                        $aten = new citas_protesis(1);
                        $consulta = $aten->obtenerLaboratorios();

                        foreach ($consulta as $registros) {
                        ?>

                            <div class="cardd">
                                <div class="title">
                                    <span></span>
                                    <p class="title-text">atenciones</p>
                                    <p class="percent"><?php echo 0 ?></p>
                                </div>
                                <div class="data">
                                    <p>
                                        <span style="display: block; font-size: 10px; margin:0"><?php echo $registros["nombre_lab"] ?></span>
                                        <a href="20-verLaboratorio.php?laboratorio=<?php echo $registros["id"] ?>" class="enlace_especial"><?php echo $registros["nombre_estado"] ?></a>
                                    </p>
                                    <div class="range">
                                        <div class="fill"></div>
                                    </div>
                                </div>
                            </div>

                        <?php
                        }

                        $aten->__destruct();
                        ?>

                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="reportes-totales">
        <div class="reporte">
            <a href="04-tomaMedidas.php">Toma de medidas</a>
        </div>
        <div class="reporte">
            <a href="05-pruebaArtificio.php">Prueba de artificio</a>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div class="botones__especiales">
                <button class="Btn export">
                    <div class="sign">
                        <i class='bx bx-export'></i>
                    </div>
                    <div class="text_boton">Remitidos de gerencia</div>
                </button>
                <button class="Btn import">
                    <div class="sign">
                        <i class='bx bx-import'></i>
                    </div>
                    <a href="04-ort-remitidos.php" class="enlace_especial">
                        <div class="text_boton"> Remitidos a gerencia</div>
                    </a>
                </button>
            </div>
            <a class="enlace" href="04-ort-citaDada.php">Citas dadas</a>
        </div>
        <h2>Personas para apertura medica</h2>
        
        <table id="atencion">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>id de la apertura</th>
                    <th>Status</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-02-cita_protesis.php");
                $aten = new citas_protesis(1);
                $consulta = $aten->consultarTodasCitasSindar();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?></a></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["id"] ?></td>
                            <td style="color: red;">Apertura sin abrir</td>
                            <td><a href="04-ort-darCita.php?id=<?php echo $registros["id"] ?>">Aperturar historia</a></td>
                            <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


    <?php
    include_once("parteabajo.php");
    ?>