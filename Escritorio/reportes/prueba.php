<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
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
    /* $mail->addAddress('ellen@example.com'); */               //Name is optional
    /* $mail->addReplyTo('info@example.com', 'Information'); */
    /* $mail->addCC('cc@example.com'); */
    /* $mail->addBCC('bcc@example.com'); */

    //Attachments
    /* $mail->addAttachment('../documentos/cedula_beneficiarios/65e8bf3978b2a.jpg');  */        //Add attachments
    /* $mail->addStringAttachment($pdf_content, 'Report.pdf', 'base64', 'application/pdf');     */ //Para adjuntar documentos
  /*  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');     *///Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'Hola mi amol es una prueba mia, me dices que me amas o q?';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}