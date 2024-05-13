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
            text-align: left;
            color: black;
            font-size: 1rem;
            border-collapse: collapse;
            padding: 0px;
            margin-bottom: 15px;
            margin: 0;
        }

        .tabla-atencion table thead tr {
            color: black;
            border: 1px solid black;
            text-align: left;
            padding-left: 5px;


        }

        .tabla-atencion table thead th {
            padding: 5px;
            text-align: center;
        }

        .tabla-atencion table tbody tr,
        td {
            color: black;
            border: 1px solid black;
            padding: 5px;
            text-align: left;

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
            background-color: #828384;
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

        .firma {
            background-color: none;
        }
    </style>
</head>
<!-- Ese documento aun no esta funcionamiento, esperando que se desarrolle la funcion de imprimir de las atenciones -->

<body>
    <?php include_once("../../php/01-atenciones-estadales.php");
    $aten = new AtencionesEstadales(1);
    $numero_aten = $_REQUEST["numero_aten"];
    /* echo $numero_aten; */
    $aten->setnumero_aten($numero_aten);
    $familiar = $aten->consultarFamiliar($numero_aten);
    $consulta = $aten->ReportesOP();
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

                <div class="tabla-atencion" style="width: 100%; margin-top:5%">

                    <h2>Certificado de entrega</h2>

                    <table style="width:80%; margin-left:75px;">

                        <tr class="cabecero">
                            <th style="margin: 0; text-align:left">Datos del beneficiario</th>
                            <th></th>
                            <th></th>

                        </tr>







                        <td><b>Nombre: </b> <?php echo $consulta["nombre"] ?> </td>
                        <td><b>Apellido: </b> <?php echo $consulta["apellido"] ?> </td>
                        <td><b>Cedula: </b> <?php echo number_format($consulta["cedula"], 0, '', '.') ?> </td>





                    </table>



                    <table style="width:80%;margin-left:75px;">
                        <tbody>


                            <tr>
                                <td><b>ID de atención: </b><?php echo $consulta["numero_aten"] ?> </td>
                                <td> <b>Discapacidad:</b> <?php echo $consulta["nombre_e"] ?> </td>
                                <td> <b>Solicitud:</b> <?php echo $consulta["atencion_solicitada"] ?> </td>
                            </tr>

                        </tbody>
                    </table>
                    <table style="width:80%;margin-left:75px; ">

                        <tbody>


                            <tr>
                                <td><b> Ayuda medica humana entregada: </b><?php echo $consulta["nombre_tipoayuda"] ?> </td>
                                <td><b> Fecha de atención: </b><?php echo $consulta["fecha_aten"] ?> </td>

                            </tr>

                        </tbody>
                    </table>
                    <?php if ($familiar) { ?>
                        <table style="width:80%; margin-left:75px;">

                            <tr class="cabecero">
                                <th style="margin: 0; text-align:left">Datos del familiar directo</th>
                                <th></th>
                                <th></th>

                            </tr>







                            <td><b>Nombre: </b> <?php echo $familiar["nombre"] ?> </td>
                            <td><b>Apellido: </b> <?php echo $familiar["apellido"] ?> </td>
                            <td><b>Cedula: </b> <?php echo number_format($familiar["cedula"], 0, '', '.') ?> </td>





                        </table>
                    <?php } ?>


                    <textarea style="margin-top: 80px; width:80%;  margin-left:75px;" name="" id="" cols="50" rows="50" placeholder="observaciones">Comprobante: Se certifica que <?php echo $consulta["nombre"] . " " . $consulta["apellido"] ?>, identificado/a con Cédula <?php echo  number_format($consulta["cedula"], 0, '', '.') ?>, ha recibido una asistencia de tecnica el <?php echo $consulta["fecha_aten"] ?>. El ID de atención N° <?php echo $consulta["numero_aten"] ?>, y corresponde a un/a <?php echo $consulta["nombre_tipoayuda"] ?>. Agradecemos su confianza en nuestros servicios.</textarea>

                    <table class="footer" style="border: 0px; margin-top:100px">
                        <thead>
                            <th style="background-color: white;"> <label for="">
                                    <div style="width:300px; margin-left:85px; border-top:1px solid black"></div>Recibido por:
                                </label><br>
                                <!-- <div class="pulgar">

                                    </div> -->
                            </th>
                            <th style="background-color: white;">

                            </th>
                            <th style="background-color: white;"> <label for="">
                                    <div style="width:300px; margin-left:85px;  border-top:1px solid black"></div>Entregado por:
                                </label><br>
                                <!-- <div class="pulgar">

                                    </div> -->
                            </th>


                        </thead>
                        <!--   <tbody>
                                <tr>
                                    <td></td>
                            </tr>
                            </tbody> -->
                    </table>


                </div>









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

    $nombre = $consulta["cedula"];
    /* $dompdf->stream($nombre, array("Attachment" => false)); */
    $pdf_content = $dompdf->output();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require '../PHPMailer/src/Exception.php';
    require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rekied1842@gmail.com';                 //SMTP username
        $mail->Password   = 'rcvheuugjdyyvzte';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to
        $mail->addCustomHeader('Content-Language', 'es');
        //Recipients
        $mail->setFrom('sidaii@gmail.com', 'Sidaii');
        $mail->addAddress($_POST["correo"], 'Deiker');        //Add a recipient

        //Attachments
        $mail->addStringAttachment($pdf_content, 'Comprobante_entrega.pdf', 'base64', 'application/pdf');      //Add attachments

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Comprobante de entrega';
        $mail->Body    =  '
    <html>
    <head>
        <title>Comprobante de entrega</title>
    </head>
    <body>
        <p>Estimado beneficiario <b>' . $consulta["nombre"] . ' ' . $consulta["apellido"] . '</b>,  </p>
        <p>Queremos informarle que hemos recibido su solicitud, realizada el' . '. Agradecemos su confianza en nuestros servicios.</p>
        <p>Nos complace confirmar que su solicitud ha sido recibida y está siendo procesada. Nuestro equipo está trabajando diligentemente para coordinar la entrega del producto lo antes posible.</p>
        <p>Una vez que su solicitud haya sido atendida, recibirá una notificación con los detalles de la entrega.</p>
        <p>Si tiene alguna pregunta adicional o necesita más información, no dude en ponerse en contacto con nosotros.</p>
        <p>Atentamente, <b>Fundación Jose Gregorio Hernández</b></p>
    </body>
    </html>
';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        $mensaje = array(
            "mensaje" => "enviado"
        );

        header('Content-Type: application/json');
        echo json_encode($mensaje);
    } catch (Exception $e) {
        echo json_encode("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    }


    ?>


