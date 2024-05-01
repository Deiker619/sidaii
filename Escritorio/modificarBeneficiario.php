<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Modificar beneficiario: <?php echo $rol ?></span>

        </div>
    </div>
    <div class="cont-registro">

        <div class="container">
            <?php include_once("../php/01-discapacitados.php");

            $cedula = $_REQUEST["cedula"];
            $aten =  new Discapacitados(1);

            $aten->setcedula($cedula);
            $consulta = $aten->consultarDiscapacitados();
            $direccion = $aten->consultarDirecciones();
            $cantidadRegistros = count($consulta);
            ?>

            <header>
                Modificar Beneficiario
            </header>



            <form action="" method="post" name="form-bene">
                <div class="form first">


                    <div class="details personal">
                        <span class="title">Datos Personales</span>
                        <div class="fields">


                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" placeholder="Ingresa el nombre " required id="nombre" value="<?php echo $consulta["nombre"] ?>" name="nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+">
                            </div>

                            <div class="input-field">
                                <label>Apellido</label>
                                <input type="text" placeholder="Ingresa el apellido " required id="apellido" value="<?php echo $consulta["apellido"] ?>" name="apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚ\s]+">
                            </div>

                            <div class="input-field">
                                <label>Cedula</label><span style="font-size: 13px; " id="label-chk"> Si es menor sin cedula coloque la cedula del tutor legal con un <b style="color: #38b000">1 o otro numero</b> al final</span>
                                <input type="number" placeholder="Ingrese la cedula sin puntos ni letras"  value="<?php echo $consulta["cedula"] ?>" id="cedula" name="cedula" pattern="^\d{5,9}$">
                                <span id="cedulaError"></span>
                            </div>
                            <div class="input-field">
                                <label>Nacionalidad</label>
                                <select name="nacionalidad" id="nacionalidad">
                                    <option value="V-">Venezolano</option>
                                    <option value="E-">Extranjero</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" value="<?php echo $consulta["email"] ?>" id="email" name="email">
                            </div>

                            <div class="input-field">
                                <label>Telefono</label>
                                <input type="number" placeholder="Ingresa tu numero de Telefono" required value="<?php echo $consulta["telefono"] ?>" id="telefono" name="telefono">
                            </div>


                            <div class="input-field">
                                <label>fecha de nacimiento</label>
                                <input type="date" placeholder="Ingresa fecha de nacimiento" required value="<?php echo $consulta["fecha_naci"] ?>" id="fecha_naci" name="fecha_naci">
                            </div>


                            <div class="input-field">
                                <label>Edad</label>
                                <input type="number" readonly placeholder="Ingresa tu edad" required value="<?php echo $consulta["edad"] ?>" id="edad" name="edad">
                            </div>
                            <div class="input-field">
                                <label>Sexo</label>

                                <select name="sexo" id="sexo" require>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>

                            <div class="input-field" id="chk-hijo">
                                <label>Numero de hijos</label>
                                <input type="number" placeholder="Ingresa el numero de hijos" require value="<?php echo $consulta["nro_hijo"] ?>" id="hijos" name="hijos">
                            </div>

                            <div class="input-field">
                                <label>Estado Civil</label>
                                <select name="civil" id="civil" require>
                                    <option value="casado/a">Casado/a</option>
                                    <option value="soltero/a">Soltero/a</option>
                                    <option value="divorciado/a">Divorciado/a</option>
                                    <option value="viudo/a">Viudo/a</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>¿Pertenece a una etnia indígena?</label>
                                <select name="etnia" id="etnia" require>
                                    <option value="no">No</option>
                                    <option value="si">Si</option>

                                </select>
                            </div>

                            <div class="input-field" id="indigenas">
                                <label>Nombre de la etnia indigena</label>
                                <input type="text" placeholder="Ingresa tu nacionalidad" id="indigena" name="indigena">
                            </div>


                        </div>

                        <div class="details personal">
                            <span class="title">Dirección de residencia</span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Estado</label>
                                    <select name="estado" id="estado" require>
                                        <option selected value="<?php echo  $consulta["estado"] ?>"><?php echo  $consulta["nombre_estado"]  ?></option>
                                        <option value="1">Amazonas</option>
                                        <option value="2">Anzoátegui</option>
                                        <option value="3">Apure</option>
                                        <option value="4">Aragua</option>
                                        <option value="5">Barinas</option>
                                        <option value="6">Bolívar</option>
                                        <option value="7">Carabobo</option>
                                        <option value="8">Cojedes</option>
                                        <option value="9">Delta Amacuro</option>
                                        <option value="24">Distrito Capital</option>
                                        <option value="10">Falcon</option>
                                        <option value="11">Guarico</option>
                                        <option value="21">La Guaira</option>
                                        <option value="12">Lara</option>
                                        <option value="13">Mérida</option>
                                        <option value="14">Miranda</option>
                                        <option value="15">Monagas</option>
                                        <option value="16">Nueva Esparta</option>
                                        <option value="17">Portuguesa</option>
                                        <option value="18">Sucre</option>
                                        <option value="19">Tachira</option>
                                        <option value="20">Trujillo</option>
                                        <option value="22">Yaracuy</option>
                                        <option value="23">Zulia</option>

                                    </select>
                                </div>

                                <div class="input-field" id="lista2">
                                    <option  value="<?php echo  $consulta["municipio"] ?>"><?php echo  $consulta["nombre_municipio"]  ?></option>

                                </div>

                                <div class="input-field" id="lista3">
                                    <option value="<?php echo $consulta["parroquia"] ?>"><?php echo  $consulta["nombre_parroquia"]  ?></option>


                                </div>

                                <div class="input-field dos">
                                    <label>Direccion/calle/casa</label>
                                    <input id="direccion" name="direccion" type="text" value="<?php echo $direccion["descripcion"] ?>" placeholder="Ingresa tu direccion"  id="direccion" name="direccion">
                                </div>

                            </div>
                        </div><!-- /* 22/8/2023     */ -->
                        <div class="details personal">
                            <span class="title"></span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Tipo de discapacidad</label>
                                    <select name="discapacidad" id="discapacidad" require>
                                        <option selected value="<?php echo $consulta["id_disca"] ?>"> <?php echo $consulta["nombre_discapacidad"] ?> </option>
                                        <?php
                                        include_once("../php/01-discapacidades.php");
                                        $discapacidad = new Discapacidad(1);

                                        $consulta = $discapacidad->consultarDiscapacidades();

                                        foreach ($consulta as $i) {

                                            echo '<option value=' . $i["id_disca"] . '>' . $i["nombre_discapacidad"] . '</option>';
                                            /*      echo '<option value='.$consulta["parroquia"].'>'. $consulta["nombre_parroquia"] . '</option>'; */
                                        }


                                        ?>
                                    </select>
                                </div>
                                <div class="input-field" id="discapacidadE">
                                    <option selected value="<?php $consulta["id_e"] ?>"> <?php $consulta["nombre_e"] ?> </option>
                                </div>

                                <div class="input-field">
                                    <label>Numero de certificado</label>
                                    <input type="number" placeholder="Ingresa el numero de certificado" id="carnet" name="carnet" value='<?php echo $consulta["certificado"]; ?>'>
                                </div>

                            </div>






                        </div>


                        <?php
                        $cuidador = $aten->detalles_cuidador();

                        if ($cuidador) {  ?>


                            <div class="details personal">
                                <span class="title">¿Posee Cuidador o representante?</span>
                                <div class="fields">



                                    <div class="input-field" >
                                        <label>Nombre del cuidador o representante</label>
                                        <input type="text" placeholder="Ingresa el nombre de cuidador" name="nombre-cuidador" id="cuidador" value="<?php echo $cuidador["nombre"] ?>">

                                    </div>

                                    <div class="input-field">
                                        <label>Cedula del cuidador o representante</label>
                                        <input type="number" placeholder="ingresa cedula cuidador" id="cedula_cui" name="cedula-cuidador" value="<?php echo $cuidador["cedula_r"] ?>">
                                    </div>



                                </div>
                            </div>



                        <?php

                        }
                        ?>

                       
                        <!-- Incluir en la tabla de la base de datos -->
                        <!-- <div class="details personal">
                            <span class="title">Nivel academico </span>
                            <div class="fields">

                                <div class="input-field" id="nombre-cuidador">
                                    <label>Nivel académico</label>
                                    <select name="academico" id="academico">

                                        <option value="S/N" selected>Ninguno</option>
                                        <option value="preescolar">Educación preescolar</option>
                                        <option value="primaria">Educación primaria</option>
                                        <option value="secundaria">Educación secundaria</option>
                                        <option value="media">Técnico Superior</option>
                                        <option value="superior">Educación superior</option>
                                    </select>

                                </div>

                            </div>

                        </div> -->
                     

                        <?php
                        $emprendimiento = $aten->detalles_emprendimiento();

                        if ($emprendimiento) {  ?>


                            <div class="details personal" id="chk-menor2">
                                <span class="title">Datos de emprendimiento</span>
                                <div class="fields">
                                    <div class="input-field">
                                        <label>Nombre emprendimiento</label>
                                        <input type="text" name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["nombre_emprendimiento"] ?>">
                                    </div>
                                    <div class="input-field">
                                        <label>Rif</label>
                                        <input type="number" name="proteccion_social" id="proteccion_social" value="<?php echo $emprendimiento["rif_emprendimiento"] ?>">
                                    </div>

                                    <div class="input-field">
                                        <label>Area comercial</label>
                                        <select name="area-comercial" id="area_comerc">
                                            <option selected value="<?php echo $emprendimiento["area_comercial"] ?>"><?php echo $emprendimiento["area_comercial"] ?></option>
                                            <option value=""></option>
                                            <option value="Textil">Textil</option>
                                            <option value="Alimentos">Alimentos</option>
                                            <option value="Artesanal">Artesanal</option>
                                            <option value="Transporte">Transporte</option>
                                        </select>

                                    </div>


                                    <div class="input-field">
                                        <label>Banco del credito que uso</label>
                                        <input type="email" name="proteccion_social" id="proteccion_social" id="banco" value="<?php echo $emprendimiento["banco"] ?>">
                                    </div>

                                </div>


                            </div>





                        <?php

                        }
                        ?>


                        <div class="details personal">
                            <span class="title"> Protección social</span>
                            <div class="fields">

                                <?php
                                $institucionales = $aten->Detalles_institucionales();

                                if ($institucionales) {  ?>


                                    <div class="input-field">
                                        <label>¿Recibe ud el Bono de José Gregorio Hernández?</label>
                                        <select name="bono" id="bono">
                                            <option selected value="<?php echo $institucionales["proteccion_social"] ?>"><?php echo $institucionales["proteccion_social"] ?></option>
                                            <option value="no">No</option>
                                            <option value="si">Si</option>

                                        </select>
                                    </div>

                                <?php

                                }
                                ?>
                            </div>




                        </div>

                        <button class="nextBtn" name="modificar" id="modificar">
                            <span class="btnText">Modificar</span>
                            <ion-icon name="send-outline"></ion-icon>
                        </button>


                    </div>
                </div>




            </form>


        </div>
        <!--    <div class="graficas">
         <canvas id="chart"></canvas>

        <canvas id="chart2"></canvas>

        <canvas id="chart3"></canvas>
    </div>
 -->
    </div>
