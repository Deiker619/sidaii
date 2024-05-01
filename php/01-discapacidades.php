<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Discapacidad extends ManejadorBD
{
	/* ================================== */
	private $nombre_discapacidad;
	private $id_disca;
	




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
		return $this->nombre_discapacidad;
	}
	public function setnombre($nombre_discapacidad)
	{
		$this->nombre_discapacidad = $nombre_discapacidad;
	}


	public function getapellido()
	{
		return $this->id_disca;
	}
	public function setapellido($id_disca)
	{
		$this->id_disca = $id_disca;
	}



	


	

	public function autenticarAdministrador()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM dispacitados WHERE cedula = :cedula AND passwordd = :passwordd");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->id_disca);
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
	public function consultarDiscapacidades()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT nombre_discapacidad, id_disca FROM discapacid ORDER BY `id_disca` ASC");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
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




	



	public function consultarTodosDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cedula, nombre, apellido, estado, discapacidad FROM `beneficiario` WHERE 1");
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
	/* public function modificarDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE discapacitados SET nombre = :nombre, email = :email,
                                            telefono = :telefono, cedula = :cedula,  cod_carnet = :cod_carnet, direccion = :direccion, atencion_solicitada = :tipoasistencia, estado = :estado, dispacidad = :discapacidad  WHERE cedula = :cedula");

			// Asignamos valores a los parametros
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':cod_carnet', $this->cod_carnet);
			$stmt->bindParam(':direccion', $this->direccion);
			$stmt->bindParam(':atencion_solicitada', $this->atencion_solicitada);
			$stmt->bindParam(':estado', $this->estado);
			$stmt->bindParam(':discapacidad', $this->discapacidad);

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
	}*/



	public function eliminarDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM beneficiario WHERE cedula = :cedula");

			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->id_disca);
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


	/* CODIGO DE PRUEBA */

	





	


	
}
