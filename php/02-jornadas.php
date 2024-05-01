<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Jornadas extends ManejadorBD
{
	/* ================================== */
	private $estado;
	private $municipio;
	private $parroquia;
	private $numero_personas;
	private $numero_jornadas;
	private $id;
	private $gerencia;

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

	public function getestado()
	{
		return $this->estado;
	}
	public function setestado($estado)
	{
		$this->estado = $estado;
	}


	public function getnumero_jornadas()
	{
		return $this->numero_jornadas;
	}
	public function setnumero_jornadas($numero_jornadas)
	{
		$this->numero_jornadas = $numero_jornadas;
	}


	public function getgerencia()
	{
		return $this->gerencia;
	}
	public function setgerencia($gerencia)
	{
		$this->gerencia = $gerencia;
	}


	public function getmunicipio()
	{
		return $this->municipio;
	}
	public function setmunicipio($municipio)
	{
		$this->municipio = $municipio;
	}

	public function getparroquia()
	{
		return $this->parroquia;
	}
	public function setparroquia($parroquia)
	{
		$this->parroquia = $parroquia;
	}



	public function getnumero_personas()
	{
		return $this->numero_personas;
	}
	public function setnumero_personas($numero_personas)
	{
		$this->numero_personas = $numero_personas;
	}


	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		$this->id = $id;
	}


	/*  public function getdireccion()
		{
		    return $this->direccion;
		}
		public function setdireccion ($direccion)
		{
		    $this->direccion = $direccion;		    
		}
 */


	/* 	public function gettipoasistencia()
		{
		    return $this->tipoasistencia;
		}
		public function settipoasistencia($tipoasistencia)
		{
		    $this->tipoasistencia = $tipoasistencia;		    
		}
 */



	public function insertarJornada()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO jornada (estado, municipio, parroquia, numero_personas, gerencia) 
											VALUES (:estado, :municipio,:parroquia, :numero_personas, :gerencia)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':estado', $this->estado);
			$stmt->bindParam(':municipio', $this->municipio);
			$stmt->bindParam(':parroquia', $this->parroquia);
			$stmt->bindParam(':numero_personas', $this->numero_personas);
			$stmt->bindParam(':gerencia', $this->gerencia);

			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>";

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function autenticarAdministrador()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM dispacitados WHERE cedula = :cedula AND passwordd = :passwordd");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			/* $stmt->bindParam(':cedula', $this->cedula); */
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>";

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarJornadas()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT jornada.id, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, jornada.numero_personas FROM `jornada`, municipios, estados, parroquia WHERE
				estados.id_estados = jornada.estado and municipios.id_municipios = jornada.municipio and parroquia.id = jornada.parroquia and jornada.id = :id;");
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

	public function consultarTodosJornadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT jornada.id, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, jornada.numero_personas, jornada.gerencia FROM `jornada`, municipios, estados, parroquia WHERE
				 estados.id_estados = jornada.estado and municipios.id_municipios = jornada.municipio and parroquia.id = jornada.parroquia");
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

	public function consultarTodosJornadasPorGerencia()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT gerencia.Nombre, COUNT(jornada.id) as cantidad_jornadas FROM `jornada`, gerencia WHERE 
				jornada.gerencia = gerencia.id and jornada.gerencia = :id GROUP BY gerencia.Nombre");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			$stmt->bindParam(':id', $this->id);
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

			$stmt = $this->cnn->prepare("SELECT * FROM jornada WHERE numero_personas = :numero_personas");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_personas', $this->numero_personas);
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


	public function PersonasJornadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT 
			personas_jornadas.id,
				personas_jornadas.cedula,
			personas_jornadas.nombre,
				personas_jornadas.apellido,
					personas_jornadas.discapacidad,
						personas_jornadas.fecha_jaten,
							personas_jornadas.numero_jornada,
			tipo_ayuda_tecnica.nombre_tipoayuda
		FROM 
			personas_jornadas
		JOIN 
			tipo_ayuda_tecnica ON personas_jornadas.ayuda_tecnica = tipo_ayuda_tecnica.id
		WHERE 
			personas_jornadas.numero_jornada =:numero_jornadas");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_jornadas', $this->numero_jornadas);
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
	public function AyudasTecnicasPorJornadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT tipo_ayuda_tecnica.nombre_tipoayuda, 
				COUNT(personas_jornadas.ayuda_tecnica) AS cantidad
			  FROM personas_jornadas
			  INNER JOIN tipo_ayuda_tecnica ON personas_jornadas.ayuda_tecnica = tipo_ayuda_tecnica.id
			  WHERE numero_jornada = :numero_jornadas GROUP BY tipo_ayuda_tecnica.nombre_tipoayuda;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_jornadas', $this->numero_jornadas);
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





	public function eliminarjornada()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM jornada WHERE id = :id");

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
