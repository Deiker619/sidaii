<?php
include_once("partearriba.php");
?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>


<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Ortesis y protesis: <?php echo $rol ?></span>
        </div>
    </div>
<div class="tabla-atencion">
        <!-- <div class="personas-conatencion"><a href="#">Personas con atenciones recibidas</a></div> -->
            <h2>Pruebas dadas </h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cedula</th>
                        <th>Nombre</th>
                        <th>Apellido</th>

                        <th>Artificio</th>
     
                        <th>Status</th>
                        <th>Descripcion</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php 
                        include_once("../php/01-02-cita_protesis.php");
                        $aten = new citas_protesis(1);
                        $consulta = $aten->consultarTodasPruebaDadas();
                        $cantidadRegistros = count($consulta);
                        if ($consulta){
                        foreach($consulta as $registros){       
                     ?>
                    <tr>
                      
                        <td><?php echo $registros["id"] ?></td>
                        <td><?php echo $registros["cedula"] ?></td>
                        <td><?php echo $registros["nombre"] ?></td>
                        <td><?php echo $registros["apellido"] ?></td>
                        <td><?php echo $registros["artificio"] ?></td>
                        <td><?php echo $registros["status"] ?></td>
                        <td><a onclick="verDescripcion('<?php echo $registros['descripcion'] ?>','<?php echo $registros['medidas'] ?>')" class="remitir">Ver medidas</a></td>
                  
                       <!--  <td><a href="01,3-asignarAtencion.php?numero_aten=<?php  $registros["numero_aten"]?>">Dar atencion</a></td>
                        <td><a href="" class="eliminar">Eliminar Reg</a></td> -->
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
<script>
    function verDescripcion(p1, p2) {
            Swal.fire({
                title: 'Descripción del requerimiento:',
                confirmButtonText: 'OK',
                confirmButtonColor: '#1AA83E',
                html: `<details>
                        <summary>Requerimiento principal</summary>
                        <p>${p1}</p>
                    </details>
                    
                    <details>
                        <summary>Medidas</summary>
                        <p>${p2}</p>
                    </details>
                    `,
            })
        }

</script>
<?php
include_once("parteabajo.php");
?>
