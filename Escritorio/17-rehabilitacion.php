<?php
include_once('partearriba.php');
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="stylesprotesis.css">
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Rehabilitacion: Apertura</span>
        </div>
    </div>

    <div class="tabla-atencion">
        <div class="personas-conatencion">
            <div class="botones__especiales">
                <button class="Btn export">

                    <div class="sign">
                        <i class='bx bx-export'></i>
                    </div>

                    <div class="text_boton">Remitidos de gerencia</div>
                </button>
                <button class="Btn import">

                    <div class="sign">
                        <i class='bx bx-import'></i>
                    </div>

                    <a href="04-ort-remitidos.php" class="enlace_especial">
                        <div class="text_boton"> Remitidos a gerencia
                    </a>
            </div>
            </button>

        </div>
        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">

            <!-- From Uiverse.io by vinodjangid07 -->

            <form id="form_agregar">
                <div class="messageBox">

                    <input required="" placeholder="Ingrese la cedula para agregar" type="text" id="messageInput" />
                    <button id="sendButton" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 664 663">
                            <path
                                fill="none"
                                d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                            <path
                                stroke-linejoin="round"
                                stroke-linecap="round"
                                stroke-width="33.67"
                                stroke="#6c6c6c"
                                d="M646.293 331.888L17.7538 17.6187L155.245 331.888M646.293 331.888L17.753 646.157L155.245 331.888M646.293 331.888L318.735 330.228L155.245 331.888"></path>
                        </svg>
                    </button>
                </div>
            </form>
            <div style="display: flex; justify-content: center; align-items: center;">

                <a class="enlace" style="margin: 0;" href="17-rehabilitaciones_activas.php">Rehabilitaciones activas</a>
            </div>


        </div>
    </div>
    <h2>Personas para rehabilitación</h2>
    <table id="atencion">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>id de la apertura</th>
                <th>Status</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>

            <?php
            include_once("../php2/__rehabilitacion.php");
            $aten = new rehabilitacion(1);
            $consulta = $aten->consultarTodasCitasSindar();
            $cantidadRegistros = count($consulta);
            if ($consulta) {
                foreach ($consulta as $registros) {
            ?>
                    <tr>

                        <td> <a class="cedula" name="enlace" id="verBeneficiario" href="__verBeneficiario.php?cedula=<?php echo $registros['cedula']; ?>"><?php echo $registros['cedula']; ?> </a></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["id"] ?></td>

                        <td style="color: red;">Proceso: <?php echo $registros["status"] ?></td>
                        <td><a href="17-rehabilitacion_ver.php?id=<?php echo $registros["id"] ?>">Aperturar rehabilitación</a></td>
                        <td><a href="eliminar/eliminar_orte.php?id=<?php echo $registros["id"] ?>" class="eliminar">Eliminar Reg</a></td>
                    </tr>
            <?php
                }
            }
            ?>

        </tbody>
    </table>
</div>

</div>

<script>
    function add_servicio() {

        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
            willClose: () => {

                location.reload()
            }

        })
        let cedula = $('#messageInput').val();
        var cedulauser = <?php echo json_encode($cedulauser); ?>

        console.log(cedula)


        $.ajax({
            type: "POST",
            url: "../php2/__agregar_servicio_infraestructura.php",
            data: {
                servicio: 'rehabilitacion',
                cedula: cedula,
                cedulauser: cedulauser
            },
            success: function(data) {
                console.log(data)
                if (data.code == 404) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No se encontro ningun beneficiario con esa cedula',
                        footer: '<a href="01-atencionCiuInfraestructura.php">Ir a registrar</a>'
                    })
                }

                if (data.code == 200) {
                    Toast.fire({
                        icon: "success",
                        title: data.message
                    })

                }
            },
            error: function(data) {
                console.log(data)
            }
        })
    };

    $('#form_agregar').on('submit', function(event) {
        // Detecta el envío del formulario
        event.preventDefault();
        add_servicio()

    });
</script>
<?php
include_once('parteabajo.php');
?>