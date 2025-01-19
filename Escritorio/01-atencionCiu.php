<?php
include_once("partearriba.php");
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Registro de beneficiario: <?php echo $rol ?> </span>
        </div>
    </div>
    <section class="modal">


        <div class="modal__container">
            <div class="modal__header">
                <a href="" class="modal__close">Cerrar</a>
            </div>
            <h4>Resultados de busqueda:</h4>

            <div class="resumen" id="resumen__search" style="margin-top: 0; flex-direction:column; align-items:normal">


            </div>


        </div>

    </section>


    <div class="cont-graficas">

    </div>


    <div class="cont-registro">

        <div class="container">

            <header>
                Registro de personas con discapacidad

            </header>
            <div class="fecha" id="fecha_registro"><?php echo date("Y-m-d") ?>

            </div>
            <div class="opciones_form">
                <div class="ya_registrado"><a href="registrado.php">Ya registrado en SIDDAI!</a></div>
               <!--  <div class="ya_registrado"><a onclick='conapdis()'>Ya registrado en Conapdis</a></div> -->
            </div>



            <form action="" method="post" name="form-bene">
                <div class="form first">
                    <div class="checkbox-menor">
                        <input type="checkbox" id="cbx2" style="display: none;" value="menor">
                        <label for="cbx2" class="check">
                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                <path d="M 1 9 L 1 9 c 0 -5 3 -8 8 -8 L 9 1 C 14 1 17 5 17 9 L 17 9 c 0 4 -4 8 -8 8 L 9 17 C 5 17 1 14 1 9 L 1 9 Z"></path>
                                <polyline points="1 9 7 14 15 4"></polyline>
                            </svg>
                        </label>
                        <span>El beneficiario es un <b>menor</b> no cedulado</span>
                    </div>

                    <div class="details personal">
                        <span class="title">Datos Personales</span>
                        <div class="fields">


                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" placeholder="Ingresa el nombre " required id="nombre" name="nombre">
                            </div>

                            <div class="input-field">
                                <label>Apellido</label>
                                <input type="text" placeholder="Ingresa el nombre " required id="apellido" name="apellido">
                            </div>

                            <div class="input-field">
                                <label>Cedula</label><span style="font-size: 13px; " id="label-chk"> Si es menor sin cedula coloque la cedula del tutor legal con un <b style="color: #38b000">1 o otro numero</b> al final</span>
                                <input type="text" placeholder="Ingrese la cedula sin puntos ni letras" required id="cedula" name="cedula">
                                <span id="cedulaError"></span>
                            </div>
                            <div class="input-field">
                                <label>Nacionalidad</label>
                                <select name="nacionalidad" id="nacionalidad">
                                    <option value="V">Venezolano</option>
                                    <option value="E">Extranjero</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" id="email" name="email">
                            </div>

                            <div class="input-field">
                                <label>Telefono</label>
                                <input type="text" placeholder="Ingresa tu numero de Telefono" required id="telefono" name="telefono">
                            </div>


                            <div class="input-field">
                                <label>Fecha de nacimiento</label>
                                <input type="date" placeholder="Ingresa fecha de nacimiento" required id="fecha_naci" name="fecha_naci">
                            </div>


                            <div class="input-field">
                                <label>Edad</label>
                                <input type="number" readonly placeholder="Ingresa tu edad" required id="edad" name="edad">
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
                                <input type="text" placeholder="Ingresa el numero de hijos" require id="hijos" name="hijos">
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
                                        <option value="0">Seleciona una opcion</option>
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


                                </div>

                                <div class="input-field" id="lista3">


                                </div>

                                <div class="input-field dos">
                                    <label>Direccion/calle/casa</label>
                                    <input type="text" placeholder="Ingresa tu direccion" required id="direccion" name="direccion">
                                </div>

                            </div>
                        </div><!-- /* 22/8/2023     */ -->
                        <div class="details personal">
                            <span class="title"></span>
                            <div class="fields">


                                <div class="input-field">
                                    <label>Tipo de discapacidad</label>
                                    <select name="discapacidad" id="discapacidad" require>

                                        <?php
                                        include_once("../php/01-discapacidades.php");
                                        $discapacidad = new Discapacidad(1);

                                        $consulta = $discapacidad->consultarDiscapacidades();

                                        foreach ($consulta as $i) {
                                            echo '<option value=' . $i["id_disca"] . '>' . $i["nombre_discapacidad"] . '</option>';
                                        }


                                        ?>
                                    </select>
                                </div>
                                <div class="input-field" id="discapacidadE">

                                </div>

                                <div class="input-field">
                                    <label>Numero de certificado</label>
                                    <input type="number" placeholder="Ingresa el numero de certificado" id="carnet" name="carnet">
                                </div>

                                
                                <div class="input-field">
                                    <label>Tipo de atención solicitada</label>
                                    <select name="atencion" id="atencion" require>
                                        <?php if ($gerencia == "4Gtno" || $rol == "Superusuario") { ?>
                                            <option value="0-aten-coo">Atención a traves de coordinacion estadal</option>



                                        <?php } ?>
                                        <?php if ($gerencia == "2Atc" || $rol == "Superusuario") { ?>
                                            <option value="1-oac">Atención a través de OAC</option>



                                        <?php } ?>



                                        <?php if ($gerencia == "5Logi" || $rol == "Superusuario") { ?>
                                            <option value="3-orypro">Cita laboratorio ortesis y protesis</option>
                                            <!-- <option value="4-tomedi">Toma Medidas</option>
                                            <option value="5-pruebar">Prueba artifcio</option> -->
                                            <option value="6-repaart">Reparación Artificio</option>
                                            <option value="7-audiom">Audiometria</option>
                                            <option value="8-rehabilitacion">Rehabilitacion</option>
                                        <?php } ?>

                                        <!--   <option value="8-calibr">Calibracion de Protesis Auditivas</option>
                                          estamos esperando tipos de protesis auditivas para agregar a la base
                                            <option value="9-soliproa">Solicitud de protesis auditivas</option> -->
                                        <?php if ($gerencia == "3Gtnd" || $rol == "Superusuario") { ?>
                                            <option value="10-partic">Participante de taller</option>
                                            <option value="11-partic">Participante de encuentro</option>
                                        <?php } ?>





                                    </select>
                                </div>
                       

                            </div>






                        </div>

                        <fieldset style="border-radius: 10px; border: 1px solid #ddd">
                        <legend style="color: gray;">Datos opcionales</legend>
                        <div class="details personal">
                                <span class="title">¿Posee Cuidador o representante?</span>
                                <div class="fields">


                                    <div class="input-field">
                                        <label>¿Posee cuidador o representante?</label>
                                        <select name="respuesta-cuidador" id="respuesta-cuidador">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>

                                        </select>
                                    </div>

                                    <div class="input-field" id="nombre-cuidador">
                                        <label>Nombre del cuidador o representante</label>
                                        <input type="text" placeholder="Ingresa el nombre de cuidador" name="nombre-cuidador" id="cuidador">

                                    </div>

                                    <div class="input-field" id="cedula-cuidador">
                                        <label>Cedula del cuidador o representante</label>
                                        <input type="text" placeholder="ingresa cedula cuidador" id="cedula_cui" name="cedula-cuidador">
                                    </div>



                                </div>
                            </div>

                            <div class="details personal">
                                <span class="title">Nivel academico </span>
                                <div class="fields">

                                    <div class="input-field" id="nombre-cuidador">
                                        <label>Nivel académico</label>
                                        <select name="academico" id="academico">

                                            <option value="preescolar">Educación preescolar</option>
                                            <option value="primaria">Educación primaria</option>
                                            <option value="secundaria">Educación secundaria</option>
                                            <option value="media">Técnico Superior</option>
                                            <option value="superior">Educación superior</option>
                                            <option value="S/N" selected>Ninguno</option>
                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="details personal" id="chk-menor">
                                <span class="title">Profesión u oficio</span>
                                <div class="fields">

                                    <div class="input-field" id="nombre-cuidador">
                                        <label>Profesión u oficio</label>
                                        <input type="text" placeholder="Ingresa la profesión u oficio" name="profesion" id="profesion">

                                    </div>
                                    <div class="input-field">
                                        <label>¿Labora actualmente</label>
                                        <select name="area-comercial" id="">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>


                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="details personal" id="chk-menor2">
                                <span class="title">¿Posee emprendimiento?</span>
                                <div class="fields">

                                    <div class="input-field">
                                        <label>¿Posee emprendimiento</label>
                                        <select name="empre" id="respuesta-emprendimiento">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>

                                        </select>
                                    </div>
                                    <div class="input-field" id="nombre-emprendimiento">
                                        <label>Nombre del emprendimiento</label>
                                        <input type="text" placeholder="Ingresa el nombre del emprendimiento" id="nombre_empre" name="nombre-emprendimiento">

                                    </div>

                                    <div class="input-field" id="rifff">
                                        <label>¿Posee rif?</label>
                                        <select name="rf" id="respuesta-rif">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>

                                        </select>
                                    </div>

                                    <div class="input-field" id="rif-emprendimiento">
                                        <label>Rif del emprendimiento</label>
                                        <input type="text" placeholder="Ingresa el nombre de cuidador" id="rif_emp" name="rif-emprendimiento">

                                    </div>

                                    <div class="input-field" id="area-comercial">
                                        <label>Area comercial</label>
                                        <select name="area-comercial" id="area_comerc">
                                            <option value="" selected></option>
                                            <option value="Textil">Textil</option>
                                            <option value="Alimentos">Alimentos</option>
                                            <option value="Artesanal">Artesanal</option>
                                            <option value="Transporte">Transporte</option>
                                        </select>

                                    </div>

                                    <div class="input-field" id="credito-bancario">
                                        <label>¿Uso credito bancario?</label>
                                        <select name="respuesta-banco" id="respuesta-banco">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>
                                        </select>
                                    </div>

                                    <div class="input-field" id="nombre-banco">
                                        <label>Nombre del banco</label>
                                        <input type="text" placeholder="Ingresa el nombre de cuidador" id="banco" name="nombre_banco">
                                    </div>




                                </div>
                            </div>

                            <div class="details personal">
                                <span class="title"> Protección social</span>
                                <div class="fields">

                                    <div class="input-field">
                                        <label>¿Recibe ud el Bono de José Gregorio Hernández?</label>
                                        <select name="bono" id="bono">
                                            <option value="no">No</option>
                                            <option value="si">Si</option>

                                        </select>
                                    </div>

                                    <!--<div class="input-field">
                                    <label>¿Posee registro en otra Mision?</label>
                                    <select name="respuesta-institucional" id="respuesta-institucional">
                                        <option value="no">No</option>
                                        <option value="si">Si</option>

                                    </select>
                                </div>

                                <div class="input-field" id="nombre-institucional">
                                    <label>Nombre de la institucion</label>
                                    <input type="text" placeholder="Ingresa el nombre de la institucion" id="institucion" name="nombre-institucional">
                                </div>-->


                                </div>


                            </div>
                        </fieldset>
                        


                            
                        

                        <button class="nextBtn" name="registro" id="registro">
                            <span class="btnText">Registrar</span>
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

