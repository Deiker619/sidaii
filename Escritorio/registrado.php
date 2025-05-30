<?php
include_once("partearriba.php");
?>
<!-- Se puede pegar contenido php y html -->
<div class="dash-contenido">

    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Registro simple: </span>
        </div>
    </div>

    <div class="cont-registro">

        <div class="container tres">


            <header>
                Registra una nueva solicitud de un beneficiario del sistema
            </header>
            <div class="fecha" id="fecha_registro"><?php echo date("Y-m-d") ?> </div>



            <form action="" method="post" class="dos" >
                <div class="form first">

                    <div class="details personal">
                        <span class="title">Registro para persona existente en el sistema</span>
                        <div class="fields">





                            <div class="input-field dos">
                                <label>Cedula:</label>
                                <input type="text" id="cedula" name="cedula">
                            </div>

                            <div class="input-field">
                                <label>Tipo de atencion solicitada</label>
                                <select name="atencion" id="atencion" require>
                                    <?php if ($gerencia == "4Gtno" || $rol == "Superusuario") { ?>
                                        <option value="0-aten-coo">Atencion a traves de coordinacion estadal</option>
                               
                                    
                                        
                                    <?php } ?>
                                    <?php if ($gerencia == "2Atc"||$rol == "Superusuario") { ?>
                                       
                                        <option value="1-oac">Atencion a traves de OAC</option>
                                    
                                        
                                    <?php } ?>

                                   
                                    <?php if ($gerencia == "5Logi" || $rol == "Superusuario") { ?>
                                        <option value="3-orypro">Ortesis y protesis</option>
                                        <!-- <option value="4-tomedi">Toma Medidas</option>
                                        <option value="5-pruebar">Prueba artifcio</option> -->
                                        <option value="6-repaart">Reparación Artificio</option>
                                        <option value="7-audiom">Audiometria</option>
                                        <option value="8-rehabilitacion">Rehabilitación</option>
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




                </div>

                <button class="nextBtn" id="registrado" name="registrado">
                    <span class="btnText">Registrar</span>
                    <ion-icon name="send-outline"></ion-icon>
                </button>
            </form>


        </div>
    </div>


    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>

    
    <script type="text/javascript">
        $(function() {

            $("#registrado").click(function(e) {

                var valid = this.form.checkValidity();
                if (valid) {

                    /* Detalles personales */
                    e.preventDefault()
                    var cedula = $("#cedula").val();
                    var atencion = $("#atencion").val();

                    /* otros */
                    var registrador = $("#user_active").text()
                    var fecha_registro = $("#fecha_registro").text()
                    var registrado = $("#registrado").attr("name");
                    var cedulauser = <?php echo json_encode($cedulauser); ?>;
                   e.preventDefault()

                   asignarAtencion();
                    $.ajax({
                        type: "POST",
                        url: "../php/procesamientodebeneficiario.php",
                        data: {
                            accion:'si-atencion',
                            cedula: cedula,
                            registrador: registrador,
                            fecha_registro: fecha_registro,
                            atencion: atencion, 
                            registrado: registrado, 
                            cedulauser: cedulauser

                            
                        },
                        success: function(data) {
                            if(data){
                            
                            
                            console.log(data)
                            let html, audiometria, ortesis, protesis;
                            
                            if(data.others){
                                 html = `Este beneficiario solicitó <b>${data.others.atencion_solicitada}</b>
                                 el dia <b>${data.others.fecha_creada}</b>, evalue si no ha pasado el tiempo para otorgar de nuevo una ayuda `
                            }else{
                                 html = ''
                            }
                            Swal.fire({
                                icon: 'success',
                                title: data.message??'Registro exitoso',
                                html: html??audiometria??ortesis??protesis
                            }).then(function() {
                                window.location = "01-atencionCiu.php";
                            })}

                            if(data==false){
                                Swal.fire({
                                 icon: 'error',
                                title: "El beneficiario no existe en siddai"
                            }).then(function() {
                                window.location = "01-atencionCiu.php";
                            })
                            }

                        },
                        error: function(data) {
                            console.log(data)
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
    