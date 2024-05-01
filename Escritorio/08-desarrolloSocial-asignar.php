<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Desarrollo Social: <?php echo $rol ?></span>
        </div>
    </div>


    <div class="cont-registro">

        <div class="container">

            <?php
            /* session_start(); */
            include_once("../php/04-solicitud_desarrollo.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new solicitud_desarrollo(1);

            $aten->setid($numero);
            $registro = $aten->consultarSolicitud();
            ?>

            <header>
                Asignar taller a <?php echo $registro["nombre"] ?>
            </header>
            <?php

            if ($registro) {
            ?>
                <form action="" method="post" class="dos">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
                            <div class="fields">

                            <div class="input-field">
                                    <label>ID:</label>
                                    <input type="text" required readonly name="ids" id="ids" value="<?php echo $numero?>">
                                </div>

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
                                    <label>Estado</label>
                                    <input type="text" required readonly name="estado" id="estado" value="<?php echo $registro["estado"] ?>">
                                </div>


                                <div class="input-field">
                                    <label>Atencion Solicitada</label>
                                    <input type="text" required readonly name="atencion_solicitada" id="atencion_solicitada" value="<?php echo $registro["solicitud"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Fecha asignacion</label>
                                    <input type="text" required readonly name="fecha_asig" id="fecha_asig" value="<?php echo date("Y-m-d") ?>">
                                </div>

        

                                <div class="input-field" id="talleres">
                                    <label>Taller a asignar</label>
                                    <select name="taller" id="taller">
                                    <?php 
                                        include_once("../php/04-taller.php");
                                        $aten = new taller (1);
                                        $consulta = $aten->consultarTodosTaller();
                                        $cantidadRegistros = count($consulta);
                                        if ($consulta){
                                        foreach($consulta as $registros){       
                                    ?>
                                    <option value=<?php echo $registros["id"]?> style="color: black;">ID: <?php echo $registros["id"]?> | Edo:<?php echo $registros["nombre_estado"]?> | Mncp:<?php echo $registros["nombre"]?> <br> </option>
                                    <?php 
                                            }
                                    }
                                    ?>
                                 </select>
                                </div>

                    
                               
                                
                                
                               


                            </div>


                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Asignar taller</span>
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
            $(function() {
                $("#registro").click(function(e) {
                    var valid = this.form.checkValidity();
                    if (valid) {

                        var ids = $("#ids").val();
                        var cedula = $("#cedula").val();
                        var taller = $("#taller").val();
                        var fecha_asig = $("#fecha_asig").val();

                        console.log(cedula, ids)
                        console.log(fecha_asig)


                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "08-desarrolloSocial-participante.php",
                            data: {
                                ids: ids,
                                cedula: cedula,
                                taller: taller,
                                fecha_asig: fecha_asig
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se asigno asistencia correctamente',
                                }).then(function() {
                                    window.location = "08-desarrolloSocial-solicitudes.php";
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


<?php
include_once("parteabajo.php");
?>
