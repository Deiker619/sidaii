<?php




/* artificio: artificio,
artificio_para_medidas: artificio_para_medidas,
lado_afect: lado_afect,
dis_or: dis_or,
or_afect: or_afect,
nervio_afect: nervio_afect,
a: a */

$id = $_POST["id"];
$artificio = $_POST["artificio"];
$cedula = $_POST["cedula"];
$fecha_aper = $_POST["fecha_aper"];
$fecha_cita = $_POST["fecha_cita"];

if ($artificio == "-protesis") {
    include_once("12-historia_medica_protesis.php");

    $nivel_actividad = $_POST["nivel_actividad"];
    $lado_amp = $_POST["lado_amp"];
    $nivel_ampu = $_POST["nivel_ampu"];
    $niveles_AMPU = $_POST["niveles_AMPU"];
    $forma = $_POST["forma"];
    $Cicatriz = $_POST["Cicatriz"];
    $piel = $_POST["piel"];
    $Musculatura = $_POST["Musculatura"];
    $diseno_pro = $_POST["diseno_pro"];
    $t_rodilla = $_POST["t_rodilla"];
    $t_socket = $_POST["t_socket"];
    $t_pie = $_POST["t_pie"];
    $c_socket = $_POST["c_socket"];
    $Meto_suspension = $_POST["Meto_suspension"];

    $historia = new historia_medica_protesis(1);
    $historia->setcodigo_cita($id);
    $historia->setcedula($cedula);
    $historia->setnivel_actividad($nivel_actividad);
    $historia->setlado_amputacion($lado_amp);
    $historia->setnivel_amputacion($nivel_ampu);
    $historia->setzona_afectada($niveles_AMPU);
    $historia->setdiseno($diseno_pro);
    $historia->setfecha_medidas($fecha_cita);
    $historia->setfecha_apertura($fecha_aper);
  
    $insercion = $historia->insertarHistoriaProtesis();
    if ($insercion) {
        $historia->setid($id);
        $historia->Modificar_al_cargar_HM();
        include_once("01-03-toma_medidas.php");
        $tomaMedidas = new toma_medidas(1);
        $tomaMedidas->setcodigo_cita($id);
        $tomaMedidas->setfecha_medidas($historia->getfecha_medidas());
        $tomaMedidas->setcedula($cedula);
        $tomaMedidas->setartificio($artificio);
        $tomaMedidas->insertarMedidas();
    }

    // Estado Muñón
    $historia->setcodigo_cita($id);
    $consulta = $historia->consultar();
    $historia->setid_historia($consulta["id"]);
    $historia->setforma($forma);
    $historia->setcicatriz($Cicatriz);
    $historia->setpiel($piel);
    $historia->setmusculatura($Musculatura);
    $historia->insertarEstadoMunon();

    // Características de Prótesis
    $historia->settipo_rodilla($t_rodilla);
    $historia->settipo_socket($t_socket);
    $historia->settipo_pie($t_pie);
    $historia->setclasificacion_socket($c_socket);
    $historia->setmetodo_suspension($Meto_suspension);
    $historia->insertarCaracteristicasProtesis();
}




if ($artificio == "-ortesis") {

    include_once("11-historia_medica.php");
    $historia = new historia_medica(1);

    $artificio_para_medidas = $_POST["artificio_para_medidas"];
    $lado_afect = $_POST["lado_afect"];
    $dis_or  = $_POST["dis_or"];
    $or_afect = $_POST["or_afect"];
    $nervio_afect = $_POST["nervio_afect"];
    $a = $_POST["a"];
   
    $cmppp = $_POST["cmppp"];
    $clasificacion = $_POST["clasificacion"];

  
    /* echo $artificio . " " . $artificio_para_medidas . " " . $lado_afect . " " . $dis_or . " " . $or_afect . " " . $nervio_afect . " " . $a . " " . $cedula;
 */




    

    if ($artificio_para_medidas == "ort-infe") {
        $historia->setcodigo_cita($id);
        $historia->setsolicitud($cmppp);
        $historia->setartificio($artificio);
        $historia->setartificio_medidas($artificio_para_medidas);

        $historia->setfecha_apertura($fecha_aper);
        $historia->setfecha_medidas($fecha_cita);
        $historia->setcedula($cedula);
        $insercion = $historia->insertarHistoriaOrtesis();

        if ($insercion) {
            $historia->setid($id);
            $historia->setfecha_apertura($fecha_aper);
            $historia->setfecha_medidas($fecha_cita);
            $historia->Modificar_al_cargar_HM();
            include_once("01-03-toma_medidas.php");
            $tomaMedidas = new toma_medidas(1);
            $tomaMedidas->setcodigo_cita($id);
            $tomaMedidas->setfecha_medidas($historia->getfecha_medidas());
            $tomaMedidas->setcedula($cedula);
            $tomaMedidas->setartificio($historia->getartificio_medidas());
            $tomaMedidas->insertarMedidas();
        }
    }
    if ($artificio_para_medidas == "ort-super") {
        $historia->setcodigo_cita($id);
        $historia->setid($id);
        $historia->setnervio_afectado($nervio_afect);
        $historia->setlado_afectado($or_afect);
        $historia->setzona_del_lado($lado_afect);
        $historia->setdiseno($dis_or);

        $historia->setfecha_apertura($fecha_aper);
        $historia->setfecha_medidas($fecha_cita);

        $historia->setsolicitud($a);
        $historia->setartificio_medidas($artificio_para_medidas);
        $historia->setartificio($artificio);
        $historia->setcedula($cedula);
        $insercion = $historia->insertarHistoriaOrtesis();

            if ($insercion) {
                $historia->setid($id);

                $historia->Modificar_al_cargar_HM();

                include_once("01-03-toma_medidas.php");
                $tomaMedidas = new toma_medidas(1);
                $tomaMedidas->setcodigo_cita($id);
                $tomaMedidas->setfecha_medidas($historia->getfecha_medidas());
                $tomaMedidas->setcedula($cedula);
                $tomaMedidas->setartificio($historia->getartificio_medidas());
                $tomaMedidas->insertarMedidas();
            }
    }
}

/* Cargar fecha de cita para quitar registro de la lista principal y moverlo a las citas dadas */

/* if($consulta){
		echo "Ya esta persona fue remitida";
	}else{ */
?>