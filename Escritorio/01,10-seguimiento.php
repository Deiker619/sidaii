<?php
include_once("partearriba.php");
?>




<!-- contenedor -->

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"> Seguimiento: <?php echo $rol ?> </span>
        </div>
    </div>
    <section class="modal">


        <div class="modal__container">
            <div class="modal__header">
                <a href="" class="modal__close">Cerrar</a>
            </div>
            <h4>Resultados de busqueda:</h4>

            <div class="resumen" id="resumen__search" style="margin-top: 0; flex-direction:column; align-items:normal">


            </div>


        </div>

    </section>


    <div class="cont-registro">
        <?php
        /* session_start(); */
        include_once("../php/01-atenciones.php");


        $numero = $_REQUEST["numero_aten"];
        $aten =  new Atenciones(1);

        $aten->setnumero_aten($numero);
        $registro = $aten->consultarAtenciones();

        $cedula = $registro["cedula"];
        json_encode($cedula);
        ?>

        <div class="container dos">

            <header>
                Dar nuevo seguimiento a <?php echo $registro["nombre"] . " " . $registro["apellido"] . " " . "(" . $registro["cedula"] . ")"; ?>
            </header>

            <form action="" method="post" class="dos">
                <div class="form first">

                    <div class="details personal">
                        <span class="title">Detalles del seguimiento</span>
                        <div class="fields">





                            <div class="input-field dos">
                                <label>fecha de seguimiento</label>
                                <input type="date" readonly placeholder="numero de personas a atender" required name="fecha" id="fecha" value="<?php echo date("Y-m-d") ?>">
                            </div>


                            <div class="input-field" style="width: calc(100%/2 - 10px); /* !!!!!!!!!!!! */">
                                <label>Descripción</label>
                                <input type="text" placeholder="Ingresa una pequeña descripcion del seguimiento" required name="descripcion" id="descripcion">
                            </div>

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



    <div class="tabla-atencion">
        
        <h2>Seguimientos de <?php echo $registro["nombre"] ?></h2>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Descripcion del seguimiento</th>

                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/08-seguimiento.php");
                $aten = new seguimiento(1);
                $aten->setcedula($cedula);
                $consulta = $aten->consultarseguimiento();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["fecha_seguimiento"]; ?></td>
                            <td><?php echo $registros["descripcion"]; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>


</div>




<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {
                var cedula = <?php echo $cedula; ?>;
                var descripcion = $("#descripcion").val();
                var fecha = $("#fecha").val();



                e.preventDefault();
                $.ajax({
                    type: "POST",
                    url: "01,10-seguimientoRegistrar.php",
                    data: {
                        cedula: cedula,
                        descripcion: descripcion,
                        fecha: fecha


                    },
                    success: function(data) {
                        Swal.fire({
                            'icon': 'success',
                            'title': 'Asignacion de atencion',
                            'text': 'Se le dio seguimiento exitosamente',
                            'confirmButton': 'btn btn-success'
                        }).then(function() {
                            window.location = "01,2-atenciones.php";
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