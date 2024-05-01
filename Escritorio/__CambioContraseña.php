<?php
include_once("partearriba.php");
include_once("../php/03-usuario.php");
$cedula = json_encode($_SESSION["cedula"]);
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Cambio de contraseña: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="cont-registro">
        <div class="container">

            <header>
                Cambio de contraseña
            </header>

            <form action="" method="post">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Cambiar la contraseña</span>
                        <div class="fields">



                            <div class="input-field">
                                <label>Contraseña actual</label>
                                <input type="" placeholder="ingresa contraseña" required name="contraseñaActual" id="contraseñaActual">
                            </div>




                        </div>
                        <div class="fields">



                            <div class="input-field">
                                <label>Nueva contraseña</label>
                                <input type="" placeholder="ingresa contraseña" required name="contraseñaNueva" id="contraseñaActual">
                            </div>
                            <div class="input-field">
                                <label>Repite la nueva contraseña</label>
                                <input type="" placeholder="ingresa contraseña" onkeyup="validarContrasena()" required name="contraseñaRepetida" id="contraseñaActual">
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
<?php
include_once("parteabajo.php");
?>

<script>
    function validarContrasena() {
        // Obtener los valores de los campos de contraseña
        var contraseñaNueva = $('input[name="contraseñaNueva"]').val();
        var contraseñaRepetida = $('input[name="contraseñaRepetida"]').val();

        // Validar si las contraseñas coinciden
        if (contraseñaNueva != contraseñaRepetida) {
            // Mostrar mensaje de error y cambiar el borde de los campos

            $('input[name="contraseñaNueva"]').css("border-color", "#EE092A");
            $('input[name="contraseñaRepetida"]').css("border-color", "#EE092A");

        } else {
            // Las contraseñas coinciden, cambiar el borde de los campos
            $('input[name="contraseñaNueva"]').css("border-color", "#15CD02");
            $('input[name="contraseñaRepetida"]').css("border-color", "#15CD02");
        }
    }
    $("#registro").click(function(e) {
        var valid = this.form.checkValidity();
        if (valid) {
            e.preventDefault();

            var contraseñaActual = $('input[name="contraseñaActual"]').val();
            var contraseñaNueva = $('input[name="contraseñaNueva"]').val();
            var contraseñaRepetida = $('input[name="contraseñaRepetida"]').val();
            var cedula = <?php echo $cedula ?> 

            if (contraseñaNueva != contraseñaRepetida) {
                // Mostrar mensaje de error y cambiar el borde de los campos
                Swal.fire({
                    'icon': 'error',
                    'title': 'Las contraseñas no coinciden',
                    'text': 'La contraseña nueva debe coincidir con la repetida',
                    'confirmButton': 'btn btn-success'
                }).then(function() {
                    $('input[name="contraseñaNueva"]').css("border-color", "#EE092A");
                    $('input[name="contraseñaRepetida"]').css("border-color", "#EE092A");
                });
                return;
            } else {
                // Las contraseñas coinciden, cambiar el borde de los campos
                $('input[name="contraseñaNueva"]').css("border-color", "#15CD02");
                $('input[name="contraseñaRepetida"]').css("border-color", "#15CD02");
            }


            console.log("Enviando..")
            $.ajax({
                type: "POST",
                url: "../php/procesamientoCambioContraseña.php",

                data: {
                    contraseñaActual,
                    contraseñaNueva,
                    contraseñaRepetida,
                    cedula
                },

                success: function(data) {
                    console.log(data.trim())
                    if (data.trim() == "1") {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Modificación exitosa',
                            'text': "Se ha modificado correctamente la contraseña",

                        }).then(function() {

                        })
                    } else if (data.trim() == "2") {
                        Swal.fire({
                            'icon': 'error',
                            'title': 'Operación fallida',
                            'text': "No se pudo modificar la contraseña, no coinciden los valores de la contraseña actual con la guardada en la base de datos",

                        }).then(function() {
                            
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
</script>