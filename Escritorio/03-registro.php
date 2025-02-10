<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Registrar usuario: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="cont-registro">
        <div class="container">

            <header>
                Registro de nuevo usuario
            </header>

            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Datos personales</span>
                        <div class="fields">


                            <div class="input-field">
                                <label>Nombre completo</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="nombre" id="nombrez">
                            </div>


                            <div class="input-field">
                                <label>Email</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" required name="email" id="emaile">
                            </div>

                            <div class="input-field">
                                <label>Telefono</label>
                                <input type="number" placeholder="Ingresa tu numero de Telefono" name="telefono" id="telefone">
                            </div>

                            <div class="input-field">
                                <label>Cedula</label>
                                <input type="number" placeholder="Ingresa tu Cedula sin puntos ni letras" required name="cedula" require id="cedule" pattern="^\d{5,8}$">
                            </div>

                            <div class="input-field">
                                <label>Password</label>
                                <input type="password" placeholder="ingresa contraseña" required name="contraseña" id="contraseña">
                            </div>



                            <div class="input-field">
                                <label>Sexo</label>
                                <select name="sexo" require id="sexos">
                                    <option value="m">Masculino</option>
                                    <option value="f">Femenino</option>
                                </select>
                            </div>
                            <div class="input-field">
                                <label>Institución a la que pertenece</label>
                                <select name="sexo" require id="institucion">
                                    <option value="fmjgh">Fundación Jose Gregorio Hernandez</option>
                                    <option value="conapdis">Conapdis</option>
                                </select>
                            </div>



                        </div>

                        <div class="details personal">
                            <span class="title"> Gerencia:</span>
                            <div class="fields">

                                <div class="input-field">
                                    <label>Gerencia</label>
                                    <select name="gerencia" id="gerencia" require>
                                        <?php if ($gerencia == "2Atc" || $rol == "Superusuario") { ?>
                                            <option value="2Atc">Atencion Ciudadano (OAC)</option>
                                        <?php } ?>
                                        <?php if ($gerencia == "3Gtnd" || $rol == "Superusuario") { ?>
                                            <option value="3Gtnd">Gestion y desarrollo social</option>
                                        <?php } ?>
                                        <?php if ($gerencia == "4Gtno" || $rol == "Superusuario") { ?>
                                            <option value="4Gtno">Gestion operativa estadal</option>
                                        <?php } ?>
                                        <?php if ($gerencia == "5Logi" || $rol == "Superusuario") { ?>
                                            <option value="5Logi">Gestion logistica y infrastructura</option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="input-field" id="coordinacion_div">
                                    <label>Coordinacion estadal</label>
                                    <select name="coordinacion" id="coordinacion">
                                        <option value="" selected></option>
                                        <?php include_once("../php/10-coordinaciones-estadales.php");
                                        $dis = new Coordinacion(1);

                                        $consulta = $dis->consultarCoordinaciones();

                                        foreach ($consulta as $registros) {
                                        ?>
                                            <option value="<?php echo $registros["id"] ?>"><?php echo $registros["nombre_coordinacion"] ?></option>

                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="input-field">
                                    <label>Rol</label>
                                    <select name="rol" require id="rol">

                                        <?php if ($gerencia == "4Gtno" ) { ?>
                                            <option value="2coor">Coordinador estadal</option>
                                            <option value="4nali">Promotor</option>
                                        <?php } ?>
                                        <?php if ($gerencia == "2Atc") { ?>
                                            <option value="2coor">Coordinador estadal</option>
                                            <option value="4nali">Analista</option>
                                        <?php } ?>
                                        <?php if ($rol == "Superusuario") { ?>
                                            <option value="2coor">Coordinador estadal</option>
                                            <option value="1adm">Administrador</option>
                                            <option value="4nali">Analista</option>
                                            <option value="3supe">Superadministrador</option>
                                         <!--    <option value="coorA">Coordinador area </option> -->
                                        <?php } ?>
                                       


                                        


                                    </select>
                                </div>


                                <!-- <div class="input-field"> 
                                <label>Codigo Carnet</label>
                                <input type="text" placeholder="Ingresa tu nombre" required name="discapacidad"> -->
                            </div>

                        </div>
                    </div>

                    <button class="nextBtn" name="registro" id="registro">
                        <span class="btnText">Registrar</span>
                        <ion-icon name="send-outline"></ion-icon>
                    </button>


                </div>
        </div>




        </form>
    </div>

</div>


<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {

        $(document).ready(function() {
            $("#coordinacion_div").hide();
            mostrarCoordinacion();


            $("#gerencia").change(function() {
                mostrarCoordinacion();


            });

            $("#coordinacion").change(function() {

            });



            function mostrarCoordinacion() {
                if ($("#gerencia").val() == "4Gtno") {
                    $("#coordinacion_div").show();

                } else {
                    $("#coordinacion_div").hide();
                }
            }

        })

        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                e.preventDefault();
                var nombrez = $("#nombrez").val();
                var cedule = $("#cedule").val();
                var emaile = $("#emaile").val();
                var telefone = $("#telefone").val();
                var contraseña = $("#contraseña").val();
                var sexos = $("#sexos").val();
                var gerencia = $("#gerencia").val();
                var rol = $("#rol").val();
                var institucion = $("#institucion").val();

                var coordinacion = $("#coordinacion").val();

                if (coordinacion == "") {
                    var coordinacion = null;
                    console.log(coordinacion)
                }

                console.log(nombrez, cedule, emaile, telefone, coordinacion, rol, institucion)





                //Javascript de parametros de la cedula
                var cedula = $("#cedule").val();
                if (!/^\d{5,8}$/.test(cedula)) {
                    e.preventDefault(); // Evita que se envíe el formulario si la cédula no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de cédula',
                        text: 'La cédula debe contener entre 5 y 8 dígitos numéricos.'
                    });

                    return; // Sale de la función de manejo del clic si la cédula no es válida
                }





                //Jacascript de parametros de nombre

                var nombre = $("#nombrez").val();
                var regexNombre = /^[a-zA-Z\s]{2,50}$/;

                if (!regexNombre.test(nombre)) {
                    e.preventDefault(); // Evita que se envíe el formulario si el nombre no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de nombre',
                        text: 'El nombre no es valido.'
                    });

                    return; // Sale de la función de manejo del clic si el nombre no es válido
                }


                //Jacascript de parametros de telefono

                var telefono = $("#telefone").val();
                var regexTelefono = /^[0-9]{4}[0-9]{7}$/;

                if (!regexTelefono.test(telefono)) {
                    e.preventDefault(); // Evita que se envíe el formulario si el teléfono no cumple con el patrón

                    // Muestra el SweetAlert con el mensaje de error
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de teléfono',
                        text: 'El número de teléfono no es válido.'
                    });

                    return; // Sale de la función de manejo del clic si el teléfono no es válido
                }




                 asignarAtencion();
                $.ajax({
                    type: "POST",
                    url: "../php/procesamientoregistro.php",

                    data: {
                        nombrez: nombrez,
                        cedule: cedule,
                        emaile: emaile,
                        telefone: telefone,
                        contraseña: contraseña,
                        sexos: sexos,
                        gerencia: gerencia,
                        coordinacion: coordinacion,
                        rol: rol,
                        institucion: institucion
                    },

                    success: function(data) {
                        console.log(data.trim())
                        if (data.trim() == "exitoso") {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Usuario creado',
                                'text': "Registro exitoso",

                            }).then(function() {
                                window.location = "03-registro.php";
                                

                            })
                        } else if (data.trim() == "error") {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Operación fallida',
                                'text': "No se pudo registrar, intente mas tarde",

                            }).then(function() {
                                window.location = "03-registro.php";
                                

                            })
                        } else if (data.trim() == "existe") {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Operación fallida',
                                'text': "Este usuario ya existe dentro del sistema",

                            }).then(function() {
                                window.location = "03-registro.php";
                                

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



            }
        })
    })
</script>
<?php
include_once("parteabajo.php");
?>