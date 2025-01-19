<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="stylesprotesis.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php
include_once("../php/01-02-cita_protesis.php");
$aten = new citas_protesis(1);
$id = $_REQUEST["id"];

$registro = $aten->verAtencionLaboratorio($id);

?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ver registro</span>
        </div>
    </div>





    <div class="cont-registro">

        <div class="container">
            <div class="input-group" style="margin-top: 20px; justify-content: right; align-items: center;">
                <input type="text" class="input" id="searchCedula" name="searchCedula" placeholder="12345678" autocomplete="off">
                <input class="button--submit" value="Tomar datos" onclick="tomarDatos()" type="button">
            </div>



            <form action="" method="post" class="dos">

                <div class="form first">

                    <div class="details personal">
                        <span class="title">Detalles del beneficiario</span>
                        <div class="fields">





                            <div class="input-field dos">
                                <label>Nombre</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="nombre" id="nombre" value="<?php echo $registro['nombre'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Apellido</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="apellido" id="apellido" value="<?php echo $registro['apellido'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Cédula</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="cedula" id="cedula" value="<?php echo $registro['cedula'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Nacionalidad</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="nacionalidad" id="nacionalidad" value="<?php echo $registro['nacionalidad'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Fecha de nacimiento</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="fecha_naci" id="fecha_naci" value="<?php echo $registro['fecha_naci'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Edad</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="edad" id="edad" value="<?php echo $registro['edad'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Sexo</label>
                                <input type="text" placeholder="numero de personas a atender" readonly name="sexo" id="sexo" value="<?php echo $registro['sexo'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Telefono</label>
                                <input type="number" placeholder="numero de personas a atender" readonly name="telefono" id="telefono" value="<?php echo $registro['telefono'] ?>">
                            </div>






                        </div>




                    </div>
                    <div class="details personal">
                        <span class="title">Servicios prestado cargado: <span style="color: black; background:white"> <?php echo $registro['nombre_servicio'] ?></span></span>
                        <div class="fields">
                            <div class="input-field">

                                <label>Cambiar de servicio prestado</label>
                                <select name="apertura" id="apertura" require>
                                
                                    <option value="apertura">Apertura de historia medica</option>
                                    <option value="asesoria">Asesoria o información</option>
                                    <option value="entrega">entrega</option>
                                    <option value="prueba_marcha">Prueba de marcha</option>
                                    <option value="solicitud_reparacion">Solicitud de reparacion</option>
                                    <option value="toma_medidas">toma_medidas</option>
                                  

                                </select>


                            </div>



                        </div>




                    </div>
                    <div class="details personal">
                        <span class="title">Otros detalles</span>
                        <div class="fields">

                            <div class="input-field dos">
                                <label>Fecha de registro</label>
                                <input type="date" placeholder="fecha de registro" required name="fecha_registro" id="fecha_registro" value="<?php echo $registro['fecha_registro'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>Fecha de la asistencia</label>
                                <input type="date" placeholder="fecha de la asistencia" required name="fecha_asistencia" id="fecha_asistencia" value="<?php echo $registro['fecha_asistencia'] ?>">
                            </div>
                            <div class="input-field dos">
                                <label>N° de expediente</label>
                                <input type="text" placeholder="fecha de registro" required name="expediente" id="expediente" value="<?php echo $registro['expediente'] ?>">
                            </div>



                        </div>




                    </div>
                </div>

                <button class="nextBtn" name="registro" id="registro">
                    <span class="btnText">Modificar registro</span>
                    <ion-icon name="send-outline"></ion-icon>
                </button>
            </form>
        </div>
    </div>
</div>
























<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>


<!-- Subir Archivos -->
<script>

</script>
<script type="text/javascript">
    $(function() {
        $("#registro").click(function(e) {
            var valid = this.form.checkValidity();
            if (valid) {

                var id = <?php echo json_encode($id); ?>;
                var cedula = $("#cedula").val();
                var fecha_registro = $("#fecha_registro").val();
                var fecha_asistencia = $("#fecha_asistencia").val();
                var expediente = $("#expediente").val();
                var nombre = $("#nombre").val();
                var apellido = $("#apellido").val();

                var servicios = $("#apertura").val()


                console.log(servicios);

                e.preventDefault();
                asignarAtencion();
                $.ajax({
                    type: "POST",
                    url: "../php2/__atenciones_laboratorio.php",

                    data: {
                        accion: 'm',
                        id: id,
                        cedula: cedula,
                        servicios: servicios,
                        fecha_registro: fecha_registro,
                        fecha_asistencia: fecha_asistencia,
                        expediente: expediente,
                    },

                    success: function(data) {
                        console.log(data)
                        if (data.message == 200) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Modificación de atencion',
                                'text': 'Se registro correctamente la modificación',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                location.reload();
                            })
                        }
                        if (data.message == 500) {
                            Swal.fire({
                                'icon': 'error',
                                'title': 'Registro de atencion',
                                'text': 'No se pudo registrar la atencion',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                location.reload();
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


<script>
    function eliminar(p1) {



        var id = p1;
        console.log(id);


        Swal.fire({
            icon: "question",
            title: '¿Desea eliminar esta atencion?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Eliminar',
            denyButtonText: `No eliminar`,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {

                asignarAtencion();
                $.ajax({
                    type: "GET",
                    url: "../php2/__atenciones_laboratorio.php",
                    data: {
                        accion: 'b',
                        id: id
                    },
                    success: function(data) {

                        console.log(data)
                        if (data.message == 200) {

                            Swal.fire({
                                'icon': 'success',
                                'title': 'Proceso completado',
                                'text': 'Se elimino correctamente esta atencion',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                location.reload()
                            })
                        }
                        if (data.message == 500) {

                            Swal.fire({
                                'icon': 'error',
                                'title': 'Ocurrió un error',
                                'text': 'No se pudo eliminar el registro',
                                'confirmButton': 'btn btn-success'
                            }).then(function() {
                                window.reload()
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
            } else if (result.isDenied) {
                Swal.fire('Changes are not eliminated', '', 'info')
            }
        })
    }
</script>



<script>
    function tomarDatos() {

        let cedula = $('#searchCedula').val();

        console.log(cedula)

        $.ajax({
            type: "POST",
            url: "../php2/buscar_datos_beneficiario.php",
            data: {
                cedula: cedula
            },
            success: function(data) {
                if (data.message == 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se encontro ningun beneficiario con esa cedula',
                        footer: '<a href="01-atencionCiuInfraestructura.php">Ir a registrar</a>'
                    })
                }

                if (data.message == 200) {
                    console.log(data)
                    $('#nombre').val(data.datos.nombre).prop('readonly', true);
                    $('#apellido').val(data.datos.apellido).prop('readonly', true);
                    $('#cedula').val(data.datos.cedula).prop('readonly', true);
                    $('#nacionalidad').val(data.datos.nacionalidad).prop('readonly', true);
                    $('#fecha_naci').val(data.datos.fecha_naci).prop('readonly', true);
                    $('#edad').val(data.datos.edad).prop('readonly', true);
                    $('#sexo').val(data.datos.sexo).prop('readonly', true);
                    $('#telefono').val(data.datos.telefono).prop('readonly', true);

                }
            },
            error: function(data) {
                console.log(data)
            }
        })
    };
</script>

<script>
    $("#ver_graficas").hide();
    $("#registrar_atencion").hide();

    function opciones_menu_protesis() {
        $("input[name='atencion_especial']").change(function() {
            console.log(this.value + ":" + this.checked);
            if (this.value == "ver_graficas") {

                $("#registrar_atencion").hide();
                $("#ver_graficas").show();
                $("#ver_atenciones").hide();
            }

            if (this.value == "registrar_atencion") {
                $("#ver_graficas").hide();
                $("#registrar_atencion").show();
                $("#ver_atenciones").hide();
            }
            if (this.value == "ver_atenciones") {
                $("#ver_graficas").hide();
                $("#registrar_atencion").hide();
                $("#ver_atenciones").show();

            }


        });
    }
</script>