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
    /* $numero_aten = $_REQUEST["numero_aten"]; */
    /* echo $numero_aten; */
    $consulta = $aten->atencionesDadas_por_discapacidadg();
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


                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Nombre discapacidad</th>
                                <th>Cantidad</th>


                            </tr>

                        </thead>
                        <tbody>

                            <?php foreach ($consulta as $registros) { ?>
                                <tr>
                                    <td><?php echo $registros["nombre_discapacidad"]; ?> </td>
                                    <td><?php echo $registros["cantidades"]; ?> </td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>




                </div>









            </div>


        </div>
    </div>


    </div>




    <?php
    require_once("../../dompdf/autoload.inc.php");
    $html = ob_get_clean();

    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar PDF
    $dompdf->render();

    $nombre = "Report" . date("Y-m-d H:i:s");
    $dompdf->stream($nombre, array("Attachment" => false));

    // Obtener contenido del PDF como string
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
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rekied1842@gmail.com';                     //SMTP username
        $mail->Password   = 'rcvheuugjdyyvzte';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('sidaii@gmail.com', 'Sidaii');
        $mail->addAddress('deiker1842@gmail.com', 'Deiker');     //Add a recipient
        $mail->addAddress('ellen@example.com');               //Name is optional
        $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC('cc@example.com');
        $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addStringAttachment($pdf_content, 'Report.pdf', 'base64', 'application/pdf');      //Add attachments
        /*  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');     */ //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Here is the subject';
        $mail->Body    = 'Hola mi amol es una prueba mia';
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }



























    // Guardar el PDF en un archivo (opcional)
    /*  file_put_contents("documento.pdf", $pdf_content); */

    // Adjuntar el PDF al correo electrónico
    /*  $to = 'ing.jeannenava@gmail.com'; */
    /*  $subject = 'Archivo adjunto';
    $message = 'Aquí está tu archivo adjunto.';
    $from = 'postmaster@localhost'; // Dirección de correo remitente
    $reply_to = 'postmaster@localhost'; // Dirección de respuesta
    $boundary = uniqid('np');

    $headers = "From: $from" . PHP_EOL;
    $headers .= "Reply-To: $reply_to" . PHP_EOL;
    $headers .= "MIME-Version: 1.0" . PHP_EOL;
    $headers .= "Content-Type: multipart/mixed; boundary=$boundary" . PHP_EOL;

    // Cuerpo del mensaje
    $body = "--$boundary" . PHP_EOL;
    $body .= "Content-Type: text/plain; charset=UTF-8" . PHP_EOL;
    $body .= "Content-Transfer-Encoding: 7bit" . PHP_EOL;
    $body .= PHP_EOL . $message . PHP_EOL;

    // Adjuntar el PDF
    $body .= "--$boundary" . PHP_EOL;
    $body .= "Content-Type: application/pdf; name=\"documento.pdf\"" . PHP_EOL;
    $body .= "Content-Transfer-Encoding: base64" . PHP_EOL;
    $body .= "Content-Disposition: attachment" . PHP_EOL;
    $body .= PHP_EOL . chunk_split(base64_encode($pdf_content)) . PHP_EOL;

    $body .= "--$boundary--";

    // Enviar correo electrónico con el PDF adjunto
    if (mail($to, $subject, $body, $headers)) {
        echo "Correo enviado con éxito.";
    } else {
        echo "Error al enviar el correo.";
    } */
    /* https://www.javierrguez.com/configurar-el-correo-en-xampp-con-mercury32/
    
    <?php

use Dompdf\Dompdf;

ob_start();

require_once("../../dompdf/autoload.inc.php");
require_once("../../php/01-atenciones.php");

// Obtener datos de las atenciones
$aten = new Atenciones(1);
$consulta = $aten->atencionesDadas_por_discapacidadg();

// Generar HTML del documento
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Documento PDF</title>
    <!-- Estilos CSS (puedes copiarlos del código anterior) -->
</head>
<body>
    <!-- Contenido del PDF (puedes copiarlo del código anterior) -->
</body>
</html>';

// Crear instancia de Dompdf y cargar HTML
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

// Renderizar PDF
$dompdf->render();

// Obtener contenido del PDF como string
$pdf_content = $dompdf->output();

// Guardar el PDF en un archivo (opcional)
// file_put_contents("documento.pdf", $pdf_content);

// Adjuntar el PDF al correo electrónico
$to = 'deiker1842@gmail.com';
$subject = 'Archivo adjunto';
$message = 'Aquí está tu archivo adjunto.';
$from = 'postmaster@localhost'; // Dirección de correo remitente
$reply_to = 'postmaster@localhost'; // Dirección de respuesta
$boundary = uniqid('np');

$headers = "From: $from" . PHP_EOL;
$headers .= "Reply-To: $reply_to" . PHP_EOL;
$headers .= "MIME-Version: 1.0" . PHP_EOL;
$headers .= "Content-Type: multipart/mixed; boundary=$boundary" . PHP_EOL;

// Cuerpo del mensaje
$body = "--$boundary" . PHP_EOL;
$body .= "Content-Type: text/plain; charset=UTF-8" . PHP_EOL;
$body .= "Content-Transfer-Encoding: 7bit" . PHP_EOL;
$body .= PHP_EOL . $message . PHP_EOL;

// Adjuntar el PDF
$body .= "--$boundary" . PHP_EOL;
$body .= "Content-Type: application/pdf; name=\"documento.pdf\"" . PHP_EOL;
$body .= "Content-Transfer-Encoding: base64" . PHP_EOL;
$body .= "Content-Disposition: attachment" . PHP_EOL;
$body .= PHP_EOL . chunk_split(base64_encode($pdf_content)) . PHP_EOL;

$body .= "--$boundary--";

// Enviar correo electrónico con el PDF adjunto
if (mail($to, $subject, $body, $headers)) {
    echo "Correo enviado con éxito.";
} else {
    echo "Error al enviar el correo.";
}

?>

     */


    ?>
</body>