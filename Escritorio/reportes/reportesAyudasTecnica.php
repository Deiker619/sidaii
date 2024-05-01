<?php

use Dompdf\Dompdf;

ob_start()



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf-8">
    <!--  <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- JQuery -->

    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous">
    </script>


    <!-- CSS -->
    <link rel="stylesheet" href="../estilo.css">

    <link rel="stylesheet" href="../dash.css">

    <link rel="stylesheet" href="../02-buttons/01-buttons.css">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/ css/line.css">

    <!--  Boostrap-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Documento PDF</title>
</head>

<body>

    <style>
        .tabla-atencion {
            border: 1px solid #ddd;
            margin: 15px;
            border-radius: 20px;
            margin-top: 15px;
            width: 100%;
        }

        .tabla-atencion h2 {
            font-size: 18px;
            text-align: left;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #707070;
            margin-left: 20px;
        }

        .tabla-atencion table {
            background-color: #fff;
            width: 100%;
            font-family: Arial, Helvetica, sans-serif;
            border: 1px solid #ddd;
            text-align: center;
            color: black;
            font-size: 1rem;
            border-collapse: collapse;
            padding: 15px;
            margin-bottom: 15px;
        }

        .tabla-atencion table thead tr {
            color: #38b000;
            border: 1px solid #ddd;
        }

        .tabla-atencion table tbody tr,
        td {
            color: #707070;
            border: 1px solid #ddd;
            padding: 5px
        }
    </style>
    <div class="dash-contenido">
        <div class="overview">
            <div class="titulo">
                <!--  <i class='bx bxs-dashboard'> </i> -->
                <span class="link-name"> </span>
            </div>
        </div>



        <!-- Personas con atencion -->

        <div class="tabla-atencion">
            <h2 style="color:#38b000"><?php echo date("Y-m-d") ?></h2>

            <h2>Personas con ayudas tecnicas dadas</h2>
            <h2>Total: <?php include_once("../../php/01-01-ayudas_tec.php");
                        $aten = new Ayudas_tec(1);
                        $consulta = $aten->consultarTodasAyudas_tecRecibidas();
                        echo count($consulta); ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>id de ayuda tec</th>
                        <th>Tipo de ayuda dada</th>
                        <th></th>
                       


                    </tr>
                </thead>
                <tbody>




                    <?php
                    include_once("../../php/01-01-ayudas_tec.php");
                    $aten = new Ayudas_tec(1);
                    $consulta = $aten->consultarTodasAyudas_tecRecibidas();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>

                                <td><?php echo $registros["id"] ?></td>
                                <td><?php echo $registros["nombre_tipoayuda"] ?></td>
                                <td style="color: green;">Ayuda tecnica dada</td>
                            </tr>
                    <?php
                        }
                    }
                    ?>






                </tbody>
            </table>
        </div>



        <!-- Personas sin atencion -->


        <div class="tabla-atencion">

            <h2>Personas asignadas para ayudas tecnicas</h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Discapacidad</th>
                        <th>id de atencion</th>
                        <th></th>
                    

                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../../php/01-01-ayudas_tec.php");
                    $aten = new Ayudas_tec(1);
                    $consulta = $aten->consultarTodasAyudas_tec();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["cedula"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["apellido"] ?></td>
                                <td><?php echo $registros["nombre_discapacidad"] ?></td>
                                <td><?php echo $registros["id"] ?></td>
                                <td style="color: red;">Sin recibir la ayuda</td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>

        <div class="tabla-atencion" style="width: 50%;">
        <h2>Ayudas tecnicas dadas</h2>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Total</th>
                   

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../../php/01-01-ayudas_tec.php");
                $aten = new Ayudas_tec(1);
                $consulta = $aten->consultarTodasAyudas_porAyuda();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["nombre_tipoayuda"] ?></td>
                            <td><?php echo $registros["total"] ?></td>
                        
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
    </div>









    </div>



    <?php

    $html = ob_get_clean();
    /* echo $html; */

    require_once("../../dompdf/autoload.inc.php");

    $dompdf = new Dompdf();
    $option = $dompdf->getOptions();

    $option->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($option);

    $dompdf->loadHtml($html);
    $dompdf->setPaper('letter');
    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();
    $dompdf->stream("Archivo PDF", array("Attachment" => false));
    ?>
</body>