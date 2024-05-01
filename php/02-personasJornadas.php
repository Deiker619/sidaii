<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class personasJornadas extends ManejadorBD
{
	/* ================================== */
	private $nombre;
	private $apellido;
	/*       private $telefono; */
	private $cedula;
	private $estado;
	private $discapacidad;
	private $ayuda_tecnica;
	private $numero_jornada;
	private $fecha_jaten;
	private $id;





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

	public function getnombre()
	{
		return $this->nombre;
	}
	public function setnombre($nombre)
	{
		$this->nombre = $nombre;
	}


	public function getapellido()
	{
		return $this->apellido;
	}
	public function setapellido($apellido)
	{
		$this->apellido = $apellido;
	}


	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}

	public function getnumero_jornada()
	{
		return $this->numero_jornada;
	}
	public function setnumero_jornada($numero_jornada)
	{
		$this->numero_jornada = $numero_jornada;
	}

	public function getdiscapacidad()
	{
		return $this->discapacidad;
	}
	public function setdiscapacidad($discapacidad)
	{
		$this->discapacidad = $discapacidad;
	}

	public function getfecha_jaten()
	{
		return $this->fecha_jaten;
	}
	public function setfecha_jaten($fecha_jaten)
	{
		$this->fecha_jaten = $fecha_jaten;
	}


	public function getayuda_tecnica()
	{
		return $this->ayuda_tecnica;
	}
	public function setayuda_tecnica($ayuda_tecnica)
	{
		$this->ayuda_tecnica = $ayuda_tecnica;
	}

	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		$this->id = $id;
	}




	public function insertarPersonasJornada()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO personas_jornadas (cedula, nombre, apellido, discapacidad, ayuda_tecnica, numero_jornada, fecha_jaten)
											VALUES (:cedula, :nombre, :apellido, :discapacidad, :ayuda_tecnica, :numero_jornada, :fecha_jaten)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':apellido', $this->apellido);
			$stmt->bindParam(':discapacidad', $this->discapacidad);
			$stmt->bindParam(':ayuda_tecnica', $this->ayuda_tecnica);
			$stmt->bindParam(':numero_jornada', $this->numero_jornada);
			$stmt->bindParam(':fecha_jaten', $this->fecha_jaten);
			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function autenticarAyuda()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT cedula, max(fecha_jaten), ayuda_tecnica FROM `personas_jornadas` WHERE cedula = :cedula  and numero_jornada = :numero_jornada/* and ayuda_tecnica = :ayuda_tecnica */");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':numero_jornada', $this->numero_jornada);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function calculodeayuda()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT cedula, max(fecha_jaten) as fecha_jaten, ayuda_tecnica FROM `personas_jornadas` WHERE cedula = :cedula  and ayuda_tecnica = :ayuda_tecnica ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':ayuda_tecnica', $this->ayuda_tecnica);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarPersonasJornadas()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM personas_jornadas WHERE cedula = :cedula");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>";

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultarPersonasporJornada()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM personas_jornadas WHERE numero_jornada = :numero_jornada");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_jornada', $this->numero_jornada);
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

	public function consultarTodosPersonasJornadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM personas_jornadas WHERE numero_jornada = :numero_jornada");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_jornada', $this->numero_jornada);
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


	public function ConsultaPersona()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM personas_jornadas WHERE numero_jornada = :numero_jornada and cedula = :cedula");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_jornada', $this->numero_jornada);
			$stmt->bindParam(':cedula', $this->cedula);
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
	public function modificarDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE discapacitados SET nombre = :nombre, email = :email,
                                            telefono = :telefono, cedula = :cedula,  cod_carnet = :cod_carnet, direccion = :direccion, atencion_solicitada = :tipoasistencia, estado = :estado, dispacidad = :discapacidad  WHERE cedula = :cedula");

			// Asignamos valores a los parametros
			/* $stmt->bindParam(':nombre', $this->nombre);
                $stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':cod_carnet', $this->cod_carnet);
				$stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':atencion_solicitada', $this->atencion_solicitada);
				$stmt->bindParam(':estado', $this->estado);
                $stmt->bindParam(':discapacidad', $this->discapacidad); */

			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>";

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}



	public function eliminarPersonaJornada()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM personas_jornadas WHERE id = :id");

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
}
