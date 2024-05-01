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
    <link rel="stylesheet" href="../estilo.css">

    <link rel="stylesheet" href="../dash.css">

    <link rel="stylesheet" href="../02-buttons/01-buttons.css">

    <!-- Boxicon -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- Icons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/ css/line.css">

    <!--  Boostrap-->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Documento PDF</title>
</head>

<body>


    <div class="dash-contenido">
        <div class="overview">
            <div class="titulo">
                <!--  <i class='bx bxs-dashboard'> </i> -->
                <span class="link-name"></span>
            </div>
        </div>


        <div class="tabla-atencion">
            <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
            <h2>JORNADAS </h2>
            <table>
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Municipio</th>
                        <th>Numero de Personas a atender</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    include_once("../php/02-jornadas.php");
                    $aten = new Jornadas(1);
                    $consulta = $aten->consultarTodosJornadas();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>

                                <td><?php echo $registros["nombre_estado"] ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["numero_personas"] ?></td>
                                <td><a href="02-AsignarJornada.php?id=<?php echo $registros["id"] ?>">Ver jornada</a></td>
                                <td><a href="eliminar/jornadas.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>

    <?php

    $html = ob_get_clean();
    /*     echo $html; */

    require_once("../../dompdf/autoload.inc.php");

    $dompdf = new Dompdf();
    $option = $dompdf->getOptions();

    $option->set(array('isRemoteEnable' => true));
    $dompdf->setOptions($option);

    $dompdf->loadHtml($html);
    /* $dompdf->setPaper('letter'); */
    $dompdf->setPaper('A4', 'landscape');

    $dompdf->render();
    $dompdf->stream("Archivo PDF", array("Attachment" => false));
    ?>
</body>