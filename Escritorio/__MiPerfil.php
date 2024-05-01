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
                <?php if ($_SESSION["profile_photo"]) { ?>
                    <button class="buttons" type="button" onclick="eliminar('<?php echo $_SESSION['profile_photo']; ?>')">
                        <span class="buttons__text" style="transform: translateX(9px);">Eliminar foto</span>
                        <span class="buttons__icon">
                            <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                <title></title>
                                <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                                <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path>
                                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                                <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
                            </svg>
                        </span>
                    </button>
                <?php } ?>
            </header>

            <div class="header-beneficiario">
                <div class="profile_beneficiario dos">
                    <div class="foto-beneficiario">
                        <?php
                        if ($_SESSION["profile_photo"]) {
                            $ruta = "fotos_perfil/" . $_SESSION["profile_photo"];
                        } else {
                            $ruta = "profile.png";
                        }

                        ?>
                        <img class="dos" src="<?php echo $ruta ?>" alt="" srcset="">
                    </div>



                </div>






                <!--  <div class="profile_beneficiario dos">
                    <form action="documentos/cedula_beneficiarios/cargarFoto.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="foto_perfil" accept="image/*" required>
                        <button type="submit">Subir foto</button>
                        <button type="submit">Eliminar foto</button>
                    </form>

                </div> -->


            </div>

            <?php if (!$_SESSION["profile_photo"]) { ?>
                    
              
            <form action="fotos_perfil/cargarFoto.php" method="post" enctype="multipart/form-data">
                <div class="form first">
                    <div class="details personal">
                        <span class="title">Foto de perfil</span>
                        <div class="fields">





                            <input type="file" name="foto_perfil" accept="image/*" required>


                            <form>


                            </form>




                        </div>


                    </div>

                    <button class="nextBtn" name="registro" id="registro" type="submit">

                        <span class="btnText">Registrar</span>
                        <ion-icon name="send-outline"></ion-icon>
                    </button>



                </div>





            </form>
            <?php } ?>
        </div>

    </div>
</div>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<?php
include_once("parteabajo.php");
?>

<script>
    function eliminar(p1) {
        console.log(p1);
        eliminar = p1


        $.ajax({
            type: "POST",
            url: "fotos_perfil/cargarFoto.php",
            data: {
                eliminar: eliminar


            },
            success: function(data) {
                window.location = "__MiPerfil.php";
            },
            error: function(data) {
                console.log(data)
            }
        })
    }
</script>