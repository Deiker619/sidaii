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
    $mes = $_REQUEST["mes"];
    $anio = $_REQUEST["año"];
    /* echo $numero_aten; */
    $consultas = $aten->DatosMensuales($mes, $anio);
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

                <!-- DADAS -->
                <div class="tabla-atencion" style="width: 100%; margin-top:5%">


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th>ID de atención</th>
                                <th>Fecha de atención</th>
                                <th>Solicitud</th>
                                <th>Artificio entregado</th>


                            </tr>

                        </thead>
                        <tbody>
                            <?php foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre"] ?> </td>
                                    <td><?php echo $consulta["apellido"] ?> </td>
                                    <td><?php echo $consulta["cedula"] ?> </td>
                                    <td><?php echo $consulta["numero_aten"] ?> </td>
                                    <td><?php echo $consulta["fecha_aten"] ?> </td>
                                    <td><?php echo $consulta["atencion_solicitada"] ?> </td>
                                    <td><?php echo $consulta["nombre_tipoayuda"] ?> </td>
                                </tr>

                        </tbody>
                    <?php endforeach;
                            $cedula = $consulta["cedula"] ?>

                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre estado</th>
                                <th>Número de atenciones a personas del estado</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_ESTADOS($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_estado"] ?> </td>
                                    <td><?php echo $consulta["numero"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Discapacidad general</th>
                                <th>Número de atenciones a personas con discapacidad: General</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_DG($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_discapacidad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Discapacidad especifica</th>
                                <th>Número de atenciones a personas con discapacidad: Especifica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_DE($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["discapacidad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Sexo</th>
                                <th>Número de atenciones dadas personas por tipo de sexo</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_SEXO($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["sexos"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Edad</th>
                                <th>Número de atenciones dadas personas por edad</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_EDAD($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["edad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Ayuda tecnica</th>
                                <th>Número de atenciones dadas personas por ayuda tecnica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_AYUDATECNICA($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_tipoayuda"] ?> </td>
                                    <td><?php echo $consulta["cantidad"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Atención</th>
                                <th>Número de atenciones dadas personas por ayuda tecnica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_ATENCION($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre"] ?> </td>
                                    <td><?php echo $consulta["Recibidas"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                </div>

                <!-- NO DADAS -->

          <!--       <div class="tabla-atencion" style="width: 100%; margin-top:5%">


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Cedula</th>
                                <th>ID de atención</th>
                                <th>Solicitud</th>
                            


                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales($mes, $anio);
                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre"] ?> </td>
                                    <td><?php echo $consulta["apellido"] ?> </td>
                                    <td><?php echo $consulta["cedula"] ?> </td>
                                    <td><?php echo $consulta["numero_aten"] ?> </td>
                                   
                                    <td><?php echo $consulta["atencion_solicitada"] ?> </td>
                                    
                                </tr>

                        </tbody>
                    <?php endforeach;
                            $cedula = $consulta["cedula"] ?>

                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre estado</th>
                                <th>Número de atenciones a personas del estado</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_ESTADOS($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_estado"] ?> </td>
                                    <td><?php echo $consulta["numero"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Discapacidad general</th>
                                <th>Número de atenciones a personas con discapacidad: General</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_DG($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_discapacidad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Discapacidad especifica</th>
                                <th>Número de atenciones a personas con discapacidad: Especifica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_DE($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["discapacidad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Sexo</th>
                                <th>Número de atenciones dadas personas por tipo de sexo</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_SEXO($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["sexos"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Edad</th>
                                <th>Número de atenciones dadas personas por edad</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_EDAD($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["edad"] ?> </td>
                                    <td><?php echo $consulta["cantidades"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>

                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Ayuda tecnica</th>
                                <th>Número de atenciones dadas personas por ayuda tecnica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_AYUDATECNICA($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre_tipoayuda"] ?> </td>
                                    <td><?php echo $consulta["cantidad"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Atención</th>
                                <th>Número de atenciones dadas personas por ayuda tecnica</th>



                            </tr>

                        </thead>
                        <tbody>
                            <?php
                            $consultas = $aten->DatosMensuales_ATENCION($mes, $anio);


                            foreach ($consultas as $consulta) : ?>

                                <tr>
                                    <td><?php echo $consulta["nombre"] ?> </td>
                                    <td><?php echo $consulta["Recibidas"] ?> </td>

                                </tr>

                        </tbody>
                    <?php endforeach; ?>
                    </table>


                </div>
 -->







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

    $nombre = $cedula;
    $dompdf->stream($nombre, array("Attachment" => false));


    ?>
</body>