<script src="../php/api.js"></script>
<!-- <script src="validacion.js"></script> -->
<script type="text/javascript">
    $(function() {

        $("#registro").click(function(e) {




            var valid = this.form.checkValidity();
            if (valid) {

                var cedulauser = <?php echo json_encode($cedulauser); ?>

                /* Detalles personales */
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
                var atencion = $("#atencion").val();

                /* Cuidador */
                var cuidador = $("#cuidador").val();
                var cedula_cui = $("#cedula_cui").val();

                /* Detalles academicos */
                var academico = $("#academico").val();

                /* Detalles profesionales*/
                var profesion = $("#profesion").val();

                /* otros */
                var registrador = $("#user_active").text()
                var fecha_registro = $("#fecha_registro").text()
                var nacionalidad = $("#nacionalidad").val()
                console.log(cuidador, cedula_cui)

                /*  var nombre = $("#nombre").val(); */
                var regexNombre = /^[a-zA-ZÁáÉéÍíÓóÚúÜüÑñ \s]{2,50}$/;

                if (!regexNombre.test(nombre)) {
                    e.preventDefault(); // Evita que se envíe el formulario si el nombre no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de nombre',
                        text: 'El nombre no es valido.'

                    });
                    $("#nombre").css("border-color", "#EE092A");

                    return; // Sale de la función de manejo del clic si el nombre no es válido
                } else {
                    $("#nombre").css("border-color", "#15CD02");
                }
                if (!regexNombre.test(apellido)) {
                    e.preventDefault(); // Evita que se envíe el formulario si el nombre no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de apellido',
                        text: 'El apellido no es valido.'

                    });
                    $("#apellido").css("border-color", "#EE092A");



                    return; // Sale de la función de manejo del clic si el nombre no es válido
                } else {
                    $("#apellido").css("border-color", "#15CD02");
                }
                /*  var cedula = $("#cedula").val(); */
                if (!/^\d{5,9}$/.test(cedula)) {
                    e.preventDefault(); // Evita que se envíe el formulario si la cédula no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de cédula',
                        text: 'La cédula debe contener entre 5 y 9 dígitos numéricos.'
                    });

                    $("#cedula").css("border-color", "#EE092A");

                    return; // Sale de la función de manejo del clic si la cédula no es válida
                } else {
                    $("#cedula").css("border-color", "#15CD02");
                }

                /* var hijo = $("#hijos").val(); */
                var hijos = $("#hijos").val();

                // Expresión regular que permite solo números enteros no negativos (0 o mayores)
                const regHijos = /^[0-9]+$/;

                // Validar el valor del número de hijos
                if (!regHijos.test(hijos) || hijos === "") {
                    e.preventDefault(); // Evita que se envíe el formulario si la entrada no es válida

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de hijos',
                        text: 'El número de hijos debe ser un número entero mayor o igual a 0.'
                    });

                    $("#hijos").css("border-color", "#EE092A");
                    return; // Sale de la función si el número no es válido
                } else {
                    $("#hijos").css("border-color", "#15CD02");
                }

                /*    var telefono = $("#telefono").val(); */
                var regexTelefono = /^[0-9]{4}[0-9]{7}$/;
                if (!regexTelefono.test(telefono)) {
                    e.preventDefault(); // Evita que se envíe el formulario si el teléfono no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de teléfono',
                        text: 'El número de teléfono no es válido.'
                    });

                    $("#telefono").css("border-color", "#EE092A");
                    return; // Sale de la función de manejo del clic si el teléfono no es válido
                } else {
                    $("#telefono").css("border-color", "#15CD02");

                }




                var edad = $("#edad").val();
                if (/^-\d+(\.\d+)?$/.test(edad) || edad > 122) {
                    e.preventDefault(); // Evita que se envíe el formulario si la cédula no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error en la edad',
                        text: 'No puedes colocar una edad negativa ni una edad superior a 122 años.'
                    });

                    $("#edad").css("border-color", "#EE092A");

                    return; // Sale de la función de manejo del clic si la cédula no es válida
                } else {
                    $("#edad").css("border-color", "#15CD02");
                }





                /* $("form :input").css("border-color", "#15CD02")
                $("form :select").css("border-color", "#15CD02") */
                e.preventDefault();

                Swal.fire({
                    title: '¿Desea registrar a este beneficiario/a? ' + nombre,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Save',
                    confirmButtonColor: '#1AA83E',
                    html: 'Antes de <b>Guardar</b>, ' +
                        'Chequea los datos, puedes darle cancelar y verificar. ' +
                        'Si cancelas no se borraran los datos del formulario',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        asignarAtencion();
                        $.ajax({
                            type: "POST",
                            url: "../php/procesamientodebeneficiario.php",
                            data: {
                                accion: 'si-atencion',
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
                                atencion: atencion,
                                cuidador: cuidador,
                                cedula_cui: cedula_cui,
                                nombre_empre: nombre_empre,
                                rif_emp: rif_emp,
                                area_comerc: area_comerc,
                                banco: banco,
                                bono: bono,
                                institucion: institucion,
                                academico: academico,
                                cedulauser: cedulauser,
                                sexo: sexo,
                                direccion: direccion,
                                nacionalidad: nacionalidad

                            },
                            success: function(data) {
                                console.log(data)
                                Swal.fire({
                                    icon: 'success',
                                    title: data.trim() ?? 'Se registro exitosamente...',
                                    footer: '<a href="__verBeneficiario.php?cedula=' + cedula + '">Ir a cargar copia de cédula</a>'
                                }).then(function() {
                                    /* window.location = "01-atencionCiu.php"; */
                                })

                                if (!data) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "No se pudo registrar el beneficiario, verifique datos"
                                    }).then(function() {
                                        /*   window.location = "01-atencionCiu.php"; */
                                    })
                                }
                            },
                            error: function(data) {
                                console.log(data)
                                Swal.fire({
                                    'icon': 'error',
                                    'title': 'Oops...',
                                    'text': 'Ocurrió un error en el proceso'
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