<?php
include_once("partearriba.php");
?>

<!-- contenido -->

<?php
/* session_start(); */
include_once("../php/01-04-pruebaArtificio.php");

/*  if (isset($_SESSION['cedula'])){  // Si el usuario inicio sesion correctamente
                 $cedulauser = $_SESSION['cedula']; 
                 $NombreUsuarioActivo = $_SESSION['nombre'];
             } */

$numero = $_REQUEST["id"];
$aten = new prueba_artificio(1);

$aten->setid($numero);
$registro = $aten->consultarPruebas();
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

            <header>
                Reasignar prueba a <?php echo $registro["nombre"] ?>
            </header>

            <?php

            if ($registro) {
            ?>
                <form action="" method="post">
                    <div class="form first">
                        <div class="details personal">
                            <span class="title">Detalles Personales</span>
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
                                    <label>Codigo de cita</label>
                                    <input type="number" required readonly name="ide" id="ide" value="<?php echo $registro["id"] ?>">
                                </div>

                                <div class="input-field">
                                    <label> fecha de prueba actual</label>
                                    <input type="text" readonly required name="fecha" id="fecha" value="<?php echo $registro["fecha_pruebas"] ?>">
                                </div>

                                <div class="input-field">
                                    <label>Nueva fecha de prueba</label>
                                    <input type="date" required name="fecha_pruebas" id="fecha_pruebas">
                                </div>

                                <div class="input-field">
                                    <label>Probar:</label>
                                    <input type="text" placeholder="" required readonly name="artificio" id="artificio" value="<?php echo $registro["artificio_prueba"] ?>">
                                </div>



                            </div>



                            <button class="nextBtn" name="registro" id="registro">
                                <span class="btnText">Reasignar</span>
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
</div>



<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var ide = $("#ide").val();
                var statu = "Reasignado";
                var fecha_pruebas = $("#fecha_pruebas").val();

                console.log(ide)
                console.log(fecha_pruebas)
                console.log(statu)

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "05-reasignacion.php",
                    data: {
                        ide: ide,
                        statu: statu, 
                        fecha_pruebas: fecha_pruebas

                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': 'Se reasigno correctamente',
                        }).then(function() {
                            window.location = "05-pruebaArtificio.php";
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