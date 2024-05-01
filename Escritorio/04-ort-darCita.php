<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y Protesis: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            /* session_start(); */
            include_once("../php/01-02-cita_protesis.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new citas_protesis(1);

            $aten->setid($numero);
            $registro = $aten->consultarCita();
            ?>

            <header>
                Asignar historia medica a <?php echo $registro["nombre"] ?>
            </header>
            <div class="fecha" id="fecha_registro"><?php echo date("Y-m-d");
                                                    $fecha_aten = date("Y-m-d");
                                                    ?>
                <?php

                if ($registro) {
                ?>
                    <form action="" method="post">
                        <div class="form first">
                            <div class="details personal">
                                <span class="title">Historia medica para toma de medidas</span>
                                <div class="fields">

                                    <div class="input-field">
                                        <label>Cedula</label>
                                        <input type="text" required readonly name="cedula" id="cedula" value="<?php echo $registro["cedula"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Nombre</label>
                                        <input type="text" required readonly name="nombre" id="nombre" value="<?php echo $registro["nombre"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Apellido</label>
                                        <input type="text" required readonly name="apellido" id="apellido" value="<?php echo $registro["apellido"] ?>">
                                    </div>


                                    <div class="input-field">
                                        <label>Discapacidad</label>
                                        <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad" value="<?php echo $registro["discapacidad"] ?>">
                                    </div>


                                    <div class="input-field">
                                        <label>Fecha de nacimiento</label>
                                        <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["fecha_naci"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Telefono</label>
                                        <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["telefono"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Edad</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["edad"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Sexo</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["sexo"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Estado</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["estado"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Municipio</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["municipio"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Parroquia</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["parroquia"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Codigo de cita</label>
                                        <input type="text" required readonly name="id" id="id" value="<?php echo $registro["id"] ?>">
                                    </div>


                                    <!-- 
                            <div class="input-field">
                                <label>fecha de entrega</label>
                                <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo date("Y-m-d") ?>" >
                            </div>
 -->

                                    <!--     <div class="input-field">
                                    <label>Laboratorio para la cita:</label>
                                    <select name="laboratorio" id="laboratorio" require>
                                        <option value="4-tomedi">Toma de medidas</option>
                                    </select>
                                </div>
                                <div class="input-field">
                                    <label>Fecha de la cita:</label>
                                    <input type="date" id="fecha_cita" name="fecha_cita" require>
                                </div> -->


                                </div>

                                <div class="details personal">
                                    <span class="title">Datos tecnicos</span>
                                    <div class="fields">


                                        <div class="checkboxes">
                                            <label class="cl-checkbox">
                                                <input checked="protesis" type="radio" name="artificio" value="-protesis" id="protesis">
                                                <span>Artificio: Protesis</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="artificio" value="-ortesis" id="ortesis">
                                                <span>Artificio: Ortesis</span>
                                            </label>

                                        </div>

                                    </div>



                                </div>
                                <div class="details personal">
                                    <span class="title"></span>
                                    <div class="fields">


                                        <div class="input-field" id="art-ort">
                                            <label>Elije el artificio para medidas</label>
                                            <select name="artificioO" id="artificioO">
                                                <option value="">Elije una opcion</option>
                                                <?php
                                                include_once("../php/01-03-toma_medidas.php");
                                                $protesis = new toma_medidas(1);

                                                $consulta = $protesis->consultarTodasOrtesis();
                                                if ($consulta) {
                                                    foreach ($consulta as $consult) {
                                                        echo "<option value =" . $consult["id"] . ">" . $consult["nombre"] . "</option>";
                                                    }
                                                }

                                                ?>

                                            </select>
                                        </div>


                                    </div>

                                </div>

                                <!-- Contenedor de ORTESIS -->
                                <div class="details personal" id="or">


                                    <span class="title">Diseño ortesico</span>
                                    <div class="fields">

                                        <div class="checkboxes">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="dis-or" value="convencional" id="ortesis">
                                                <span>Convencional</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="dis-or" value="termoplastico" id="ortesis">
                                                <span>Termoplastico</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="dis-or" value="hibrido" id="ortesis">
                                                <span>Hibrido</span>
                                            </label>

                                        </div>
                                    </div>
                                    <div class="fields">
                                        <span class="title">Lado afectado</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="or-afect" value="Derecho" id="ortesis">
                                                <span>Derecho</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="or-afect" value="Izquierdo" id="ortesis">
                                                <span>Izquierdo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="or-afect" value="Bilateral" id="ortesis">
                                                <span>Bilateral</span>
                                            </label>

                                        </div>




                                    </div>
                                    <div class="fields" style="margin-top: 15px">
                                        <div class="input-field">
                                            <label>Seleccione alguna de las opciones del lugar afectado</label>
                                            <select name="op-lugar-afect" id="op-lugar-afect" style="border-color: green">
                                                <option></option>
                                                <option value="hombro">Hombro, brazo y codo</option>
                                                <option value="antebrazo">Antebrazo y mano</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="fields" id="antebrazo">
                                        <span class="title">Antebrazo y mano</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="anbrz" value="Ferula larga" id="ortesis">
                                                <span>Ferula larga</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="anbrz" value="ferula corta" id="ortesis">
                                                <span>Ferula corta</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="anbrz" value="Pocisionadora" id="ortesis">
                                                <span>Pocisionadora</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="anbrz" value="Guante flexor" id="ortesis">
                                                <span>Guante flexor</span>
                                            </label>
                                            <label class="cl-checkbox">
                                                <input type="radio" name="anbrz" value="Ferula de epicondilitis" id="ortesis">
                                                <span>Ferula de epicondilitis</span>
                                            </label>

                                            <!--   <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="termoplastico" id="ortesis">
                                                <span>Izquierdo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="hibrido" id="ortesis">
                                                <span>Bilateral</span>
                                            </label> -->

                                        </div>




                                    </div>

                                    <div class="fields" id="hombro-div">
                                        <span class="title">Hombro, brazo y codo</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="Cabestrillo" id="ortesis">
                                                <span>Cabestrillo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="Inmovulizador de hombro" id="ortesis">
                                                <span>Inmovulizador de hombro</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="Inmovilizador de hombro y brazo" id="ortesis">
                                                <span>Inmovilizador de hombro y brazo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="Brace movilizador" id="ortesis">
                                                <span>Brace movilizador</span>
                                            </label>

                                            <!--   <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="termoplastico" id="ortesis">
                                                <span>Izquierdo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="hibrido" id="ortesis">
                                                <span>Bilateral</span>
                                            </label> -->

                                        </div>




                                    </div>
                                    <div class="fields">
                                        <span class="title">Nervio afectado</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="nervio-afect" value="Paralisis de plexo braquial" id="ortesis">
                                                <span>Paralisis de plexo braquial</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="nervio-afect" value="Paralisis radial" id="ortesis">
                                                <span>Paralisis radial </span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="nervio-afect" value="Paralisis cubital" id="ortesis">
                                                <span>Paralisis cubital</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="nervio-afect" value="Paralisis de mediano cubital" id="ortesis">
                                                <span>Paralisis de mediano cubital</span>
                                            </label>

                                            <!--   <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="termoplastico" id="ortesis">
                                                <span>Izquierdo</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="hbc" value="hibrido" id="ortesis">
                                                <span>Bilateral</span>
                                            </label> -->

                                        </div>




                                    </div>










                                </div>
                                <div class="details personal" id="or-inf">



                                    <div class="fields" id="cadera">
                                        <span class="title">Cadera, muslo, pierna, pie</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Aparato largo con banda pelvica" id="ortesis">
                                                <span>Aparato largo con banda pelvica</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Aparato largo sin banda pelvica" id="ortesis">
                                                <span>Aparato largo sin banda pelvica</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="AFO" id="ortesis">
                                                <span>Ferula antiequina (AFO)</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Ferula de reaccion anterior" id="ortesis">
                                                <span>Ferula de reaccion anterior</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Ferula de Harris" id="ortesis">
                                                <span>Ferula de Harris</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Brace movilizador (MUSLO)" id="ortesis">
                                                <span>Brace movilizador (MUSLO)</span>
                                            </label>


                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Brace movilizador (Pierna)" id="ortesis">
                                                <span>Brace movilizador (Pierna)</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="CMPP" value="Plantilla de descanso movil" id="ortesis">
                                                <span>Plantilla de descanso movil</span>
                                            </label>




                                        </div>




                                    </div>
                                    <div class="fields" id="C-S-M">
                                        <span class="title">Clasificacion segun el tipo de material</span>
                                        <div class="checkboxes" style="flex-direction: column">


                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="Rigida Alta" id="ortesis">
                                                <span>Rigida Alta</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="Densidad" id="ortesis">
                                                <span>Densidad</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="Blanda baja" id="ortesis">
                                                <span>Blanda baja</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="Articulada" id="ortesis">
                                                <span>Articulada</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="Alta densidad" id="ortesis">
                                                <span>Alta densidad</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" name="clasificacion" value="otros" id="ortesis">
                                                <span>otros</span>
                                            </label>





                                        </div>




                                    </div>




                                </div>



                                <!-- Contenedor de PROTESIS -->


                                <div class="details personal pro" id="pro">
                                    <span class="title">Nivel de actividad</span>
                                    <div class="checkboxes" style="flex-direction: column">


                                        <label class="cl-checkbox">
                                            <input type="radio" name="nivel_actividad" value="Sedentaria" id="nivel_actividad">
                                            <span>Sedentaria</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="nivel_actividad" value="Activa" id="nivel_actividad">
                                            <span>Activa</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="nivel_actividad" value="Deportista" id="nivel_actividad">
                                            <span>Deportista</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="radio" name="nivel_actividad" value="Media" id="nivel_actividad">
                                            <span>Media</span>
                                        </label>


                                    </div>
                                    <!--    <span class="title">Diseño ortesico</span> -->
                                    <span class="title">Fecha y causa</span>
                                    <div class="fields">

                                        <div class="input-field">
                                            <label>Fecha de amputación</label>
                                            <input type="date" name="fecha_amp" id="fecha_amp">
                                        </div>
                                        <div class="input-field">
                                            <label>Causa de la amputacion</label>
                                            <input type="text" name="causa_amp" id="causa_amp">
                                        </div>
                                    </div>

                                    <span class="title">Lado de amputacion</span>
                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="lado_amp" value="Derecho" id="lado_amp">
                                            <span>Derecho</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="lado_amp" value="Izquierdo" id="lado_amp">
                                            <span>Izquierdo</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="lado_amp" value="Bilateral" id="lado_amp">
                                            <span>Bilateral</span>
                                        </label>


                                    </div>
                                    <span class="title">Nivel de amputacion</span>
                                    <div class="fields" style="margin-top: 15px">
                                        <div class="input-field">
                                            <label>Seleccione el nivel de amputacion</label>
                                            <select style="border-color: green" id="nivel_amp" name="nivel_amp">
                                                <option></option>
                                                <option value="Brazo">Brazo</option>
                                                <option value="Pierna">Pierna</option>
                                                <option value="Pie">Pie</option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="fields" id="niveles_ampu_br">
                                        <div class="checkboxes" style="flex-direction: column">
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Metacarpiana">
                                                <span>Metacarpiana</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Desarticulacion de muñeca (Codo)">
                                                <span>Desarticulacion de muñeca (Codo)</span>
                                            </label>
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Desarticulacion de muñeca (Hombro)">
                                                <span>Desarticulacion de muñeca (Hombro)</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Trans radial">
                                                <span>Trans radial</span>
                                            </label>
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Trans humeral">
                                                <span>Trans humeral</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_br" name="nivel_amp_br" value="Hemicoporectomia">
                                                <span>Hemicoporectomia</span>
                                            </label>



                                        </div>

                                    </div>
                                    <div class="fields" id="niveles_ampu_pier">
                                        <div class="checkboxes" style="flex-direction: column">
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Desarticulado de pelvis">
                                                <span>Desarticulado de pelvis</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Hemipelvectomia">
                                                <span>Hemipelvectomia</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transfemoral proximal">
                                                <span>Transfemoral proximal</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transfemoral medial">
                                                <span>Transfemoral medial</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transfemoral distal">
                                                <span>Transfemoral distal</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Desarticulacion de rodilla">
                                                <span>Desarticulacion de rodilla</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transtibial proximal">
                                                <span>Transtibial proximal</span>
                                            </label>
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transtibial medial">
                                                <span>Transtibial medial</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pier" name="nivel_amp_pier" value="Transtibial Distal">
                                                <span>Transtibial Distal</span>
                                            </label>



                                        </div>

                                    </div>
                                    <div class="fields" id="niveles_ampu_pies">
                                        <div class="checkboxes" style="flex-direction: column">
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pie" name="nivel_amp_pie">
                                                <span>Pirogoff</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pie" name="nivel_amp_pie">
                                                <span>Syme</span>
                                            </label>
                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pie" name="nivel_amp_pie">
                                                <span>Syme</span>
                                            </label>


                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pie" name="nivel_amp_pie">
                                                <span>Syme</span>
                                            </label>

                                            <label class="cl-checkbox">
                                                <input type="radio" id="nivel_amp_pie" name="nivel_amp_pie">
                                                <span>Syme</span>
                                            </label>










                                        </div>

                                    </div>

                                    <span class="title">Estado del muñon</span>
                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Forma</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Forma" value="Cilindrica" id="Forma">
                                            <span>Cilindrica</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Forma" value="Conica" id="Forma">
                                            <span>Conica</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Forma" value="Bulbosa" id="Forma">
                                            <span>Bulbosa</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Forma" value="Osea" id="Forma">
                                            <span>Osea</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Forma" value="Edematosa" id="Forma">
                                            <span>Edematosa</span>
                                        </label>


                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Cicatriz</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Cicatriz" value="Curada" id="Cicatriz">
                                            <span>Curada</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Cicatriz" value="Sensible" id="Cicatriz">
                                            <span>Sensible</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Cicatriz" value="Abierta" id="Cicatriz">
                                            <span>Abierta</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Cicatriz" value="Envaginada" id="Cicatriz">
                                            <span>Envaginada</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Cicatriz" value="Adherente" id="Cicatriz">
                                            <span>Adherente</span>
                                        </label>


                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="piel">Piel</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="piel" value="Decolorada" id="piel">
                                            <span>Decolorada</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="piel" value="Callosa" id="piel">
                                            <span>Callosa</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="piel" value="Sensible" id="piel">
                                            <span>Sensible</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="piel" value="Abrazon" id="piel">
                                            <span>Abrazon</span>
                                        </label>
                                        <label class="cl-checkbox">
                                            <input type="radio" name="piel" value="Fria" id="piel">
                                            <span>Fria</span>
                                        </label>


                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Musculatura</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Musculatura" value="Firme" id="Musculatura">
                                            <span>Firme</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Musculatura" value="Intermedia" id="Musculatura">
                                            <span>Intermedia</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Musculatura" value="Blanda" id="Musculatura">
                                            <span>Blanda</span>
                                        </label>


                                    </div>

                                    <span class="title">Diseño protesico</span>
                                    <div class="fields" style="margin-top: 15px">
                                        <div class="input-field">
                                            <label>Seleccione el diseño protesico</label>
                                            <select style="border-color: green" id="diseno_pro" name="diseno_pro">
                                                <option></option>
                                                <option value="Convencional">Convencional</option>
                                                <option value="Modulares">Modulares</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Tipo de rodilla</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_rodilla" value="Convencional" id="t_rodilla">
                                            <span>Convencional</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_rodilla" value="Geriatrico" id="t_rodilla">
                                            <span>Geriatrico</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_rodilla" value="Monocentrica" id="t_rodilla">
                                            <span>Monocentrica</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_rodilla" value="Policentrica" id="t_rodilla">
                                            <span>Policentrica</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_rodilla" value="Otros" id="t_rodilla">
                                            <span>Otros</span>
                                        </label>


                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Tipo de Pie</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_pie" value="Articulado" id="t_pie">
                                            <span>Articulado</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_pie" value="Dinamico" id="t_pie">
                                            <span>Dinamico</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_pie" value="Sach" id="t_pie">
                                            <span>Sach</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_pie" value="Otros" id="t_pie">
                                            <span>Otros</span>
                                        </label>



                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Tipo de Socket</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_socket" value="Contacto total" id="t_socket">
                                            <span>Contacto total </span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_socket" value="De succión" id="t_socket">
                                            <span>De succión</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="t_socket" value="Sin succión" id="t_socket">
                                            <span>Sin succión</span>
                                        </label>




                                    </div>

                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Clasificacion de socket</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="c_socket" value="Cuadrilatero" id="c_socket">
                                            <span>Cuadrilatero</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="c_socket" value="Inclusion isquial" id="c_socket">
                                            <span>Inclusion isquial</span>
                                        </label>

                                        <input type="text" class="input_checkbox" name="max" id="max">
                                        <label class="cl-checkbox input_checkbox">
                                            MAX
                                        </label>

                                        <input type="text" class="input_checkbox" name="ptb" id="ptb">
                                        <label class="cl-checkbox input_checkbox">
                                            PTB
                                        </label>

                                        <input type="text" class="input_checkbox" id="pts" name="pts">
                                        <label class="cl-checkbox input_checkbox">
                                            PTS
                                        </label>
                                        <input type="text" class="input_checkbox" id="kbm" name="kbm">
                                        <label class="cl-checkbox input_checkbox">
                                            KBM
                                        </label>



                                    </div>



                                    <div class="fields">
                                        <div class="input-field">
                                            <label for="">Metodo de suspension</label>
                                        </div>
                                    </div>

                                    <div class="checkboxes">
                                        <label class="cl-checkbox">
                                            <input type="radio" name="Meto_suspension" value="Correa a supracondilar" id="Meto_suspension">
                                            <span>Correa a supracondilar</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Meto_suspension" value="Correa eslatica" id="Meto_suspension">
                                            <span>Correa eslatica</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Meto_suspension" value="Sanda silesiana" id="Meto_suspension">
                                            <span>Sanda silesiana</span>
                                        </label>

                                        <label class="cl-checkbox">
                                            <input type="radio" name="Meto_suspension" value="Banda pelvica" id="Meto_suspension">
                                            <span>Banda pelvica</span>
                                        </label>



                                    </div>

                                </div>





                                <div class="details personal">
                                    <span class="title">Datos del tecnico</span>
                                    <div class="fields">


                                        <div class="input-field">
                                            <label>Nombre y apellido</label>
                                            <input type="text" required name="" id="">
                                        </div>

                                        <div class="input-field">
                                            <label>Cedula</label>
                                            <input type="text" required readonly name="" id="">
                                        </div>
                                        <div class="input-field">
                                            <label>Asigna fecha para toma de medidas</label>
                                            <input type="date" required name="fecha_cita" id="fecha_cita">
                                        </div>



                                    </div>

                                </div>

                                <div class="details personal">
                                    <span class="title">Observaciones</span>
                                    <div class="fields">


                                        <div class="input-field" id="art-ort">
                                            <label>Ingrese la observacion</label>
                                            <textarea name="" id="" cols="40" rows="10"></textarea>

                                        </div>


                                    </div>

                                </div>

                                <button class="nextBtn" name="registro" id="registro">
                                    <span class="btnText">Dar cita</span>
                                    <ion-icon name="send-outline"></ion-icon>
                                </button>


                            </div>
                        </div>


                    <?php

                }
                    ?>

                    </form>


            </div>
        </div>
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>
        <script src="historiaMedica.js"></script>



        <?php
        include_once("parteabajo.php");
        ?>
        <script>
            function redireccionar(a) {

                url = 'reportes/historia_medica.php?codigo_cita=' + a;

                window.open(url, "_blank");
            }

            function redireccionarP(a) {

                url = 'reportes/historia_medica_protesis.php?codigo_cita=' + a;
                window.open(url, "_blank");
            }
        </script>

        <script type="text/javascript">
            $(function() {
                $("#registro").click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {
                        var laboratorio = $("#laboratorio").val();
                        var id = <?php echo json_encode($numero); ?>;
                        var cedula = $("#cedula").val();
                        var fecha_cita = $("#fecha_cita").val();
                        var fecha_aper = <?php echo json_encode($fecha_aten); ?>;




                        console.log(fecha_aper, fecha_cita, id)

                        if (artificio == "-protesis") {
                            console.log("Artificio: " + artificio + " Nivel de Actividad: " + nivel_actividad + " Lado de amputacion: " + lado_amp +
                                " Nivel de amputacion: " + nivel_ampu + " Solicitud: " + niveles_AMPU + "Forma: " + forma +
                                "Cicatriz: " + Cicatriz + " Piel: " + piel + " Musculatura: " + Musculatura +
                                "Diseño Protesico: " + diseno_pro + " Tipo de rodilla: " + t_rodilla + " Tipo de pie: " + t_pie +
                                " Tipo de Socket: " + t_socket + " Clasificacion de socket: " + c_socket + " Metodo de suspension: " + Meto_suspension)
                        }

                        if (artificio_para_medidas == "ort-super") {
                            console.log("Artificio: " + artificio + "  Artificio para medidas: " + artificio_para_medidas +
                                " Zona afectada: " + lado_afect + " Diseño Ortesico: " + dis_or + " lado afectado: " + or_afect +
                                " Nervio afectado: " + nervio_afect + " Solicitud: " + a)

                            clasificacion = null
                            cmppp = null

                            console.log(cmppp, clasificacion)

                        }
                        if (artificio_para_medidas == "ort-infe") {
                            console.log("Artificio: " + artificio + "  Artificio para medidas: " + artificio_para_medidas + " Solicitud: " +
                                cmppp + " Clasificacion: " + clasificacion)

                            console.log(dis_or, nervio_afect, a)
                        }






                        e.preventDefault();

                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientohistoriamedica.php",
                            data: {
                                artificio: artificio,
                                artificio_para_medidas: artificio_para_medidas,
                                lado_afect: lado_afect,
                                dis_or: dis_or,
                                or_afect: or_afect,
                                nervio_afect: nervio_afect,
                                a: a,
                                cmppp: cmppp,
                                clasificacion: clasificacion,
                                cedula: cedula,
                                fecha_cita: fecha_cita,
                                id: id,
                                fecha_aper: fecha_aper,

                                /* Datos de protesis */
                                nivel_actividad: nivel_actividad,
                                nivel_ampu: nivel_ampu,
                                lado_amp: lado_amp,
                                niveles_AMPU: niveles_AMPU,
                                /*        nivel: nivel, */
                                forma: forma,
                                Cicatriz: Cicatriz,
                                piel: piel,
                                Musculatura: Musculatura,
                                diseno_pro: diseno_pro,
                                t_rodilla: t_rodilla,
                                t_socket: t_socket,
                                t_pie: t_pie,
                                c_socket: c_socket,
                                Meto_suspension: Meto_suspension
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'carga de historia medica',
                                    'text': data,
                                    'confirmButton': 'btn btn-success'
                                }).then(function() {

                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);



                                        },
                                        willClose: () => {

                                            window.location.href = "04-ortesisyProtesis.php"
                                        }
                                    });

                                    if (artificio == "-ortesis") {
                                        Toast.fire({
                                            icon: 'success',
                                            title: '¿Desea descargar PDF?',

                                            html: '<button onclick="redireccionar(<?php echo $registro["id"] ?>)" class="buttonDownload">Download</button>'
                                        });
                                    } else {
                                        Toast.fire({
                                            icon: 'success',
                                            title: '¿Desea descargar PDF?',

                                            html: '<button onclick="redireccionarP(<?php echo $registro["id"] ?>)" class="buttonDownload">Download</button>'
                                        });
                                    }


                                })
                            },
                            error: function(data) {
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Oops...',
                                    'text': data
                                })
                            }
                        })


                    }
                })
            })
        </script>