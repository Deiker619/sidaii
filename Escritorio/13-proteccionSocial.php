<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Beneficiarios: <?php echo $rol ?></span>
        </div>
    </div>
 <!-- Boton de reporte -->

 <a href=""> <button class="download-button">
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


    <div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="01,5-atencionRecibida.php">Personas con atenciones recibidas</a></div> -->
        <h2>Personas con proteccion social:
            <?php
            include_once("../php/01-discapacitados.php");
            $aten = new Discapacitados(1);
            $contar = $aten->PersonasProteccionSocial();
            echo count($contar);

            ?>
        </h2>
        <div class="group">
  <svg class="iconn" aria-hidden="true" viewBox="0 0 24 24"><g><path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path></g></svg>
  <input placeholder="Buscar" id= "buscador" type="search" class="inputt">
</div>
<br>
        <table>
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>telefono</th>
                    <th>nombre_estado</th>
                    <th>Recibe proteccion social</th>
                </tr>
            </thead>
            <tbody id="spr">

                <?php
                include_once("../php/01-discapacitados.php");
                $aten = new Discapacitados(1);
                $consulta = $aten->PersonasProteccionSocial();
                $cantidadRegistros = count($consulta);
                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>

                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["telefono"] ?></td>
                            <td><?php echo $registros["nombre_estado"] ?></td>
                            <td><?php echo $registros["proteccion_social"] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody >
        </table>
    </div>


    <script>
       /*  function prueba() {
            const tabla = $.ajax({
                url: "Beneficiarios1.php",
                dataType: "text",
                async: false,
            }).responseText;
            document.getElementById("Beneficiarios1").innerHTML = tabla;
        }
        let intervalo = setInterval(prueba, 2000) */

        /* $(document).ready(function() {
            $("#buscador").on("keyup", function() {
                clearInterval(intervalo);
                var value = $(this).val().toLowerCase();
                $("#Beneficiarios1 tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)

                });
            });

        }); */
    </script>

<script>
$(document).ready(function(){
  $("#buscador").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#spr tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
    <?php
    include_once("parteabajo.php");
    ?>