</div>

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script>
$(function() {
       
       $("#modificar").click(function(e) {




           var valid = this.form.checkValidity();
           if (valid) {

               var cedulauser = <?php echo json_encode($cedulauser); ?>

               var cedula = $("#cedula").val();
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();
                var email = $("#email").val();
                var telefono = $("#telefono").val();
                var fecha_naci = $("#fecha_naci").val();
                var edad = $("#edad").val();
                var hijos = $("#hijos").val();
                var civil = $("#civil").val();
                var carnet = $("#carnet").val();
                var sexo = $("#sexo").val();
                console.log(sexo);




                /* institucion */
                var institucion = $("#institucion").val();
                var bono = $("#bono").val();



                /* emprendimiento */
                var nombre_empre = $("#nombre_empre").val();
                var rif_emp = $("#rif_emp").val();
                var area_comerc = $("#area_comerc").val();
                var banco = $("#banco").val();



                /* Detalles ubicacion */
                var estado = $("#estado").val();
                var municipio = $("#municipio").val();
                var parroquia = $("#parroquia").val();
                var direccion = $("#direccion").val();

                /* Detalles medicos */
                var discapacidad = $("#D-especifica").val();
                var carnet = $("#carnet").val();
            

                /* Cuidador */
                var cuidador = $("#cuidador").val();
                var cedula_cui = $("#cedula_cui").val();

                /* Detalles academicos */
               

                /* otros */
                var registrador = $("#user_active").text()
                var fecha_registro = $("#fecha_registro").text()

                console.log(cuidador, cedula_cui)

               


               

               /* $("form :input").css("border-color", "#15CD02")
               $("form :select").css("border-color", "#15CD02") */
               e.preventDefault();
            
               Swal.fire({
                   title: '¿Desea registrar a este beneficiario/a? ' + nombre,
                   showDenyButton: true,
                   showCancelButton: true,
                   confirmButtonText: 'Modificar',
                   confirmButtonColor: '#1AA83E',
                   html: 'Antes de <b>Guardar</b>, ' +
                       'Chequea los datos, puedes darle cancelar y verificar. ' +
                       'Si cancelas no se borraran los datos del formulario',
                   denyButtonText: `Don't save`,
               }).then((result) => {
                   /* Read more about isConfirmed, isDenied below */
                   if (result.isConfirmed) {
                       $.ajax({
                           type: "POST",
                           url: "../php/procesamientoModificarBeneficiario.php",
                           data: {
                               cedula: cedula,
                                nombre: nombre,
                               apellido: apellido,
                               email: email,
                               telefono: telefono,
                               fecha_naci: fecha_naci,
                               edad: edad,
                               hijos: hijos,
                               civil: civil,
                               estado: estado,
                               municipio: municipio,
                               parroquia: parroquia,
                               discapacidad: discapacidad,
                               carnet: carnet,
                               registrador: registrador,
                               fecha_registro: fecha_registro,
                               cuidador: cuidador,
                               cedula_cui: cedula_cui,
                               nombre_empre: nombre_empre,
                               rif_emp: rif_emp,
                               area_comerc: area_comerc,
                               banco: banco,
                               bono: bono,
                               institucion: institucion,
                               sexo: sexo
                           },
                           success: function(data) {
                               Swal.fire({
                                   icon: 'success',
                                   title: data
                               }).then(function() {
                                   window.location = "Beneficiarios.php";
                               })

                               if (!data) {
                                   Swal.fire({
                                       icon: 'error',
                                       title: "No se pudo modificar el beneficiario, verifique datos"
                                   }).then(function() {
                                       window.location = "Beneficiarios.php";
                                   })
                               }
                           },
                           error: function(data) {
                               Swal.fire({
                                   'icon': 'error',
                                   'title': 'Oops...',
                                   'text': data
                               })
                           }
                       })

                   } else if (result.isDenied) {
                       Swal.fire('Changes are not saved', '', 'info')
                   }
               })



           }
       })
   })
</script>
<?php
include_once("parteabajo.php");
?>