<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<?php
include_once("../php/10-coordinaciones-estadales.php");
$coordinacion = $_REQUEST["coordinacion"];
$aten = new coordinacion(1);

$aten->setid($coordinacion);
$registro = $aten->consultarCoordinacion();
?>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name"><?php echo $registro["nombre_coordinacion"]; ?>: <?php echo $rol ?></span>
        </div>
    </div>



    <canvas id="otra" class="chart2"></canvas>


    <div class="graficas">
        <!-- Cargar archivos -->




        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por Atencion brindada</h2>
            <canvas id="graficaxbrindada"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones totales por Mes</h2>
            <canvas id="graficaxmes"></canvas>
        </div>

        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por Año </h2>
            <canvas id="graficaxaño"></canvas>
        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones por sexo</h2>
            <canvas id="graficaxsexo"></canvas>
        </div>
    </div>

    
    <canvas id="graficaxatencion" class="chart2"></canvas>
    <div class="graficas">
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones sin dar</h2>
            
            <div class="cantidad_registro sindar"><?php 
                include_once("../php/10-coordinaciones-estadales.php");
                $aten = new coordinacion(1);
                $aten->setid($coordinacion);
                $reg = $aten->consultarCoordinacionesXatencionesSINDAR();

                if (!$reg) {
                    echo "0";
                }else{
                    echo $reg["numero"];
                }


            
            
            ?> </div>
            
        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Atenciones dadas</h2>
            
            <div class="cantidad_registro dadas"><?php 
                include_once("../php/10-coordinaciones-estadales.php");
                $aten = new coordinacion(1);
                $aten->setid($coordinacion);
                $reg = $aten->consultarCoordinacionesXatencionesDADAS();


                echo $reg["dadas"]
            
            ?> </div>
        </div>
    </div>  
   
    <div class="botones-header">
            <a href="reportes/reportegeneralOAC.php"> <button class="download-button">
                    <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line y2="13" x2="8" y1="13" x1="16"></line>
                            <line y2="17" x2="8" y1="17" x1="16"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg> Generar Reporte de solicitudes</div>
                    <div class="download">
                        <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2" stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line y2="3" x2="12" y1="15" x1="12"></line>
                        </svg>
                    </div>
                </button>
            </a>
    </div>
    <div class="tabla-atencion">
        
        
        <h2>Solicitudes</h2>
        <table id="atencion">
            <thead>
                <tr>
                   
                    <th>Nombre de la solicitud</th>
                    <th>Cantidad</th>
                    

                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/10-coordinaciones-estadales.php");
                $aten = new Coordinacion(1);
                $aten->setid($coordinacion);
                $consulta = $aten->consultadeSolicitudes();
                $cantidadRegistros = count($consulta);

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                        
                            <td><?php echo $registros["atencion_solicitada"] ?></td>
                            <td><?php echo $registros["cantidad"]?></td>
                
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>







    <script src="../package/dist/sweetalert2.all.js"></script>
    <script src="../package/dist/sweetalert2.all.min.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#registro").click(function(e) {
                var valid = this.form.checkValidity();
                if (valid) {
                    var cedula = $("#cedula").val();
                    var nombre = $("#nombre").val();
                    var apellido = $("#apellido").val();
                    var numero_jornada = $("#numero_jornada").val();
                    var discapacidad = $("#discapacidad").val();
                    var tipo_ayuda_tec = $("#tipo_ayuda_tec").val();

                    e.preventDefault();
                    $.ajax({
                        type: "POST",
                        url: "02,2-jornadaAsignada.php",

                        data: {
                            cedula: cedula,
                            nombre: nombre,
                            apellido: apellido,
                            discapacidad: discapacidad,
                            numero_jornada: numero_jornada,
                            tipo_ayuda_tec: tipo_ayuda_tec
                        },

                        success: function(data) {
                            Swal.fire({
                                'icon': 'success',
                                'title': 'Asignacion de atencion',
                                'text': 'Se asigno asistencia correctamente',

                            }).then(function() {
                                window.location = "02-AsignarJornada.php?id=<?php echo $numero ?>";
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

    <script>
        const grafica = document.querySelector("#otra").getContext("2d");
        const graficaxatencion = document.querySelector("#graficaxatencion").getContext("2d");
        const graficaxbrindada= document.querySelector("#graficaxbrindada").getContext("2d");
        const graficaxmes= document.querySelector("#graficaxmes").getContext("2d");
        const graficaxaño= document.querySelector("#graficaxaño").getContext("2d");
        const graficaxsexo= document.querySelector("#graficaxsexo").getContext("2d");

        
        var coordinacion = <?php echo json_encode($coordinacion); ?>


        // Realizar la solicitud Ajax usando jQuery

        //Atenciones por discapacidad
        $.ajax({
            url: "graficas/graficas_coordinaciones.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                // Crear arreglos para almacenar los datos del gráfico
                var nombres_discapacidad = [];
                var discapacidades = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombre_discapacidad = data[i].nombre_discapacidad;
                    var discapacidad = data[i].discapacidad;

                    nombres_discapacidad.push(nombre_discapacidad);
                    discapacidades.push(discapacidad);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(grafica, {
                    type: "line",
                    data: {
                        labels: nombres_discapacidad,
                        datasets: [{
                            label: "Ayudas tecnicas",
                            data: discapacidades,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por ayuda
        $.ajax({
            url: "graficas/graficas_por_atenciones.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var nombres_deayuda = [];
                var Ayudas_dadas = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombre = data[i].nombre_tipoayuda;
                    var Ayuda = data[i].Ayudas_dadas;

                    nombres_deayuda.push(nombre.slice(0, 11));
                    Ayudas_dadas.push(Ayuda);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxatencion, {
                    type: "line",
                    data: {
                        labels: nombres_deayuda,
                        datasets: [{
                            label: "Ayudas tecnicas",
                            data: Ayudas_dadas,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones brindadas
        $.ajax({
            url: "graficas/graficas_recibidas.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var nombre = [];
                var Recibidas = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var nombres = data[i].nombre;
                    var Recibidass = data[i].Recibidas;

                    nombre.push(nombres);
                    Recibidas.push(Recibidass);
                }

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxbrindada, {
                    type: "line",
                    data: {
                        labels: nombre,
                        datasets: [{
                            label: "Ayudas tecnicas",
                            data: Recibidas,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por mes
        $.ajax({
            url: "graficas/graficas_por_mes.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(mes) {
                var valore = eval(mes);
                      var ene = valore[0];
                      var feb = valore[1];
                      var mar = valore[2];
                      var abr = valore[3];
                      var may = valore[4];
                      var jun = valore[5];
                      var jul = valore[6];
                      var ago = valore[7];
                      var sep = valore[8];
                      var oct = valore[9];
                      var nov = valore[10];
                      var dic = valore[11];
                  


                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxmes, {
                    type: "line",
                    data: {
                        labels: ["Ene", "Feb", "Marz", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
                        datasets: [{
                            label: "Ayudas tecnicas",
                            data: [ene, feb, mar, abr, may, jun, jul, ago, sep, oct, nov, dic],
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        //Atenciones por año
        $.ajax({
            url: "graficas/graficas_por_año.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(year) {

                var valors = eval(year);
                var años = valors[0];
                console.log(años)

                let tiempo = new Date()
                let año = tiempo.getFullYear().toString();
                console.log(año)
                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxaño, {
                    type: "bar",
                    data: {
                        labels: [año],
                        datasets: [{
                            label: "Asistencias por año",
                            data: años,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
        // Atenciones por sexo
        $.ajax({
            url: "graficas/graficas_por_sexo.php",
            method: "GET",
            data: {
                coordinacion: coordinacion
            },
            dataType: "json",
            success: function(data) {
                console.log(data)
                var sexoss = [];
                var cantidadess = [];

                // Recorrer los datos y agregarlos a los arreglos
                for (var i = 0; i < data.length; i++) {
                    var sexo = data[i].sexos;
                    var cantidad = data[i].cantidades;

                    sexoss.push(sexo);
                    cantidadess.push(cantidad);
                }
                console.log(sexoss)

                // Crear el gráfico después de obtener todos los datos
                new Chart(graficaxsexo, {
                    type: "line",
                    data: {
                        labels: sexoss,
                        datasets: [{
                            label: "Sexos",
                            data: cantidadess,
                            borderColor: "#38b000",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error("Error en la solicitud Ajax:", status, error);
            }
        });
    </script>


