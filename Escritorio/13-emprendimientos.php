<?php
include_once("partearriba.php");
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Emprendimientos: <?php echo $rol ?></span>
        </div>
    </div>
    <!--  -->

    <div class="resumen">

        <?php

        include_once("../php/01-discapacitados.php");
        $mod = new Discapacitados(1);
        $consulta = $mod->emprendimientos();
        $cantidadRegistros = count($consulta);
        if ($consulta) {
            foreach ($consulta as $registros) {

        ?>
                <div class="card">
                    <div class="header">
                        <div class="image"><?php
                                            ?>

                        </div>
                        <div class="content">
                            <span class="title"><?php echo $registros["nombre_emprendimiento"] ?></span>
                            <p class="message">Cedula: <?php echo $registros["cedula"] ?></p>
                            <p class="message"> rif:<?php echo $registros["rif_emprendimiento"] ?></p>
                            <p class="message">Area comercial: <?php echo $registros["area_comercial"] ?></p>
                        </div>
                        <div class="actions">
                            <button class="desactivate" type="button">Persona: <?php echo $registros["nombre"]." ".$registros["apellido"] ?> </button>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>


    </div>

</div>
<?php
include_once("parteabajo.php");
?>