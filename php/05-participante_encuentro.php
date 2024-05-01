<?php
include_once("ManejadorBD.php");


class participante_encuentro extends ManejadorBD
{
	/* ================================== */
	private $cedula;
	private $encuentro;
	private $nombre;
	private $apellido;
	private $telefono;
	private $email;
	private $discapacidad;
	private $parroquia;
	private $edad;
	private $fecha_nacimiento;
	private $sexo;
	private $nacionalidad;

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

	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}



	public function getencuentro()
	{
		return $this->encuentro;
	}
	public function setencuentro($encuentro)
	{
		$this->encuentro = $encuentro;
	}

	public function setNombre($nombre)
	{
		$this->nombre = $nombre;
	}

	public function getNombre()
	{
		return $this->nombre;
	}

	// Setter and Getter for 'apellido'
	public function setApellido($apellido)
	{
		$this->apellido = $apellido;
	}

	public function getApellido()
	{
		return $this->apellido;
	}

	// Setter and Getter for 'telefono'
	public function setTelefono($telefono)
	{
		$this->telefono = $telefono;
	}

	public function getTelefono()
	{
		return $this->telefono;
	}

	// Setter and Getter for 'email'
	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getEmail()
	{
		return $this->email;
	}

	// Setter and Getter for 'discapacidad'
	public function setDiscapacidad($discapacidad)
	{
		$this->discapacidad = $discapacidad;
	}

	public function getDiscapacidad()
	{
		return $this->discapacidad;
	}

	// Setter and Getter for 'parroquia'
	public function setParroquia($parroquia)
	{
		$this->parroquia = $parroquia;
	}

	public function getParroquia()
	{
		return $this->parroquia;
	}

	// Setter and Getter for 'edad'
	public function setEdad($edad)
	{
		$this->edad = $edad;
	}

	public function getEdad()
	{
		return $this->edad;
	}

	// Setter and Getter for 'fecha_nacimiento'
	public function setFechaNacimiento($fecha_nacimiento)
	{
		$this->fecha_nacimiento = $fecha_nacimiento;
	}

	public function getFechaNacimiento()
	{
		return $this->fecha_nacimiento;
	}

	// Setter and Getter for 'sexo'
	public function setSexo($sexo)
	{
		$this->sexo = $sexo;
	}

	public function getSexo()
	{
		return $this->sexo;
	}

	// Setter and Getter for 'nacionalidad'
	public function setNacionalidad($nacionalidad)
	{
		$this->nacionalidad = $nacionalidad;
	}

	public function getNacionalidad()
	{
		return $this->nacionalidad;
	}







	public function insertarParticipante()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO participante_encuentro 
				(cedula, nombre, apellido, telefono, fecha_naci, edad,
				 sexo, nacionalidad, discapacidad, direccion, encuentro, email) 
				VALUES (:cedula, :nombre, :apellido,:telefono,:fecha_naci ,:edad, :sexo, :nacionalidad, :discapacidad, :direccion,:encuentro, :email)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':encuentro', $this->encuentro);
			$stmt->bindParam(':nombre',  $this->nombre);
			$stmt->bindParam(':apellido',  $this->apellido);
			$stmt->bindParam(':telefono',  $this->telefono);
			$stmt->bindParam(':fecha_naci', $this->fecha_nacimiento);
			$stmt->bindParam(':edad',  $this->edad);
			$stmt->bindParam(':sexo',  $this->sexo);
			$stmt->bindParam(':nacionalidad', $this->nacionalidad);
			$stmt->bindParam(':discapacidad',  $this->discapacidad);
			$stmt->bindParam(':direccion',  $this->parroquia);
			$stmt->bindParam(':email',  $this->email);


			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
		
			echo "1";
			// Devuelve los resultados obtenidos
			return "1"; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function autenticar()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM participante_encuentro WHERE cedula = :cedula AND encuentro = :encuentro");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':encuentro', $this->encuentro);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarSolicitud()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT solicitudes_desarrollo.id, beneficiario.nombre, beneficiario.apellido, 
                beneficiario.cedula, beneficiario.estado ,solicitudes_desarrollo.solicitud FROM 
                beneficiario, solicitudes_desarrollo where solicitudes_desarrollo.id = :id and beneficiario.cedula = solicitudes_desarrollo.cedula");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			/* $stmt->bindParam(':id', $this->id); */
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

	public function consultarTodosParticipantes()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT participante_encuentro.id, participante_encuentro.cedula, participante_encuentro.nombre,participante_encuentro.apellido,participante_encuentro.telefono,participante_encuentro.edad,participante_encuentro.nacionalidad, participante_encuentro.fecha_naci, participante_encuentro.edad, discapacid_e.nombre_e, participante_encuentro.sexo from participante_encuentro, discapacid_e where participante_encuentro.encuentro = :encuentro and participante_encuentro.discapacidad = discapacid_e.id_e;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			$stmt->bindParam(':encuentro', $this->encuentro);
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

	public function contarJornadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM taller WHERE numero_personas = :numero_personas");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			/* $stmt->bindParam(':numero_personas', $this->numero_personas); */
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

	/* Para ver cuales son las atenciones que no tiene fecha null (Para consultar todas la atenciones dadas) */
	public function consultarTodosAtencionesa()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones.numero_aten, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.estado,beneficiario.discapacidad, atenciones.atencion_recibida FROM atenciones, beneficiario WHERE beneficiario.cedula = atenciones.cedula and atenciones.fecha_aten IS NOT NULL;");
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

	public function contarTodasAtencionesa()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM `atenciones` WHERE fecha_aten IS NOT NULL");
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


	public function modificarAtenciones()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones SET fecha_aten = :fecha_aten, atencion_recibida = :atencion_recibida 
                                             WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			/* $stmt->bindParam(':numero_aten', $this->numero_aten);
                $stmt->bindParam(':fecha_aten', $this->fecha_aten);
                $stmt->bindParam(':atencion_recibida', $this->atencion_recibida); */

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



	public function eliminarDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM discapacitados WHERE numero_aten = :numero_aten");

			// Asiganmos valores a los parametros
			/* 	$stmt->bindParam(':numero_aten', $this->numero_aten); */
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
