<?php
include_once("03-usuario.php");

// Verificamos si se ha enviado el parámetro 'desbloquear' en la URL
if (isset($_GET['desbloquear'])) {

    // Creamos un nuevo objeto Usuario
    $usuario = new Usuario(1);
    
    // Llamamos al método cambiarEstadoBloqueo con la cédula del usuario y el nuevo estado
    $usuario->cambiarEstadoBloqueo($_GET['desbloquear'], 0);

    // Recargamos la página tecnologia.php
    header("Location: ../Escritorio/tecnologia.php"); // Esto recargará la página tecnologia.php
    exit();
}


if (isset($_GET['bloquear'])) {

    // Creamos un nuevo objeto Usuario
    $usuario = new Usuario(1);
    
    // Llamamos al método cambiarEstadoBloqueo con la cédula del usuario y el nuevo estado
    $usuario->cambiarEstadoBloqueo($_GET['bloquear'], 1);

    // Recargamos la página tecnologia.php
    header("Location: ../Escritorio/tecnologia.php"); // Esto recargará la página tecnologia.php
    exit();
}
?>