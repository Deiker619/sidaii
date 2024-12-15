  <?php   
/* 
  include_once("../../php/01-06-audiometria.php");
  $aten = new audiometria(1);
  $consulta = $aten->consultarCita(); */

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
        /* $mail->addStringAttachment($pdf_content, 'Comprobante_entrega.pdf', 'base64', 'application/pdf');     */  //Add attachments

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Audiometria: Finalizada';
        $mail->Body    =  '
    <html>
    <head>
        <title>Audiometria: Finalizada</title>
    </head>
    <body>
        <p>Estimado beneficiario <b>'.'</b>,  </p>
        <p>Queremos informarle que su artificio se encuentra disponible en la Fundación José Gregorio Hernández, por favor venir a retirar a la institución. </p></p>
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