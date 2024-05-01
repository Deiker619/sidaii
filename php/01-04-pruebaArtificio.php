<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class prueba_artificio extends ManejadorBD
{
	/* ================================== */
	private $cedula;
	private $id;
	private $fecha_prueba;
	private $pruebas;
	private $artificio_prueba;
	private $statu;
	/* private $cedula;
        private $fecha_aten;
        private $atencion_recibida ; */






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


	public function getstatu()
	{
		return $this->statu;
	}
	public function setstatu($statu)
	{
		$this->statu = $statu;
	}



	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}



	public function getpruebas()
	{
		return $this->pruebas;
	}
	public function setpruebas($pruebas)
	{
		$this->pruebas = $pruebas;
	}


	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		$this->id = $id;
	}



	public function getfecha_prueba()
	{
		return $this->fecha_prueba;
	}
	public function setfecha_prueba($fecha_prueba)
	{
		$this->fecha_prueba = $fecha_prueba;
	}


	public function getartificio_prueba()
	{
		return $this->artificio_prueba;
	}
	public function setartificio_prueba($artificio_prueba)
	{
		$this->artificio_prueba = $artificio_prueba;
	}





	public function insertarPrueba()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO `prueba_artificios`(cedula, fecha_pruebas, artificio_prueba) 
				VALUES (:cedula, :fecha_pruebas, :artificio_prueba)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':fecha_pruebas', $this->fecha_prueba);
			$stmt->bindParam(':artificio_prueba', $this->artificio_prueba);


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

	public function autenticarArtificio()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM prueba_artificios WHERE cedula = :cedula ");
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
	public function consultarPruebas()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad, beneficiario.atencion_solicitada,
				 prueba_artificios.id, prueba_artificios.pruebas, prueba_artificios.artificio_prueba, prueba_artificios.fecha_pruebas FROM `prueba_artificios`, beneficiario WHERE beneficiario.cedula = prueba_artificios.cedula 
				AND prueba_artificios.id = :id;");
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

	public function consultarTodasPruebasSindar()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, prueba_artificios.id, artificios.nombre_artificio, prueba_artificios.fecha_pruebas, prueba_artificios.statu FROM beneficiario, prueba_artificios, artificios WHERE beneficiario.cedula = prueba_artificios.cedula AND prueba_artificios.pruebas IS NULL and prueba_artificios.artificio_prueba = artificios.id;");
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

	public function consultarTodasPruebasDadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, discapacid.nombre_discapacidad , prueba_artificios.id,artificios.nombre_artificio, prueba_artificios.pruebas FROM beneficiario, discapacid ,prueba_artificios, artificios WHERE beneficiario.cedula = prueba_artificios.cedula AND beneficiario.discapacidad = discapacid.id_disca and artificios.id = prueba_artificios.artificio_prueba and prueba_artificios.pruebas IS NOT NULL;;");
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


	public function modificarPruebas()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE prueba_artificios SET pruebas = :pruebas
                                             WHERE id = :id");
			// Asignamos valores a los parametros
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':pruebas', $this->pruebas);

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


	public function reasignarPruebas()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE prueba_artificios SET fecha_pruebas = :fecha_pruebas, statu = :statu
                                             WHERE id = :id");
			// Asignamos valores a los parametros
			$stmt->bindParam(':id', $this->id);
			$stmt->bindParam(':fecha_pruebas', $this->fecha_prueba);
			$stmt->bindParam(':statu', $this->statu);

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
			/* $stmt->bindParam(':numero_aten', $this->numero_aten); */
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
