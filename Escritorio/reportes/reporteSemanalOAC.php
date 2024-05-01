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
<!-- Ese documento aun no esta funcionamiento, esperando que se desarrolle la funcion de imprimir de las atenciones -->

<body>
    <?php include_once("../../php/01-atenciones.php");
    $aten = new Atenciones(1);
    $otro = new Atenciones(1);
    /* $numero_aten = $_REQUEST["numero_aten"]; */
    /* echo $numero_aten; */
    $consulta = $aten->ReporteSemanal();
    /*     echo $consulta["cedula"]; */
    $nombreImagen = "cintillo2.jpg";
    $imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));

    ?>


    <div class="dash-contenido">
        <div class="overview">
            <div class="titulo">
                <!--  <i class='bx bxs-dashboard'> </i> -->
                <span class="link-name"></span>
            </div>
        </div>


        <div class="cont-registro">



            <div class="container">
                <!--  --><img src="<?php echo $imagenBase64 ?>" width="100%">
                <?php foreach ($consulta as $registros) { ?>
                    <div class="tabla-atencion" style="width: 100%; margin-top:5%">
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Numero de semana</th>
                                    <th>Inicio de semana</th>
                                    <th>Fin de semana</th>
                                    <th>Registros totales</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $registros["nroSemana"]; ?> </td>
                                    <td><?php if ($registros["inicio_semana"]== date('Y-01-01')){
                                        echo $registros["inicio_semana"];
                                    }else{
                                        $fecha = new DateTime($registros["inicio_semana"]);
                                        $fecha->modify('+1 day');
                                        echo $fecha->format('Y-m-d');
                                    }; ?> </td>
                                    <td><?php echo $registros["fin_semana"]; ?> </td>
                                    <td><?php echo $registros["registros"]; ?> </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        // Verifica si $subConsulta no está vacío
                        $otro = new Atenciones(1);
                        $subConsulta = $aten->ReporteSemanalGeneral($registros["inicio_semana"],  $registros["fin_semana"]);



                        if (!empty($subConsulta)) {
                        ?>
                            <table>

                                <thead>
                                    <tr>
                                        <span style="background-color: #dfdcdc; width:100%; display: block"> Atenciones generales: <?php echo $registros["inicio_semana"] . " - " . $registros["fin_semana"]; ?></span>

                                    <tr>
                                        <th>
                                            Numero de atencion
                                        </th>
                                        <th>
                                            Cedula
                                        </th>
                                        <th>
                                            atencion recibida
                                        </th>
                                        <th>
                                            Fecha de atencion
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subConsulta as $subRegistros) {
                                    ?>
                                        <tr>
                                            <td><?php echo $subRegistros["numero_aten"]; ?></td>
                                            <td><?php echo $subRegistros["cedula"]; ?></td>
                                            <td><?php echo $subRegistros["atencion_recibida"]; ?></td>
                                            <td><?php echo $subRegistros["fecha_aten"]; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $subConsulta = $aten->ReporteSemanalAyudaTecnica($registros["inicio_semana"],  $registros["fin_semana"]);
                            ?>
                            <table>

                                <thead>
                                    <tr>
                                        <span style="background-color: #dfdcdc; width:100%; display: block"> Atenciones generales: Artificios entregados <?php echo $registros["inicio_semana"] . " - " . $registros["fin_semana"]; ?></span>

                                    <tr>
                                        <th>
                                            Artificio entregado
                                        </th>
                                        <th>
                                            Cantidades entregadas
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subConsulta as $subRegistros) {
                                    ?>
                                        <tr>
                                            <td><?php echo $subRegistros["nombre_tipoayuda"]; ?></td>
                                            <td><?php echo $subRegistros["cantidad"]; ?></td>
                                            
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $subConsulta = $aten->ReporteSemanalSexo($registros["inicio_semana"],  $registros["fin_semana"]);
                            ?>
                            <table>

                                <thead>
                                    <tr>
                                        <span style="background-color: #dfdcdc; width:100%; display: block"> Atenciones generales: Sexo <?php echo $registros["inicio_semana"] . " - " . $registros["fin_semana"]; ?></span>

                                    <tr>
                                        <th>
                                            Sexo
                                        </th>
                                        <th>
                                            Cantidad de personas por sexo con otorgamiento
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subConsulta as $subRegistros) {
                                    ?>
                                        <tr>
                                            <td><?php echo $subRegistros["sexo"]; ?></td>
                                            <td><?php echo $subRegistros["cantidad"]; ?></td>
                                            
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $subConsulta = $aten->ReporteSemanalEdad($registros["inicio_semana"],  $registros["fin_semana"]);
                            ?>
                            <table>

                                <thead>
                                    <tr>
                                        <span style="background-color: #dfdcdc; width:100%; display: block"> Atenciones generales: Edad <?php echo $registros["inicio_semana"] . " - " . $registros["fin_semana"]; ?></span>

                                    <tr>
                                        <th>
                                            Edades
                                        </th>
                                        <th>
                                            Cantidad de personas por sexo con otorgamiento
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subConsulta as $subRegistros) {
                                    ?>
                                        <tr>
                                            <td><?php echo $subRegistros["edad"]; ?></td>
                                            <td><?php echo $subRegistros["cantidad"]; ?></td>
                                            
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <?php
                            $subConsulta = $aten->ReporteSemanalDiscapacidadE($registros["inicio_semana"],  $registros["fin_semana"]);
                            ?>
                            <table>

                                <thead>
                                    <tr>
                                        <span style="background-color: #dfdcdc; width:100%; display: block"> Atenciones generales: Discapacidad especifica <?php echo $registros["inicio_semana"] . " - " . $registros["fin_semana"]; ?></span>

                                    <tr>
                                        <th>
                                            Discapacidad
                                        </th>
                                        <th>
                                            Cantidad de personas por discapacidad con otorgamiento
                                        </th>
                                    </tr>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($subConsulta as $subRegistros) {
                                    ?>
                                        <tr>
                                            <td><?php echo $subRegistros["nombre_e"]; ?></td>
                                            <td><?php echo $subRegistros["cantidad"]; ?></td>
                                            
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "No hay datos para esta semana.";
                        }
                        ?>
                    </div>
                <?php } ?>





            </div>









        </div>


    </div>
    </div>


    </div>


    <?php

    $html = ob_get_clean();
   /*  echo $html; */

    require_once("../../dompdf/autoload.inc.php");

    $dompdf = new Dompdf();
    $option = $dompdf->getOptions();

    $option->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($option);

    $dompdf->loadHtml($html);
    /* $dompdf->setPaper('letter'); */
    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $nombre = "Report" . date("Y-m-d H:i:s");
    $dompdf->stream($nombre, array("Attachment" => false));


    ?>
</body>