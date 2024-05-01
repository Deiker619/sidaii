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
            font-size: 30px;
            text-align: left;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: black;
            margin-left: 20px;
            text-align: center;
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
            text-align: justify;


        }

        table .cabecero,
        th {
            background-color: #858384;
            padding-left: 5px;
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
    $numero_aten = $_REQUEST["numero_aten"];
    echo $numero_aten;
    $aten->setnumero_aten($numero_aten);
    $consulta = $aten->ReportesOACCargarSolicitud();
    echo $consulta["cedula"];
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

                <div class="tabla-atencion" style="width: 100%; margin-top:5%">
                    <h2>Certificado de solicitud</h2>


                    <table style="width:85%; margin-left:75px;">

                        <tr class="cabecero">
                            <th style="margin: 0; text-align:left">Datos del beneficiario</th>
                            <th></th>
                            <th></th>

                        </tr>







                        <td><b>Nombre: </b> <?php echo $consulta["nombre"] ?> </td>
                        <td><b>Apellido: </b> <?php echo $consulta["apellido"] ?> </td>
                        <td><b>Cedula: </b> <?php echo number_format($consulta["cedula"], 0, '', '.') ?> </td>





                    </table>

                    <table style="width:85%; margin-left:75px;">

                        <tbody>


                            <tr>
                                <td><b>ID de atención: </b> <?php echo $consulta["numero_aten"] ?> </td>
                                <td><b>Discapacidad: </b> <?php echo $consulta["nombre_e"] ?> </td>
                                <td> <b>Solicitúd:</b> <?php echo $consulta["atencion_solicitada"] ?> </td>
                            </tr>

                        </tbody>
                    </table>

                    <!-- <table style="width:85%; margin-left:75px;">

                        <tr class="cabecero">
                            <th style="margin: 0; text-align:left">Datos del familiar directo</th>
                            <th></th>
                            <th></th>

                        </tr>







                        <td><b>Nombre: </b> <?php echo $consulta["nombre"] ?> </td>
                        <td><b>Apellido: </b> <?php echo $consulta["apellido"] ?> </td>
                        <td><b>Cedula: </b> <?php echo number_format($consulta["cedula"], 0, '', '.') ?> </td>





                    </table> -->
                    <table style="width:85%; margin-left:75px;">


                        <tr class="cabecero">
                            <th colspan="3" style="margin: 0; text-align:left">Documentación entregada </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>




                        </tr>


                        <tr style="font-size: 12px;">

                            <td> Carta de exposición
                            <td style="width: 20px;"></td>
                            </td>
                            <td> Informe medico
                            <td style="width: 20px; ">X</td>
                            </td>
                            <td> Copia cedula
                            <td style="width: 20px; ">X</td>
                            </td>
                            <td> Carnet de discapacidad
                            <td style="width: 20px; "></td>
                            </td>
                            <td> Partida de nacimiento
                            <td style="width: 20px; "></td>
                            </td>
                            <td>Autorización
                            <td style="width: 20px; "></td>
                            </td>


                        </tr>










                    </table>


                    <textarea name="" id="" cols="50" rows="50" style="margin-top: 80px; width:85%;  margin-left:75px;" placeholder="observaciones">Comprobante: Este documento certifica que <?php echo $consulta["nombre"] . " " . $consulta["apellido"] ?> de cedula <?php echo $consulta["cedula"] ?> ha realizado la solicitud de <?php echo $consulta["atencion_solicitada"] ?>. Agradecemos su confianza y le informamos que su solicitud será atendida en los próximos días. Gracias por su paciencia y colaboración. </textarea>




                </div>









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
    /* $dompdf->setPaper('letter'); */
    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();

    $cedula = $consulta["cedula"];
    $dompdf->stream($cedula, array("Attachment" => false));

    $pdf_content = $dompdf->output();

    ?>
</body>