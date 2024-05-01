<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
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
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Asis. Recibida</th>
                    <th>Ayuda. tecnica</th>
                    <th>Status</th>
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

<script>
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