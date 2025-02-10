<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class citas_protesis extends ManejadorBD
{
	/* ================================== */
	private $cedula;
	private $id;
	private $laboratorio;
	private $artificio;
	private $fecha_apertura;
	private $fecha_medidas;
	private $fecha_prueba;
	private $descripcion;
	private $medidas;





	private $cnn;
	/*===============================  */

	public function __construct($tipoConexion)
	{
		$this->cnn = parent::conectar($tipoConexion);
	}

	public function __destruct()
	{
		parent::cerrarConexion();
	}



	public function getdescripcion()
	{
		return $this->descripcion;
	}
	public function setdescripcion($descripcion)
	{
		$this->descripcion = $descripcion;
	}

	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}

	public function getartificio()
	{
		return $this->artificio;
	}
	public function setartificio($artificio)
	{
		$this->artificio = $artificio;
	}


	public function getfecha_medidas()
	{
		return $this->fecha_medidas;
	}
	public function setfecha_medidas($fecha_medidas)
	{
		$this->fecha_medidas = $fecha_medidas;
	}

	public function getfecha_prueba()
	{
		return $this->fecha_prueba;
	}
	public function setfecha_prueba($fecha_prueba)
	{
		$this->fecha_prueba = $fecha_prueba;
	}




	public function getfecha_apertura()
	{
		return $this->fecha_apertura;
	}
	public function setfecha_apertura($fecha_apertura)
	{
		$this->fecha_apertura = $fecha_apertura;
	}


	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		$this->id = $id;
	}



	public function getlaboratorio()
	{
		return $this->laboratorio;
	}
	public function setlaboratorio($laboratorio)
	{
		$this->laboratorio = $laboratorio;
	}


	public function getmedidas()
	{
		return $this->medidas;
	}
	public function setmedidas($medidas)
	{
		$this->medidas = $medidas;
	}




	public function insertarCita()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO `cita_ortesis_protesis`(cedula) VALUES (:cedula)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);

			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function autenticarProtesis()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM cita_ortesis_protesis WHERE cedula = :cedula ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarCita()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad, beneficiario.fecha_naci, beneficiario.edad, beneficiario.sexo, beneficiario.estado, beneficiario.municipio, beneficiario.parroquia, beneficiario.telefono, cita_ortesis_protesis.id FROM `cita_ortesis_protesis`, beneficiario WHERE beneficiario.cedula = cita_ortesis_protesis.cedula AND cita_ortesis_protesis.id = :id;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':id', $this->id);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	/* HISTORIA MEDICA */
	public function Modificar_al_cargar_HM()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET fecha_cita = :fecha_cita
				WHERE numero_aten = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':fecha_cita', $this->fecha_medidas);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultarTodasCitasSindar()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_cita
				FROM beneficiario, cita_ortesis_protesis 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and cita_ortesis_protesis.fecha_toma IS NULL");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarTodasCitasSindar_toma_medidas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, cita_ortesis_protesis.status, cita_ortesis_protesis.medidas,cita_ortesis_protesis.apto,cita_ortesis_protesis.descripcion, cita_ortesis_protesis.artificio,beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_toma
				FROM beneficiario, cita_ortesis_protesis 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and cita_ortesis_protesis.fecha_toma IS NOT NULL and cita_ortesis_protesis.fecha_prueba IS NULL");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarTodasCitasSindar_prueba()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, cita_ortesis_protesis.descripcion, cita_ortesis_protesis.artificio,beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_prueba, 
			cita_ortesis_protesis.medidas, cita_ortesis_protesis.descripcion
				FROM beneficiario, cita_ortesis_protesis 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula  and cita_ortesis_protesis.fecha_prueba IS NOT NULL and cita_ortesis_protesis.status = 'En prueba' ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarTodasPruebaDadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, cita_ortesis_protesis.descripcion, cita_ortesis_protesis.status, cita_ortesis_protesis.artificio,beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_prueba, 
			cita_ortesis_protesis.medidas, cita_ortesis_protesis.descripcion
				FROM beneficiario, cita_ortesis_protesis 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and cita_ortesis_protesis.fecha_prueba IS NOT NULL and cita_ortesis_protesis.status ='Caso cerrado'");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarTodasCitasdadas_toma_medidas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, cita_ortesis_protesis.medidas,cita_ortesis_protesis.descripcion, cita_ortesis_protesis.artificio,beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_toma
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_prueba IS NOT NULL");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	/* HISTORIA MEDICA ---------------------------*/

	public function consultarTodasCitasDadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_cita
				FROM beneficiario, cita_ortesis_protesis 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and cita_ortesis_protesis.fecha_toma IS NOT NULL");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}


	public function consultarTodasAyudas_tecRecibidas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, atenciones.numero_aten, ayudas_tec.id, ayudas_tec.tipo_ayuda_tec FROM `ayudas_tec`, beneficiario, atenciones WHERE ayudas_tec.numero_aten = atenciones.numero_aten and beneficiario.cedula = atenciones.cedula AND atenciones.atencion_recibida = '-ayudatec' AND ayudas_tec.tipo_ayuda_tec IS NOT NULL;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}


	/* 	public function modificarCita(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET laboratorio = :laboratorio, fecha_cita = :fecha
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':laboratorio', $this->laboratorio);
				$stmt->bindParam(':fecha', $this->fecha_medidas);
                $stmt->bindParam(':id', $this->id);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		} */



	public function eliminarCita()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM cita_ortesis_protesis WHERE id = :id");

			// Asiganmos valores a los parametros
			$stmt->bindParam(':id', $this->id);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function modificarCita_toma_medidas()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET descripcion = :descripcion, fecha_toma = :fecha_toma, artificio = :artificio
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':fecha_toma', $this->fecha_medidas);
			$stmt->bindParam(':artificio', $this->artificio);
			$stmt->bindParam(':descripcion', $this->descripcion);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function finalizarProceso()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET status = 'Caso cerrado'
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function modificarCita_prueba()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET  medidas = :medidas, status ='Medidas tomadas'
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':medidas', $this->medidas);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function obtenerLaboratorios(){
		try {

			$stmt = $this->cnn->prepare("SELECT laboratorios.id, laboratorios.nombre_lab, estados.nombre_estado, laboratorios.correo, laboratorios.telefono 
			FROM `laboratorios`, estados
			WHERE laboratorios.estado = estados.id_estados ");
			// Especificamos el fetch mode antes de llamar a fetch()
			/* $stmt->bindParam(':id', $this->id); */
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function verLaboratorio(){
		try {

			$stmt = $this->cnn->prepare("SELECT laboratorios.id, laboratorios.nombre_lab, estados.nombre_estado, laboratorios.correo, laboratorios.telefono 
			FROM `laboratorios`, estados
			WHERE laboratorios.estado = estados.id_estados and laboratorios.id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function verAtencionLaboratorio($id){
		try {

			$stmt = $this->cnn->prepare("SELECT a.id, a.cedula,a.fecha_registro, a.fecha_asistencia, b.sexo, b.edad, b.fecha_naci, b.telefono, b.nacionalidad, b.telefono,
			 a.expediente ,b.nombre, b.apellido, s.nombre as nombre_servicio 
			FROM `atenciones_laboratorios`as a, beneficiario as b, servicios_infraestructura as s 
			WHERE b.cedula = a.cedula and s.id = a.tipo and a.id = :id
			ORDER BY `a`.`id` ASC");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $id);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function insertarAtencionLaboratorio($cedula, $laboratorio,$tipo, $fecha_registro, $fecha_asistencia, $expediente, $tipo_artificio, $ortesis, $protesis){
		try {

			$stmt = $this->cnn->prepare("INSERT INTO `atenciones_laboratorios`(`cedula`, `laboratorio`, `tipo`, fecha_registro, fecha_asistencia, expediente, tipo_artificio, artificio_ortesis, artificio_protesis) 
			VALUES (:cedula, :laboratorio, :tipo, :fecha_registro, :fecha_asistencia, :expediente, :tipo_artificio, :ortesis, :protesis)");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':laboratorio', $laboratorio);
			$stmt->bindParam(':tipo', $tipo);
			$stmt->bindParam(':fecha_registro', $fecha_registro);
			$stmt->bindParam(':fecha_asistencia', $fecha_asistencia);
			$stmt->bindParam(':expediente', $expediente);

			$stmt->bindParam(':tipo_artificio', $tipo_artificio);
			$stmt->bindParam(':ortesis', $ortesis);
			$stmt->bindParam(':protesis', $protesis);
		

			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarAtencionesLaboratorio($laboratorio){
		try {

			$stmt = $this->cnn->prepare("SELECT a.id, a.cedula,a.fecha_registro, a.fecha_asistencia, a.expediente ,b.nombre, b.apellido, s.nombre as nombre_servicio FROM `atenciones_laboratorios`as a, beneficiario as b, servicios_infraestructura as s 
			WHERE b.cedula = a.cedula and s.id = a.tipo and laboratorio = :laboratorio
			ORDER BY `a`.`id` ASC");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':laboratorio',$laboratorio);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function eliminarAtencionLaboratorio($id){
		try {

			$stmt = $this->cnn->prepare("DELETE FROM atenciones_laboratorios WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id',$id);
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
					
	public function modificarRegistroLaboratorio($id, $cedula, $servicios, $fecha_registro, $fecha_asistencia, $expediente){
		try {

			$stmt = $this->cnn->prepare("UPDATE `atenciones_laboratorios` 
			SET 
			`cedula`= :cedula,
			`tipo`= :tipo,
			`fecha_asistencia`= :fecha_asistencia,`fecha_registro`= :fecha_registro,
			`expediente`= :expediente WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id',$id);
			$stmt->bindParam(':cedula',$cedula);
			$stmt->bindParam(':tipo', $servicios);
			$stmt->bindParam(':fecha_registro',$fecha_registro);
			$stmt->bindParam(':fecha_asistencia',$fecha_asistencia);
			$stmt->bindParam(':expediente',$expediente);
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function obtenerProtesis(){
		try {

			$stmt = $this->cnn->prepare("SELECT `id`, `nombre` FROM `protesis` WHERE 1");
			// Especificamos el fetch mode antes de llamar a fetch()
			
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function obtenerOrtesis(){
		try {

			$stmt = $this->cnn->prepare("SELECT `id`, `nombre` FROM `ortesis` WHERE 1");
			// Especificamos el fetch mode antes de llamar a fetch()
			
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function evaluacion($apto)
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET  apto = :apto
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':apto', $apto);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function enviar_a_prueba($fecha)
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET fecha_prueba = :fecha, status = 'En prueba'
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':fecha', $fecha);
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

}
