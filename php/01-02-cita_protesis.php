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
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_toma IS NULL");
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

			$stmt = $this->cnn->prepare("SELECT cita_ortesis_protesis.id, cita_ortesis_protesis.descripcion, cita_ortesis_protesis.artificio,beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,  cita_ortesis_protesis.laboratorio, cita_ortesis_protesis.fecha_toma
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_prueba IS NULL");
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
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_prueba IS NOT NULL and cita_ortesis_protesis.status IS NULL");
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
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_prueba IS NOT NULL and cita_ortesis_protesis.status IS NOT NULL");
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
				FROM beneficiario, cita_ortesis_protesis, tipoatencion 
				WHERE beneficiario.cedula = cita_ortesis_protesis.cedula and beneficiario.atencion_solicitada 
				= tipoatencion.id and cita_ortesis_protesis.fecha_toma IS NOT NULL");
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

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET  status = 'Caso cerrado'
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

			$stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET  fecha_prueba = :fecha_prueba, medidas = :medidas
				WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':fecha_prueba', $this->fecha_prueba);
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
}
