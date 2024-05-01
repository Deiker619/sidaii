<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

        <?php
         /* session_start(); */
         include_once("../php/01-01-ayudas_tec.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

             $numero = $_REQUEST["id"];
             $aten =  new Ayudas_tec(1);

             $aten->setid($numero);
             $registro = $aten->consultarAyudas_tec();
        ?>

            <header>
                Dar ayuda tecnica a beneficiario 
            </header>
            <?php
                
                if($registro){
                ?>
            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Detalles Personales</span>
                        <div class="fields">


                            <div class="input-field">
                                <label>Cedula</label>
                                <input type="number" placeholder="Ingresa el nombre " required readonly name="cedula" id="cedula" value="<?php echo $registro["cedula"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="nombre" id="nombre" value="<?php echo $registro["nombre"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Apellido</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="apellido" id="apellido"  value="<?php echo $registro["apellido"]?>" >
                            </div>

                            <div class="input-field">
                                <label>estado</label>
                                <input type="text" placeholder="Ingresa el nombre " required readonly name="estado" id="estado" value="<?php echo $registro["nombre_estado"]?>" >
                            </div>

                        <!--     <div class="input-field">
                                <label>Numero de atencion</label>
                                <input type="text" placeholder="Ingresa tu Cedula" required readonly name="numero_aten" id="numero_aten"  value="<?php echo $registro["numero_aten"]?>" >
                            </div> -->


                            <div class="input-field">
                                <label>Discapacidad</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value="<?php echo $registro["nombre_discapacidad"]?>" >
                            </div>

                            <div class="input-field">
                                <label>id de atencion</label>
                                <input type="number"  required readonly name="id" id="id" value="<?php echo $registro["id"]?>" >
                            </div>

                           <!--  <div class="input-field">
                                <label>fecha de la atencion asignada</label>
                                <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo $registro["fecha_aten"]?>" >
                            </div> -->


                            <div class="input-field">
                                    <label>Ayuda tecnica a entregar:</label>
                                    <select name="tipo_ayuda_tec" id="tipo_ayuda_tec"require>
                                    <option value="1-silla.r">Silla de ruedas estandar</option>
                                        <option value="1.1-S.E16">Silla de rueda ergonomica N16</option>
                                        <option value="1.2-S.E14">Silla de rueda ergonomica N14</option>
                                        <option value="1.3-S.E18">Silla de rueda ergonomica N18</option>
                                        <option value="1.4-S.R.A.">Silla de rueda reclinable adulto</option>
                                        <option value="1.5-SRPE">Silla de rueda pediatrica hergonomica</option>
                                        <option value="2-muletas">Muletas</option>
                                        <option value="3-baston">Baston de apoyo</option>
                                        <option value="4-baston.p">Baston de 4 puntas</option>
                                        <option value="5-ap.audio">Aparato de audiometria</option>
                                        <option value="6-andadera">Andadera</option>
                                        <option value="7-CamaCli">Cama Clinica</option>
                                        <option value="8-Col-Anti">Colchon Antiescara</option>
                                        <option value="9-felula">Felula</option>
                                        <option value="10-lentes">Lentes</option>
                                        <option value="11-pañales">Pañales</option>
                                        <option value="12-Pro-aud">Protesis auditivas</option>
                                        <option value="13-Pro-cad">Protesis de Cadera</option>
                                        <option value="14-Pro-rod">Protesis de rodilla</option>
                                        <option value="15-Pro-den">Protesis Dental</option>
                                        
                                    </select>
                                </div>


                        </div>



                        <button class="nextBtn" name="registro" id="registro">
                            <span class="btnText">Dar ayuda tecnica</span>
                            <ion-icon name="send-outline"></ion-icon>
                        </button>


                    </div>
                </div>


                <?php
                
                }
                ?>

            </form>


        </div>
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">

            $(function(){
                $("#registro").click(function(e){
                    var valid = this.form.checkValidity();
                    if(valid){
                        var nombre = $("#nombre").val();
                        var apellido = $("#apellido").val();
                        var estado = $("#estado").val();
                        var numero_aten = $("#numero_aten").val();
                        var discapacidad = $("#discapacidad").val();
                        var id = $("#id").val();
                        var fecha_aten = $("#fecha_aten").val();
                        var tipo_ayuda_tec = $("#tipo_ayuda_tec").val();

                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "01,8-ayudasTecAsignada.php",
                            data: {nombre: nombre, apellido: apellido, estado: estado,numero_aten: numero_aten, discapacidad: discapacidad, id: id, fecha_aten: fecha_aten, tipo_ayuda_tec: tipo_ayuda_tec },
                            success: function(data){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se le dio a ' + nombre +' una' + tipo_ayuda_tec +' exitosamente' ,
                                'confirmButton': 'btn btn-success'
                                }).then(function(){
                                    window.location = "01,6-ayudasTecnicas.php";
                                })
                            },
                            error: function(data){
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