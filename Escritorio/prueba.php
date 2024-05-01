<?php



include_once("../php/01-atenciones.php");
$aten = new Atenciones(1);
$consulta = $aten->consultarTodosAtencionesa();
$cantidadRegistros = count($consulta);
if ($consulta) {
    foreach ($consulta as $registros) {

        echo '<tr>

            <td>' . $registros["cedula"] . '</td>' .
            '<td>' . $registros["nombre"] . '</td>' .
            '<td>' . $registros["apellido"] . '</td>' .
            '<td>' . $registros["nombre_estado"] . '</td>' .
            '<td>' . $registros["nombre_e"] . '</td>' .
            '<td>' . $registros["atencion_brindada"] . '</td>' .
            '<td>' . $registros["atencion_recibida"] . '</td>'.
            '<td style="color: green;">Atendido</td>';
            if($registros["atencion_brindada"]=="-ayudatec"){?>
              <td style="padding: 0;"><a href="reportes/reporteAtencion.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="cargar" style="margin: 5px" > <i class='bx bx-download'></i></a></td>
              <?php
            }else{
                echo '<td></td>';
            }


            /* include_once("../php/6-remitir.php");
            $atens = new remitido(1);
            $ci = $registros["cedula"];
            $atens->setcedula($ci);
            $consultas = $atens->consultarRemitido();
            if (!$consultas) {
        
                echo '<td><a href="11-Remitir.php?cedula='.$registros["cedula"].'" class="remitir">Remitir Reg</a></td>';
            } else {
                echo '<td> "Remitido" </td>';
            }
            echo '<td><a href="" class="eliminar">Eliminar Reg</a></td>
            </tr>'; */
        }
    }
?>