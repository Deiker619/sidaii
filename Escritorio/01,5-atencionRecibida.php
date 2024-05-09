<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atención al ciudadano: <?php echo $rol ?></span>
        </div>
    </div>


    <a href="reportes/reportes_oac.php"> <button class="download-button">
            <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line y2="13" x2="8" y1="13" x1="16"></line>
                    <line y2="17" x2="8" y1="17" x1="16"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> Generar Reporte</div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </button></a>

    <div class="tabla-atencion" id="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->







        <h2>Personas con atencion</h2>
        <h2>Total: <?php include_once("../php/01-atenciones.php");
                    $aten = new Atenciones(1);
                    $consulta = $aten->consultarTodosAtencionesa();
                    echo count($consulta); ?></h2>

        <table id="atencion">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Asis. Recibida</th>
                    <th>Ayuda. tecnica</th>
                    <th>Status</th>
                    <th>Certificado entrega</th>
             
                    <th>Certificado Solicitud</th>
                    <th>Informe medico</th>
                    <th></th>
                    <!-- <th></th>
                    <th></th> -->
                </tr>
            </thead>
            <tbody id="refresh">



            </tbody>
        </table>
    </div>

</div>
<canvas id="graficaxbrindada" class="chart2" style="width: 300px; height:100px"></canvas>
<script src="../package/dist/sweetalert2.all.js"></script>
<script src="../package/dist/sweetalert2.all.min.js"></script>
<script>

            function enviarEmail(a, b) {
                let correo = b
                let email = true;
                let numero_aten = a;

                /* No tiene correo */
                if (correo) {
                    Swal.fire({
                        title: "¿Desea enviar el comprobante al correo registrado?",
                        html: "<b>Correo: </b>" + b + "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Si, enviar!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            asignarAtencion();
                            $.ajax({
                                type: "POST",
                                url: "reportes/enviarEmailCompleto.php",
                                data: {
                                    numero_aten: numero_aten,
                                    correo: correo,

                                },
                                success: function(data) {
                                    console.log(data)
                                    const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer);
                                            toast.addEventListener('mouseleave', Swal.resumeTimer);



                                        },
                                        willClose: () => {

                                            window.location.href = "01,2-atenciones.php#atenciones"
                                        }
                                    });

                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Enviado exitosamente',
                                    });


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
                    });
                } else {
                    const {
                        value: atencion
                    } = Swal.fire({
                        title: 'Agrega el correo personalizado',
                        input: 'email',
                        inputLabel: 'Introduce el correo para enviar comprobante',
                        inputValue: correo,
                        footer: "Esta persona no tiene correo registrado",
                        showCancelButton: true,
                        inputValidator: (value) => {
                            if (!value) {
                                return 'Debes escribir algo'
                            }

                            if (value) {
                                correo = value;

                                asignarAtencion();
                                $.ajax({
                                    type: "POST",
                                    url: "reportes/enviarEmail.php",
                                    data: {
                                        numero_aten: numero_aten,
                                        correo: correo,

                                    },
                                    success: function(data) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.addEventListener('mouseenter', Swal.stopTimer);
                                                toast.addEventListener('mouseleave', Swal.resumeTimer);



                                            },
                                            willClose: () => {

                                                window.location.href = "01,2-atenciones.php#atenciones"
                                            }
                                        });

                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Enviado exitosamente',
                                        });

                                        if (!data) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: "No se pudo registrar la solicitud, verifique datos"
                                            }).then(function() {
                                                window.location = "01,2-atenciones.php";
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
                        }

                    })
                }
                /* Si tiene correo */

            }
        
    function subirArchivo(a) {
        var numero_aten = a;
        Swal.fire({
            title: 'Cargar Archivo',
            input: 'file',
            inputAttributes: {
                accept: ['application/pdf'], // Limita a archivos PDF, puedes ajustar según tus necesidades
            },
            showCancelButton: true,
            confirmButtonText: 'Subir',
            cancelButtonText: 'Cancelar',
        }).then((file) => {
            if (file.isConfirmed && file.value) {
                // Crear un objeto FormData y agregar el archivo y el número
                const formData = new FormData();
                formData.append('archivo', file.value);
                formData.append('numero_aten', numero_aten);

                // Hacer la solicitud AJAX utilizando jQuery
                $.ajax({
                    url: 'documentos/cargardocumento.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        console.log(data);
                        try {
                            const dataJ = JSON.parse(data);
                            Swal.fire(data, '', 'success');
                            window.location = "01,5-atencionRecibida.php"
                        } catch (error) {
                            console.error('Error al analizar la respuesta del servidor como JSON:', error);
                            Swal.fire('Error en el formato de la respuesta del servidor', '', 'error');
                        }
                    },
                    error: function(error) {
                        console.error('Error al subir el archivo:', error);
                        Swal.fire('Error al cargar el archivo', '', 'error');
                    }
                });
            }
        });
    }


    function prueba() {
        const tabla = $.ajax({
            url: "prueba.php",
            dataType: "text",
            async: false,
        }).responseText;
        document.getElementById("refresh").innerHTML = tabla;
    }
    /*   let intervalo = setInterval(prueba, 2000) */
    prueba()
    $(document).ready(function() {
        $("#buscador").on("keyup", function() {
            clearInterval(intervalo);
            var value = $(this).val().toLowerCase();
            $("#refresh tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

            });
        });

    });
</script>






<?php
include_once("parteabajo.php");
?>
<script src="graficas/OAC/graficasAtencionesRecibidas.js"></script>





