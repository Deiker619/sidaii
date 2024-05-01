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
            include_once("../php/05-solicitud_encuentro.php");

            /*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

            $numero = $_REQUEST["id"];
            $aten = new solicitud_encuentro(1);

            $aten->setid($numero);
            $registro = $aten->consultarSolicitud();
            ?>

            <header>
                Asignar encuentro a <?php echo $registro["nombre"] ?>
            </header>
            <?php

            if ($registro) {
            ?>
                <form action="09-desarrolloS-participante.php" method="post" class="dos">
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


                                <div class="input-field" id="encuentro">
                                    <label>Encuentro a asignar</label>
                                    <select name="encuentro" id="encuentro">
                                    <?php 
                                        include_once("../php/05-encuentro.php");
                                        $aten = new encuentro (1);
                                        $consulta = $aten->consultarTodosEncuentro();
                                        $cantidadRegistros = count($consulta);
                                        if ($consulta){
                                        foreach($consulta as $registros){       
                                    ?>
                                    <option value=<?php echo $registros["id"]?> style="color: black;">ID: <?php echo $registros["id"]?> | Edo:<?php echo $registros["estado"]?> | Mncp:<?php echo $registros["estado"]?> <br> </option>
                                    <?php 
                                            }
                                    }
                                    ?>
                                 </select>
                                </div>

                    
                               
                                
                                
                               


                            </div>


                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Asignar encuentro</span>
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
                        var encuentro = $("#encuentro").val();
                        var fecha_asig = $("#fecha_asig").val();

                        console.log(cedula, ids)
                        console.log(fecha_asig)


                        e.preventDefault();
                        $.ajax({
                            type: "POST",
                            url: "09-desarrolloS-participante.php",
                            data: {
                                ids: ids,
                                cedula: cedula,
                                encuentro: encuentro,
                                fecha_asig: fecha_asig
                            },
                            success: function(data) {
                                Swal.fire({
                                    'icon': 'success',
                                    'title': 'Asignacion de atencion',
                                    'text': 'Se asigno asistencia correctamente',
                                }).then(function() {
                                    window.location = "09-desarrolloS-encuentros.php";
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
