<?php
include_once("partearriba.php");
?>

<div class="dash-contenido">
    <div class="overview">
        <div class="titulo">
            <i class='bx bxs-dashboard'> </i>
            <span class="link-name">Observaciones: <?php echo $rol ?></span>

        </div>
    </div>
    <?php

    $id = $_REQUEST["id"];
   

    echo $id; 
    ?>


</div>

<?php
include_once("parteabajo.php");
?>