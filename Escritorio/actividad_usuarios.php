<?php
include_once("partearriba.php");
?>
<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Atencion al Ciudadano: <?php echo $rol ?></span>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
            <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

        </div>
    </div>
    <div class="tabla-atencion">
            
            <h2>Todos los usuarios</h2>
    
            <table id="atencionU">
                <thead>
                    <tr>
                        <th>Cedula de usuario</th>
                        <th>Nombre</th>
                        <th>rol</th>
                        <th>gerencia</th>
                      
    
    
                    </tr>
                </thead>
                <tbody id="atenciones">
    
                    <?php
                    include_once("../php/03-usuario.php");
                    $aten = new Usuario(1);
                    $aten->setgerencia($gerencia);
                    $consulta = $aten->consultarUsuariosTotal();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                               <!--  <td><?php /* echo $registros["numero_aten"]  */?></td> -->
                                <td><?php echo $registros['cedula']; ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["rol"] ?></td>
                                <td><?php echo $registros["gerencia"] ?></td>
                                
                               
    
    
    
                            </tr>
                    <?php
                        }
                    }
                    ?>
    
                </tbody>
            </table>
        </div>

    <div class="tabla-conteo">

        <div class="tabla-atencion una">
            
            <h2>Actividad de los usuarios</h2>
    
            <table id="atencion">
                <thead>
                    <tr>
                        <th>Cedula de usuario</th>
                        <th>Nombre</th>
                        <th>ID de atencion dada</th>
                        <th>cedula beneficiario</th>
                      
    
    
                    </tr>
                </thead>
                <tbody id="atenciones">
    
                    <?php
                    include_once("../php/03-usuario.php");
                    $aten = new Usuario(1);
                    $aten->setgerencia($gerencia);
                    $consulta = $aten->consultarUsuariosOAC();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                               <!--  <td><?php /* echo $registros["numero_aten"]  */?></td> -->
                                <td><?php echo $registros['cedula']; ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["numero_aten"] ?></td>
                                <td><?php echo $registros["beneficiarioCedula"] ?></td>
                               
    
    
    
                            </tr>
                    <?php
                        }
                    }
                    ?>
    
                </tbody>
            </table>
        </div>

        <div class="tabla-atencion dos">
            
            <h2>Total de atencion por usuario</h2>
    
            <table id="atencionE">
                <thead>
                    <tr>
                        <th>Cedula de usuario</th>
                        <th>Nombre</th>
                        <th>cantidad de atenciones</th>
                        
                      
    
    
                    </tr>
                </thead>
                <tbody id="atenciones">
    
                    <?php
                    include_once("../php/03-usuario.php");
                    $aten = new Usuario(1);
                    $aten->setgerencia($gerencia);
                    $consulta = $aten->Total_atencion_por_usuario();
                    $cantidadRegistros = count($consulta);
                    if ($consulta) {
                        foreach ($consulta as $registros) {
                    ?>
                            <tr>
                               <!--  <td><?php /* echo $registros["numero_aten"]  */?></td> -->
                                <td><?php echo $registros['cedula']; ?></td>
                                <td><?php echo $registros["nombre"] ?></td>
                                <td><?php echo $registros["numero"] ?></td>
                       
                               
    
    
    
                            </tr>
                    <?php
                        }
                    }
                    ?>
    
                </tbody>
            </table>
        </div>

    </div>
</div>
<script src="main.js"></script>

<?php
include_once("parteabajo.php");
?>