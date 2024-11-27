<?php

/* include_once("01-atenciones.php"); */
include_once("01-discapacitados.php");
include_once("detalles_institucionales.php");
include_once("detalles_emprendimiento.php");
include_once("detalles_cuidador.php");

if (isset($_POST['registrado'])) {
	$beneficiario = new Discapacitados(1);
	$cedula = $_POST["cedula"];
	$cedulauser = $_POST["cedulauser"];

	$atencion_solicitada = $_POST["atencion"];
	$beneficiario->setcedula($cedula);

	$Consulta = $beneficiario->consultarDiscapacitados();
	if ($Consulta) {

		switch ($atencion_solicitada) {
			
			case "1-oac":
				require_once("../php/01-atenciones.php");
				$atencion = new Atenciones(1);
				$atencion->setasignado($cedulauser);
				$atencion->setcedula($cedula);
				$consultaayuda = $atencion->autenticarAtencion();
				
				$data = [
					'message' => 'Se registro exitosamente',
					'others' => $consultaayuda??null
				];
				header('Content-Type: application/json');
				echo json_encode($data);
				$atencion->insertarAtencion();
				
				break;

			case "2-ayudte":
				require_once("../php/01-01-ayudas_tec.php");
				$atencion = new Ayudas_tec(1);
				$atencion->setcedula($cedula);
				$consultaayuda = $atencion->autenticarAyuda();
				if (!$consultaayuda) {
					echo "Se registro exitosamente";
					$atencion->insertarAyuda_tec();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "3-orypro":
				require_once("../php/01-02-cita_protesis.php");
				$cita = new citas_protesis(1);
				$cita->setcedula($cedula);
				$consultaayuda = $cita->autenticarProtesis();

				$cita->insertarCita();
				$data = [
					'message' => 'Se registro exitosamente para citas de ortesis y protesis',
					'others' => null
				];
				header('Content-Type: application/json');
				echo json_encode($data);

				break;

			case "4-tomedi":
				require_once("../php/01-03-toma_medidas.php");
				$medidas = new toma_medidas(1);
				$medidas->setcedula($cedula);
				$consultamedidas = $medidas->autenticarMedidas();
				
					$medidas->insertarMedidas();
					$data = [
						'message' => 'Se registro exitosamente',
						'others' => $consultaayuda??null
					];
					header('Content-Type: application/json');
					echo json_encode($data);
				
				break;

			case "5-pruebar":
				require_once("../php/01-04-pruebaArtificio.php");
				$artificio = $_POST["artificio"];
				$fecha_prueba = $_POST["fecha_prueba"];
				$medidas = new prueba_artificio(1);
				$medidas->setcedula($cedula);
				$medidas->setfecha_prueba($fecha_prueba);
				$medidas->setartificio_prueba($artificio);

				$ConsultaPruebas = $medidas->autenticarArtificio();
				if (!$ConsultaPruebas) {
					echo "Se registro exitosamente";
					$medidas->insertarPrueba();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "6-repaart":
				require_once("../php/01-05-reparacionArtificio.php");
				$medidas = new raparacion_artificio(1);
				$medidas->setcedula($cedula);
				$ConsultaPruebas = $medidas->autenticarReparacion();
				
				
					$medidas->insertarReparacion();
					$data = [
						'message' => 'Se registro exitosamente en reparaciones',
					
					];
					header('Content-Type: application/json');
					echo json_encode($data);
				
				break;

			case "7-audiom":
				require_once("../php/01-06-audiometria.php");
				$medidas = new audiometria(1);
				$medidas->setcedula($cedula);
				$ConsultaPruebas = $medidas->autenticarAudiometria();
				if (!$ConsultaPruebas) {
					echo "Se registro exitosamente";
					$medidas->insertarCita();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "10-partic":
				require_once("../php/04-solicitud_desarrollo.php");
				$atencion = new solicitud_desarrollo(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registro exitosamente";
				break;

			case "11-partic":
				require_once("../php/05-solicitud_encuentro.php");
				$atencion = new solicitud_encuentro(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registro exitosamente";
				break;
			case "0-aten-coo":
				require_once("../php/01-atenciones-estadales.php");
				$atencion = new AtencionesEstadales(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$consultaayuda = $atencion->autenticarAtencion();
				$data = [
					'message' => 'Se registro exitosamente',
					'others' => $consultaayuda??null
				];
				header('Content-Type: application/json');
				echo json_encode($data);
				$atencion->insertarAtencion();
				

				break;
		}
	} else {
		echo false;
	}
} else {


	/* Detalles personales */

	$beneficiario = new Discapacitados(1);
	$cedula = $_POST["cedula"];
	$cedulauser = $_POST["cedulauser"];
	$atencion_solicitada = $_POST["atencion"];

	$nombre = $_POST["nombre"];
	$apellido = $_POST["apellido"];

	$email = $_POST["email"];
	$telefono = $_POST["telefono"];
	$fecha_naci = $_POST["fecha_naci"];
	$edad = $_POST["edad"];
	$hijos = $_POST["hijos"];
	$civil = $_POST["civil"];
	$estado = $_POST["estado"];
	$municipio = $_POST["municipio"];
	$parroquia = $_POST["parroquia"];
	$discapacidad = $_POST["discapacidad"];

	$sexo = $_POST["sexo"];





	$cod_carnet = $_POST["carnet"];
	$registrado_por = $_POST["registrador"];
	$fecha_registro = $_POST["fecha_registro"];

	/* DIRECCION  */
	$direccion = $_POST["direccion"];
	$nacionalidad = $_POST["nacionalidad"];





	/* cuidador */
	$cuidador = $_POST["cuidador"];
	$cedula_cui = $_POST["cedula_cui"];

	/* Emprendimiento */
	$nombre_empre = $_POST["nombre_empre"];
	$rif_emp = $_POST["rif_emp"];
	$area_comerc = $_POST["area_comerc"];
	$banco = $_POST["banco"];

	/* institucionales */
	$bono = $_POST["bono"];







	$beneficiario->setcedula($cedula);

	$Consulta = $beneficiario->consultarDiscapacitados();

	if (!$Consulta) {

		$beneficiario->setcedula($cedula);
		$beneficiario->setnombre($nombre);
		$beneficiario->setapellido($apellido);
		$beneficiario->setemail($email);

		$beneficiario->settelefono($telefono);
		$beneficiario->setfecha_naci($fecha_naci);
		$beneficiario->setsexo($sexo);
		$beneficiario->setedad($edad);
		$beneficiario->sethijos($hijos);
		$beneficiario->setcivil($civil);
		$beneficiario->setestado($estado);
		$beneficiario->setmunicipio($municipio);
		$beneficiario->setparroquia($parroquia);
		$beneficiario->setdiscapacidad($discapacidad);
		$beneficiario->setatencion_solicitada($atencion_solicitada);
		$beneficiario->setcod_carnet($cod_carnet);
		$beneficiario->setregistrado_por($registrado_por);
		$beneficiario->setfecha_registro($fecha_registro);
		$beneficiario->setnacionalidad($nacionalidad);

		$beneficiario->insertarDiscapacitados();

		$detalles = new detalles_institucionales(1);

		$detalles->setcedula($cedula);
		$detalles->setproteccion_social($bono);
		$detalles->setdireccion($direccion);
		$detalles->insertardetalles();
		$detalles->insertardireccion(); //10/01/2024


		if ($nombre_empre and $rif_emp) {
			$emprendimiento = new detalles_emprendimiento(1);
			$emprendimiento->setcedula($cedula);
			$emprendimiento->setnombre_emprendimiento($nombre_empre);
			$emprendimiento->setrif_emprendimiento($rif_emp);
			$emprendimiento->setarea_comercial($area_comerc);
			$emprendimiento->setbanco($banco);
			$emprendimiento->insertardetalles();
		}



		if ($cedula_cui) {
			$cuid = new detalles_cuidador(1);
			$cuid->setcedula($cedula);
			$cuid->setnombre($cuidador);
			$cuid->setcedula_r($cedula_cui);
			$cuid->insertardetalles();
		}





		switch ($atencion_solicitada) {
			case "1-oac":
				require_once("../php/01-atenciones.php");
				$atencion = new Atenciones(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$consultaayuda = $atencion->autenticarAtencion();
			
				$atencion->insertarAtencion();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "0-aten-coo":
				require_once("../php/01-atenciones-estadales.php");
				$atencion = new AtencionesEstadales(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$atencion->insertarAtencion();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "2-ayudte":
				require_once("../php/01-01-ayudas_tec.php");
				$atencion = new Ayudas_tec(1);
				$atencion->setcedula($cedula);
				$atencion->insertarAyuda_tec();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "3-orypro":
				require_once("../php/01-02-cita_protesis.php");
				$cita = new citas_protesis(1);
				$cita->setcedula($cedula);
				$consultaayuda = $cita->autenticarProtesis();
				$cita->insertarCita();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "4-tomedi":
				require_once("../php/01-03-toma_medidas.php");
				$medidas = new toma_medidas(1);
				$medidas->setcedula($cedula);
				$medidas->insertarMedidas();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "5-pruebar":
				require_once("../php/01-04-pruebaArtificio.php");
				$medidas = new prueba_artificio(1);
				$medidas->setcedula($cedula);
				$medidas->insertarPrueba();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "6-repaart":
				require_once("../php/01-05-reparacionArtificio.php");
				$medidas = new raparacion_artificio(1);
				$medidas->setcedula($cedula);
				$medidas->insertarReparacion();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "0-aten-coo":
				require_once("../php/01-atenciones-estadales.php");
				$atencion = new AtencionesEstadales(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$atencion->insertarAtencion();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "7-audiom":
				require_once("../php/01-06-audiometria.php");
				$medidas = new audiometria(1);
				$medidas->setcedula($cedula);
				$ConsultaPruebas = $medidas->autenticarAudiometria();
				$medidas->insertarCita();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "10-partic":
				require_once("../php/04-solicitud_desarrollo.php");
				$atencion = new solicitud_desarrollo(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			case "11-partic":
				require_once("../php/05-solicitud_encuentro.php");
				$atencion = new solicitud_encuentro(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registró " . $nombre . " exitosamente";
				break;

			default:
				// Acción por defecto si ninguna de las condiciones coincide
				break;
		}
	} else {
		

		switch ($atencion_solicitada) {
			case "1-oac":
				require_once("../php/01-atenciones.php");
				$atencion = new Atenciones(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$consultaayuda = $atencion->autenticarAtencion();
				echo "Ya " . $nombre . " se encuentra registrado, se le cargara otra solicitud ";
				$atencion->insertarAtencion();
				
				break;

			case "0-aten-coo":
				require_once("../php/01-atenciones-estadales.php");
				$atencion = new AtencionesEstadales(1);
				$atencion->setcedula($cedula);
				$atencion->setasignado($cedulauser);
				$atencion->insertarAtencion();
				echo "Ya " . $nombre . " se encuentra registrado, se le cargara otra solicitud";
				break;

			case "2-ayudte":
				require_once("../php/01-01-ayudas_tec.php");
				$atencion = new Ayudas_tec(1);
				$atencion->setcedula($cedula);
				$consultaayuda = $atencion->autenticarAyuda();
				if (!$consultaayuda) {
					echo "Se registro a " . $nombre . " exitosamente";
					$atencion->insertarAyuda_tec();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "3-orypro":
				require_once("../php/01-02-cita_protesis.php");
				$cita = new citas_protesis(1);
				$cita->setcedula($cedula);
				$consultaayuda = $cita->autenticarProtesis();

				$cita->insertarCita();
				echo "Se registro a " . $nombre . " exitosamente";

				break;

			case "4-tomedi":
				require_once("../php/01-03-toma_medidas.php");
				$medidas = new toma_medidas(1);
				$medidas->setcedula($cedula);
				$consultamedidas = $medidas->autenticarMedidas();
				if (!$consultamedidas) {
					echo "Se registro a " . $nombre . " exitosamente";
					$medidas->insertarMedidas();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "5-pruebar":
				require_once("../php/01-04-pruebaArtificio.php");
				$artificio = $_POST["artificio"];
				$fecha_prueba = $_POST["fecha_prueba"];
				$medidas = new prueba_artificio(1);
				$medidas->setcedula($cedula);
				$medidas->setfecha_prueba($fecha_prueba);
				$medidas->setartificio_prueba($artificio);

				$ConsultaPruebas = $medidas->autenticarArtificio();
				if (!$ConsultaPruebas) {
					echo "Se registro a " . $nombre . " exitosamente";
					$medidas->insertarPrueba();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "6-repaart":
				require_once("../php/01-05-reparacionArtificio.php");
				$medidas = new raparacion_artificio(1);
				$medidas->setcedula($cedula);
				$ConsultaPruebas = $medidas->autenticarReparacion();
				if (!$ConsultaPruebas) {
					echo "Se registro a " . $nombre . " exitosamente";
					$medidas->insertarReparacion();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "7-audiom":
				require_once("../php/01-06-audiometria.php");
				$medidas = new audiometria(1);
				$medidas->setcedula($cedula);
				$ConsultaPruebas = $medidas->autenticarAudiometria();
				if (!$ConsultaPruebas) {
					echo "Se registro a " . $nombre . " exitosamente";
					$medidas->insertarCita();
				} else {
					echo "Ya este Beneficiario se registro en esta area";
				}
				break;

			case "10-partic":
				require_once("../php/04-solicitud_desarrollo.php");
				$atencion = new solicitud_desarrollo(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registro a " . $nombre . " exitosamente";
				break;

			case "11-partic":
				require_once("../php/05-solicitud_encuentro.php");
				$atencion = new solicitud_encuentro(1);
				$atencion->setcedula($cedula);
				$atencion->setsolicitud($atencion_solicitada);
				$atencion->insertarsolicitud();
				echo "Se registro a " . $nombre . " exitosamente";
				break;
		}
	}



	/* $municipio = $_POST["municipio"];
	$direccion = $_POST["direccion"]; */

	/* $cod_carnet = $_POST["carnet"];
	$tipoatenciona = $_POST["atencion"];
	

	$nombre_cuidador = $_POST["nombre-cuidador"];
	$cedula_cuidador = $_POST["cedula-cuidador"];
	

	$nombre_emprendimiento = $_POST["nombre-emprendimiento"];
	$area_comercial = $_POST["nombre-emprendimiento"]; */
}
