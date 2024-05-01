<?php
include_once("partearriba.php");
?>

<!--  -->


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Desarrollo social: <?php echo $rol ?></span>
        </div>
    </div>

    <div class="container" style="border-color: #1AA83E; margin-top: 20px">

        <form action="" method="post" class="dos tres">
            <div class="form first">
                <div class="details personal">
                    <span class="title"> Registrar participantes para el curso </span>
                    <div class="fields">

                        <?php
                        include_once("../php/7-escuela-comunitaria.php");
                        $numero = $_REQUEST["id"];
                        $aten = new escuela(1);
                        ?>
                        <div class="input-field" style="display:none;">
                            <label>Numero de curso</label>
                            <input type="text" required name="id_curso" id="id_curso" value="<?php echo $numero ?>">
                        </div>

                        <div class="input-field">
                            <label>Nombre del modulo</label>
                            <input type="text" placeholder="ejem. Modulo I" required name="nombre_modulo" id="nombre_modulo">
                        </div>


                        <div class="input-field">
                            <label>Profesor</label>
                            <input type="text" placeholder="Ingresa el profesor" required name="profesor" id="profesor">
                        </div>


                        <div class="input-field">
                            <label>Fecha</label>
                            <input type="date" placeholder="Ingresa la fecha" required name="fecha" id="fecha">
                        </div>

                        <div class="input-field">
                            <label>Hora</label>
                            <input type="time" placeholder="Ingresa la hora" required name="hora" id="hora">
                        </div>

                        <div class="input-field">
                            <label>Contenido (descripcion)</label>
                            <textarea name="contenido" id="contenido" cols="30" rows="10" placeholder="Separe por coma (,) la linea"></textarea>
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
    <div class="resumen">
                        
            <?php
            
                include_once("../php/modulos.php");
                $mod = new modulo (1);
                $mod->setid_curso($numero);
                $consulta = $mod->consultarModulos();
                $cantidadRegistros = count($consulta);
                if ($consulta){
                foreach($consulta as $registros){       
             
            ?>
        <div class="card">
            <div class="header">
                <div class="image-escuela"><?php 
                ?>
                    
            </div>
                <div class="content">
                    <span class="title"><?php echo $registros["nombre_modulo"] ?></span>
                    <p class="message">Hora: <?php  echo $registros["hora"] ?></p>
                    <p class="message"> Fecha:<?php  echo $registros["fecha"] ?></p>
                    <p class="message">Contenido: <?php  echo $registros["contenido"] ?></p>
                </div>
                <div class="actions">
                    <button class="desactivate" type="button">Profesor: <?php echo $registros["profesor"] ?> </button>
                </div>
            </div>
        </div>

        <?php
                }
            }
            ?>
        

</div>

<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var id_curso = $("#id_curso").val();
                var profesor = $("#profesor").val();
                var contenido = $("#contenido").val();
                var nombre_modulo = $("#nombre_modulo").val();
                var fecha = $("#fecha").val();
                var hora = $("#hora").val();

                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "12-D-regModulos.php",

                    data: {
                        id_curso: id_curso,
                        profesor: profesor,
                        contenido: contenido,
                        nombre_modulo: nombre_modulo,
                        fecha: fecha,
                        hora: hora

                    },

                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': data,

                        }).then(function() {
                            window.location = "12-D-Modulos.php?id=<?php echo $numero ?>";
                            /*  $("#cedula").attr("readonly","readonly");
                             $("#nombre").attr("readonly","readonly");
                             $("#apellido").attr("readonly","readonly");
                             $("#numero_jornada").attr("readonly","readonly");
                             $("#discapacidad").attr("readonly","readonly");
                             $("#tipo_ayuda_tec").attr("readonly","readonly");
                             */

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