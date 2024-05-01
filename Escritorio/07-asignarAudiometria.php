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
         include_once("../php/01-06-audiometria.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

             $numero = $_REQUEST["id"];
             $aten = new audiometria(1);

             $aten->setid($numero);
             $registro = $aten->consultarCita();
        ?>

            <header>
                Asignar cita a <?php echo $registro["nombre"] ?>
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
                                <input type="text"  required readonly name="cedula" id="cedula" value="<?php echo $registro["cedula"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Nombre</label>
                                <input type="text" required readonly name="nombre" id="nombre" value="<?php echo $registro["nombre"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Apellido</label>
                                <input type="text" required readonly name="apellido" id="apellido"  value="<?php echo $registro["apellido"]?>" >
                            </div>


                            <div class="input-field">
                                <label>Discapacidad</label>
                                <input type="email" placeholder="Ingresa tu correo electronico" required readonly name="discapacidad" id="discapacidad"  value="<?php echo $registro["discapacidad"]?>" >
                            </div>

                            <!-- <div class="input-field">
                                <label>Numero Atencion</label>
                                <input type="number"  required readonly name="numero_aten" id="numero_aten" value="<?php echo $registro["numero_aten"]?>" >
                            </div> -->

                            <div class="input-field">
                                <label>Atencion Solicitada</label>
                                <input type="text"  required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["atencion_solicitada"]?>" >
                            </div>

                            <div class="input-field">
                                <label>Codigo de cita</label>
                                <input type="text"  required readonly name="id" id="id" value="<?php echo $registro["id"]?>" >
                            </div>


<!-- 
                            <div class="input-field">
                                <label>fecha de entrega</label>
                                <input type="text" placeholder="Ingresa el codigo de carnet" required readonly name="fecha_aten" id="fecha_aten" value="<?php echo date("Y-m-d")?>" >
                            </div>
 -->

                            <div class="input-field">
                                    <label>Laboratorio para la cita:</label>
                                    <input type="text"  required readonly name="fecha_cita" id="fecha_cita" value="<?php echo date("Y-m-d")?>" >
                                  <!--   <select name="laboratorio" id="laboratorio" require>
                                        <option value="ortesis2">Laboratorio ortesis</option>
                                        <option value="protesis1">Laboratorio Protesis</option>
                                    </select> -->
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
        <script src="../package/dist/sweetalert2.all.js"></script>
        <script src="../package/dist/sweetalert2.all.min.js"></script>

        <script type="text/javascript">

            $(function(){
                $("#registro").click(function(e){
                    var valid = this.form.checkValidity();
                    if(valid){
                        var fecha_cita = $("#fecha_cita").val();
                        var id = $("#id").val();

                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "07-asignadaAudiometria.php",
                            data: { id: id,  fecha_cita: fecha_cita},
                            success: function(data){
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se asigno asistencia correctamente',
                                'confirmButton': 'btn btn-success'
                                }).then(function(){
                                    window.location = "07-audiometria.php";
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