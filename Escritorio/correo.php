<?php
$to = 'torresanibal388@gmail.com';
$subject = 'Cambio de contraseña';
$message = 'Haz clic en el enlace para cambiar tu contraseña: https://www.tusitio.com/cambiarcontrasena?token=abc123';
$headers = 'From: postmaster@localhost' . "\r\n" .
    'Reply-To: postmaster@localhost' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>
