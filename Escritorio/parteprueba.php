<?php 
include_once("../php/01-discapacitados.php");

$prueba = $_REQUEST["busqueda"];

$search = new Discapacitados(1);
$search ->setcedula($prueba);

$consulta = $search->consultarDiscapacitadosP();    


if($consulta){
    foreach($consulta as $i){
        echo ' <ul>
        <a href="__verBeneficiario.php?cedula='.$i["cedula"].'"> <li>
            <div class="list_cont">
                <div class="name">'.$i["nombre"]." ".$i["apellido"].'</div>
                <div class="name">'.$i["cedula"].'</div>
                
               
            </div>
            </li></a>
        
    </ul>';
    
    }
}else{
    echo "No se ha encontrado";
}

$search->__destruct();
?>