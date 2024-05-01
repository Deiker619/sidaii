<?php  

include_once("../php/03-usuario.php");
   $user = new Usuario(1);
session_start();
   if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
       $cedulauser = $_SESSION['cedula']; 
       $NombreUsuarioActivo = $_SESSION['nombre'];
       $rol = $_SESSION["rol"];
       $gerencia = $_SESSION['gerencia'];
   }

   if($rol == "1adm"){
        $rol = "Administrador";
   }
    if( $rol == "2coor") {
    $rol = "Coordinador";
   }
    if ($rol == "3supe"){
        $rol = "Superusuario";
   }

include_once("../php/01-discapacitados.php");
$aten = new Discapacitados(1);
$consulta = $aten->consultageneral();
$cantidadRegistros = count($consulta);
if ($consulta) {
    foreach ($consulta as $registros) {

       echo' <tr>'.

            '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
            '<td>'.$registros["nombre"] .'</td>'.
            '<td>'.$registros["apellido"] .'</td>'.
            '<td>'.$registros["nombre_estado"] .'</td>'.
            '<td>'.$registros["nombre_discapacidad"] .'</td>'.
            '<td>'.$registros["email"] .'</td>'.
            '<td>'.$registros["edad"] .'</td>'.
            '<td>'.$registros["certificado"] .'</td>'.
            '<td>'.$registros["registrado_por"] .'</td>';

             if ($rol == "Superusuario") { 
                echo '<td><a href="eliminar/eliminarbeneficiario.php?cedula='.$registros["cedula"].'"class="eliminar">Eliminar Reg</a></td>';
             } 
       echo "</tr>";

    }
}


?>