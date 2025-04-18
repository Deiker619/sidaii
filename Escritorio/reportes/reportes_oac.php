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
    <style>
        .tabla-atencion {

            margin: 15px;
            border-radius: 20px;
            margin-top: 15px;
            width: 100%;
        }

        h3 {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            border: 1px solid black;
            text-align: center;
            color: black;
            font-size: 1rem;
            border-collapse: collapse;
            padding: 0px;
            margin-bottom: 15px;
            margin: 0;
        }

        .tabla-atencion table thead tr {
            color: #232c33;
            border: 1px solid black;

        }

        .tabla-atencion table tbody tr,
        td {
            color: black;
            border: 1px solid black;
            padding: 5px
        }

        .tabla-atencion textarea {
            margin-top: 25px;
            font-family: Arial, Helvetica, sans-serif;
            border: 0px;
            width: auto;
            height: auto;
            font-size: 16px;
            margin-bottom: 50px;


        }

        .pulgar {
            width: 100px;
            border: 1px solid #ddd;
            height: 100px;
            position: relative;
            left: 37%;
        }

        .footer {
            border: 0px;
            margin-top: 50%;
        }
    </style>
</head>

<body>


    <div class="dash-contenido">
        <div class="overview">
            <div class="titulo">
                <!--  <i class='bx bxs-dashboard'> </i> -->
                <span class="link-name"></span>
            </div>
        </div>


        <div class="tabla-atencion">

            <h2>Personas atentidas</h2>
            <h2>Total: <?php include_once("../../php/01-atenciones.php");
                        $aten = new Atenciones(1);
                        $consulta = $aten->consultarTodosAtencionesa();
                        echo count($consulta); ?></h2>
            <table>
                <thead>
                    <tr>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Estado</th>
                        <th>Discapacidad</th>
                        <th>Asis. Recibida</th>
                        <th>Status</th>
                       

                    </tr>
                </thead>
                <tbody>

                    <?php


                    include_once("../../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultarTodosAtencionesa();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {

                            echo '<tr style="color:#707070; border: 1px solid #ddd; padding:10px">

                                 <td>' . $registros["cedula"] . '</td>' .
                                '<td>' . $registros["nombre"] . '</td>' .
                                '<td>' . $registros["apellido"] . '</td>' .
                                '<td>' . $registros["nombre_estado"] . '</td>' .
                                '<td>' . $registros["nombre_e"] . '</td>' .
                                '<td>' . $registros["atencion_recibida"] . '</td>' .
                                '<td style="color: green;">Atendido</td>';



                            '</tr>';
                        }
                    }


                    ?>

                </tbody>
            </table>
        </div>


    </div>

    <?php

    $html = ob_get_clean();
    /*     echo $html; */

    require_once("../../dompdf/autoload.inc.php");

    $dompdf = new Dompdf();
    $option = $dompdf->getOptions();

    $option->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($option);

    $dompdf->loadHtml($html);
    /* $dompdf->setPaper('letter'); */
    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();
    $dompdf->stream("Archivo PDF", array("Attachment" => false));
    ?>
</body>