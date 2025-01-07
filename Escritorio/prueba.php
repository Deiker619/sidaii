<?php



include_once("../php/01-atenciones.php");
$aten = new Atenciones(1);
$consulta = $aten->consultarTodosAtencionesa();
$cantidadRegistros = count($consulta);
if ($consulta) {
    foreach ($consulta as $registros) {

        echo '<tr>' ?>
        <td> <?php echo $registros["numero_aten"] ?></td>
        <td><a class="cedula" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>

        <?php
        echo '<td>' . $registros["nombre"] . '</td>' .
            '<td>' . $registros["apellido"] . '</td>' .
            '<td>' . $registros["nombre_estado"] . '</td>' .
            '<td>' . $registros["nombre_e"] . '</td>' .
            '<td>' . $registros["atencion_brindada"] . '</td>' .
            '<td>' . $registros["nombre_ayuda"] . '</td>'; ?>
        <td style="padding: 12px;">
            <div style="display: inline-flex; position: relative;">
                <?php if ($registros['institucion']) { ?>
                    <b><small class="tag <?php echo $registros['institucion'] ?>">#<?php echo $registros['institucion']; ?></small></b>
                <?php  } ?>
                <?php echo $registros["por"] ?>
            </div>
        </td>
        <td>Atendido</td>
        <?php if ($registros["atencion_brindada"] == "-ayudatec") { ?>
            <td style="padding: 0;"><a href="reportes/reporteAtencion.php?numero_aten=<?php echo $registros["numero_aten"] ?>" class="cargar" style="margin: 5px"> <i class='bx bx-download'></i></a></td>
            <td style="padding: 0;"> <a class="cargar" style="margin: 5px" href="reportes/reporteCargarSolicitudes.php?numero_aten=<?php echo $registros["numero_aten"]; ?>"><i class='bx bx-download'></i></a></td>
            <td style="padding: 0;"> <a id="verBeneficiario" href="documentos/informes/<?php echo $registros['informe'] ?? '404'; ?>" class="cargar" style="margin: 5px"> <i class='bx bx-download'></i> </a></td>
        <?php
        } else {
            echo '<td></td>
            <td></td>
            <td></td>
         ';
        }

        ?>
        <td>
            <div class="enviar">
                <?php if ($registros["atencion_solicitada"]) { ?>
                    <div class="enviar_text"> <i class='bx bx-mail-send' onclick="enviarEmail('<?php echo $registros['numero_aten'] ?>','<?php echo $registros['email'] ?? null ?>')" style="color:#3ab556; cursor:pointer"></i></div>
                <?php } else { ?>

                    <div class="enviar_text"> <i class='bx bx-no-entry' style="color:crimson; cursor:not-allowed "></i></div>
                <?php } ?>
            </div>
        </td>

<?php



        /* include_once("../php/6-remitir.php");
            $atens = new remitido(1);
            $ci = $registros["cedula"];
            $atens->setcedula($ci);
            $consultas = $atens->consultarRemitido();
            if (!$consultas) {Y
        
                echo '<td><a href="11-Remitir.php?cedula='.$registros["cedula"].'" class="remitir">Remitir Reg</a></td>';
            } else {
                echo '<td> "Remitido" </td>';
            }
            echo '<td><a href="" class="eliminar">Eliminar Reg</a></td>
            </tr>'; */
    }
}


?>