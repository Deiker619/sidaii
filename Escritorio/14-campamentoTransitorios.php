<?php
include_once("partearriba.php");
?>
<!-- contenido -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Campamentos transitorios: <?php echo $gerencia ?> </span>
        </div>
    </div>

    <div class="saludo">
        <div class="date-saludo">

        </div>
        <div class="contenedor-saludo">
            <div class="text">
                <h1 class="text-saludo">Bienvenido/a, <span style="color:aliceblue"> <?php echo $NombreUsuarioActivo . " [" . $rol . "]"; ?></span></h1>
                <a href="#tablaCampamentos"><button class="boton-saludo">
                        ir a la tabla de personas
                    </button></a>

            </div>
            <div class="contenedor-img">
                <img src="./img/saludo.png" alt="" srcset="">
            </div>
        </div>
    </div>

    <!-- Gráficas por sexo y edad -->
    <div class="graficas">
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Personas por sexo en campamentos</h2>
            <canvas id="campSexo"></canvas>
        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Personas por edad en campamentos</h2>
            <canvas id="campEdad"></canvas>
        </div>
    </div>

    <!-- Gráficas por discapacidad general y específica -->
    <div class="graficas">
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Personas por discapacidad general en campamentos</h2>
            <canvas id="campDiscGeneral"></canvas>
        </div>
        <div class="tarjetas-graficas">
            <h2 class="titulo-grafica">Personas por discapacidad específica en campamentos</h2>
            <canvas id="campDiscEspecifica"></canvas>
        </div>
    </div>

    <!-- Tabla de personas en campamentos transitorios -->
    <div class="tabla-atencion" id="tablaCampamentos">
        <h2>Personas en campamentos transitorios</h2>

        <table id="tablaCampamentosTable">
            <thead>
                <tr>
                    <th>Cedula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Estado</th>
                    <th>Discapacidad</th>
                    <th>Telefono</th>
                    <th>Edad</th>
                    <th>Email</th>
                    <th>Campamento</th>
                    <th>Direccion</th>
                </tr>
            </thead>
            <tbody>

                <?php
                include_once("../php/01-atenciones-estadales.php");
                $aten = new AtencionesEstadales(1);
                $consulta = $aten->consultarPersonasEnCampamentos();

                if ($consulta) {
                    foreach ($consulta as $registros) {
                ?>
                        <tr>
                            <td><?php echo $registros["cedula"] ?></td>
                            <td><?php echo $registros["nombre"] ?></td>
                            <td><?php echo $registros["apellido"] ?></td>
                            <td><?php echo $registros["estado_beneficiario"] ?></td>
                            <td><?php echo $registros["discapacidad"] ?></td>
                            <td><?php echo $registros["telefono"] ?></td>
                            <td><?php echo $registros["edad"] ?></td>
                            <td><?php echo $registros["email"] ?></td>
                            <td><?php echo $registros["nombre_campamento"] ?></td>
                            <td><?php echo $registros["direccion_campamento"] ?></td>
                        </tr>
                <?php
                    }
                }
                ?>

            </tbody>
        </table>
    </div>
</div>

<script src="mainCampamento.js"></script>

<script>
    $(document).ready(function () {
        $('#tablaCampamentosTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/Spanish.json"
            }
        });
    });
</script>

<?php include_once("parteabajo.php"); ?>
