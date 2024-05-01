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
            h3{
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
                font-size: 15px;
                margin-bottom:50px ;


            }
            .pulgar{
                width: 100px;
                border: 1px solid #ddd;
                height: 100px;
                position: relative;
                left: 37%;
            }

            .footer{
                border: 0px;
                margin-top:50% ;
            }
        </style>
    </head>

    <body>
        <?php

        include_once("../../php/12-historia_medica_protesis.php");

        $codigo_cita = $_REQUEST["codigo_cita"];
        $aten =  new historia_medica_protesis(1);

        $aten->setcodigo_cita($codigo_cita);
        $consulta = $aten->consultarHistoriaProtesis();
        $cantidadRegistros = count($consulta);
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
                    <img src="<?php echo $imagenBase64?>" width="100%">
                    <h3>Cod. Historia Medica: <?php echo $consulta["codigo_cita"] ?> </h3>

                    <div class="tabla-atencion" style="width: 100%;">


                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cedula</th>

                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["nombre"] ?> </td>
                                    <td><?php echo $consulta["apellido"] ?> </td>
                                    <td><?php echo $consulta["cedula"] ?> </td>
                                </tr>

                            </tbody>
                        </table>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Municipio</th>
                                    <th>Parroquia</th>

                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["estado"] ?> </td>
                                    <td><?php echo $consulta["municipio"] ?> </td>
                                    <td><?php echo $consulta["parroquia"] ?> </td>
                                </tr>

                            </tbody>
                        </table>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Discapacidad</th>
                                    <th>Fecha de Nacimiento</th>
                                    <th>Telefono</th>

                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["discapacidad"] ?> </td>
                                    <td><?php echo $consulta["fecha_naci"] ?> </td>
                                    <td><?php echo $consulta["telefono"] ?> </td>
                                </tr>

                            </tbody>
                        </table>


                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Edad</th>
                                    <th>Sexo</th>
                                    <th>Tipo de artificio</th>
                                    <th>Nivel de actividad</th>

                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["edad"] ?> </td>
                                    <td><?php echo $consulta["sexo"] ?> </td>
                                    <td><?php echo "Protesis"; ?> </td>
                                    <td><?php echo $consulta["nivel_actividad"] ?> </td>
                                </tr>

                            </tbody>
                        </table>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nivel de Amputacion</th>
                                    <th>Lado de amputación</th>
                                    <th>Zona afectada</th>
                                    <th>Diseño</th>

                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["nivel_amputacion"] ?> </td>
                                    <td><?php echo $consulta["lado_amputacion"] ?> </td>
                                    <td><?php echo $consulta["z_afectada"] ?> </td>
                                    <td><?php echo $consulta["diseno"] ?> </td>
                                </tr>

                            </tbody>
                        </table>
                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Estado del muñon</th>
                                   

                                </tr>

                            </thead>
                        </table>

                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Musculatura</th>
                                    <th>Forma</th>
                                    <th>Cicatriz</th>
                                    <th>Piel</th>


                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["musculatura"] ?> </td>
                                    <td><?php echo $consulta["forma"] ?> </td>
                                    <td><?php echo $consulta["cicatriz"] ?> </td>
                                    <td><?php echo $consulta["piel"] ?> </td>
                                  

                                </tr>

                            </tbody>
                        </table>



                        <table style="width:100%">
                            <thead>
                                <tr>
                                    <th>Caracteristicas de la Protesis</th>
                                   

                                </tr>

                            </thead>
                        </table>

                        <table style="width:100%">
                            <thead>
                                <tr class="tipo">
                                    <th>Rodilla</th>
                                    <th>Pie</th>
                                    <th>Socket</th>
                                    <th>Clasificacion del socket</th>
                                    <th>Metodo de suspension</th>


                                </tr>

                            </thead>
                            <tbody>


                                <tr>
                                    <td><?php echo $consulta["tipo_rodilla"] ?> </td>
                                    <td><?php echo $consulta["tipo_pie"] ?> </td>
                                    <td><?php echo $consulta["tipo_socket"] ?> </td>
                                    <td><?php echo $consulta["clasificacion_socket"] ?> </td>
                                    <td><?php echo $consulta["metodo_suspension"] ?> </td>
                                  

                                </tr>

                            </tbody>
                        </table>

                        <textarea name="" id="" cols="50" rows="50" placeholder="observaciones">Observaciones: Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde praesentium accusantium voluptatibus natus! Earum id itaque ullam autem error, at labore illo sit aliquam nulla, ipsam quis mollitia, expedita quaerat!</textarea>

                        <table class="footer" style="border: 0px">
                            <thead>
                                <th> <label for="">Firma de beneficiario </label><br>
                                    <!-- <div class="pulgar">

                                    </div> -->
                                </th>
                                <th> <label for="">Firma del tecnico </label><br>
                                    <!-- <div class="pulgar">

                                    </div> -->
                                </th>
                                <th> <label for="">Asis. Tecnico </label><br>
                                    
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
        /*     echo $html; */

        require_once("../../dompdf/autoload.inc.php");

        $dompdf = new Dompdf();
        $option = $dompdf->getOptions();

        $option->set(array('isRemoteEnable' => true));
        $dompdf->setOptions($option);

        $dompdf->loadHtml($html);
        /* $dompdf->setPaper('letter'); */
        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

        $nombre = $consulta["cedula"]."-".$consulta["codigo_cita"];
        $dompdf->stream($nombre, array("Attachment" => false));


        ?>
    </body>