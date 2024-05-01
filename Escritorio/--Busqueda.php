<?php 
include_once("../php/--classbuscar.php");


$cedula = $_POST["input_search"];
$busqueda = new busqueda(1);


$busqueda->setcedula($cedula);
$consulta = $busqueda->Beneficiarios();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {

     echo '<div class="tabla-atencion">

                                <h2>Beneficiario</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>Estado</th>
                                            <th>Discapacidad</th>
                                            <th>Atencion Solicitada</th>
                                             


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>'.

                                                '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["nombre"].'</td>'.
                                                    '<td>'.$registros["apellido"].'</td>'.
                                                    '<td>'.$registros["estado"].'</td>'.
                                                    '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'.
                                                    /* '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}

$consulta = $busqueda->atenciones();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {

     echo '<div class="tabla-atencion">

                                <h2> Se encontro en: Personas para atencion a traves de OAC</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de atencion </th>
                                            <th>Atencion recibida</th>
                            
                                            


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["numero_aten"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_aten"].'</td>'.
                                                    '<td>'.$registros["atencion_recibida"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                    

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}

$consulta = $busqueda->estadal();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {

     echo '<div class="tabla-atencion">

                                <h2> Se encontro en: Personas para atencion a traves de operacion estadal</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de atencion </th>
                                            <th>Atencion recibida</th>
                            
                                            


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["numero_aten"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_aten"].'</td>'.
                                                    '<td>'.$registros["atencion_recibida"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                    

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}


$consulta = $busqueda->remitidos();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en remitidos</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Departamento</th>
                                            <th>Fecha</th>
                            
                                            <th></th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["departamento"].'</td>'.
                                                    '<td>'.$registros["fecha"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}


$consulta = $busqueda->participante_encuentro();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Participante de encuentro</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                      
                                            <th>ID de encuentro</th>
                            
                                       


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td>'.$registros["cedula"].'</td>'.
                                                    
                                                    '<td>'.$registros["encuentro"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}

$consulta = $busqueda->participante_escuela();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Participante de escuela</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID del curso</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                           


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id_curso"].'</td>'.
                                                    '<td>'.$registros["cedula"].'</td>'.
                                                    '<td>'.$registros["nombre"].'</td>'.
                                                    '<td>'.$registros["apellido"].'</td>'.
                                                    /* '<td>'.$registros["curso"].'</td>'. */
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}

$consulta = $busqueda->participantes_taller();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Participante de Taller</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de inscrito</th>
                                            <th>ID taller</th>


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_recibido"].'</td>'.
                                                    /* '<td>'.$registros["apellido"].'</td>'. */
                                                    '<td>'.$registros["taller"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}



$consulta = $busqueda->toma_medidas();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Toma de medidas</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de medidas</th>
                                            <th>Artificio</th>
                                            


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_medidas"].'</td>'.
                                                    /* '<td>'.$registros["apellido"].'</td>'. */
                                                    '<td>'.$registros["artificio"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}

$consulta = $busqueda->prueba_artificios();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Prueba de artificio</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de prueba</th>
                                            <th>Artificio</th>
                                          


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_pruebas"].'</td>'.
                                                    /* '<td>'.$registros["apellido"].'</td>'. */
                                                    '<td>'.$registros["artificio_prueba"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}


$consulta = $busqueda->personas_jornadas();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Atendido en Jornada</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>ayuda tecnica otorgada</th>
                                            


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["numero_jornada"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["nombre"].'</td>'.
                                                    '<td>'.$registros["apellido"].'</td>'.
                                                    '<td>'.$registros["ayuda_tecnica"].'</td>'.
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}



$consulta = $busqueda->ayudas_tecnicas();
$cantidadRegistros = count($consulta);


if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Ayudas tecnicas</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>ayuda tecnica otorgada</th>
                                          


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td>'.$registros["tipo_ayuda_tec"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                   /*  '<td>'.$registros["apellido"].'</td>'.
                                                    '<td>'.$registros["ayuda_tecnica"].'</td>'. */
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
}


$consulta = $busqueda->audiometria();
$cantidadRegistros = count($consulta);

if ($consulta) {
    foreach ($consulta as $registros) {
        

     echo '<div class="tabla-atencion">

                                <h2>Se encontro en: Audiometria</h2>
                                <table>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Cedula</th>
                                            <th>Fecha de cita</th>
                                          


                                        </tr>
                                    </thead>
                                    <tbody>

                                                <tr>

                                                    <td>'.$registros["id"].'</td>'.
                                                    '<td><a href="__verBeneficiario.php?cedula='.$registros["cedula"].'"'.'class="cedula" id="verBeneficiario">'.$registros["cedula"].'</a></td>'.
                                                    '<td>'.$registros["fecha_cita"].'</td>'.
                                                   /*  '<td>'.$registros["apellido"].'</td>'.
                                                    '<td>'.$registros["ayuda_tecnica"].'</td>'. */
                                                   /*  '<td>'.$registros["discapacidad"].'</td>'.
                                                    '<td>'.$registros["atencion_solicitada"].'</td>'. */
                                                  /*   '<td style="color: red;">sin atencion</td>'. */

                                                '</tr>
                                        

                                    </tbody>
                                </table>
                            </div>';
    }
    }