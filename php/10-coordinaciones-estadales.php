<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Coordinacion extends ManejadorBD
{
	/* ================================== */
	private $id;
	private $nombre_coordinacion;
	private $municipio;





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



	public function getmunicipio()
	{
		return $this->municipio;
	}
	public function setmunicipio($municipio)
	{
		$this->municipio = $municipio;
	}




	public function getnombre_coordinacion()
	{
		return $this->nombre_coordinacion;
	}
	public function setnombre_coordinacion($nombre_coordinacion)
	{
		$this->nombre_coordinacion = $nombre_coordinacion;
	}


	public function getid()
	{
		return $this->id;
	}
	public function setid($id)
	{
		$this->id = $id;
	}










	public function consultarCoordinaciones()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT id, nombre_coordinacion FROM `coordinaciones_estadales` WHERE 1');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
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

	public function consultarCoordinacionesXatenciones()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT coordinaciones_estadales.id,coordinaciones_estadales.nombre_coordinacion,usuario.coordinacion, count(atenciones_coordinaciones.cedula)as atenciones 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE `fecha_aten` is NOT NULL and
			
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id 
			GROUP by  coordinaciones_estadales.nombre_coordinacion');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
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
	public function consultarCoordinacionesXatencionesDADAS()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT coordinaciones_estadales.id,coordinaciones_estadales.nombre_coordinacion,usuario.coordinacion, count(atenciones_coordinaciones.cedula)as dadas 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE `fecha_aten` is NOT NULL and
			
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id AND
            coordinaciones_estadales.id = :id');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();

			// Devuelve los resultados obtenidos
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultarCoordinacionesXatencionesSINDAR()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT COUNT(atenciones_coordinaciones.cedula) as numero from atenciones_coordinaciones, coordinaciones_estadales, usuario 
			WHERE fecha_aten is null
			and usuario.coordinacion = coordinaciones_estadales.id and 
			atenciones_coordinaciones.asignado = usuario.cedula and 
			coordinaciones_estadales.id = :id');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();

			// Devuelve los resultados obtenidos
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultadeSolicitudes()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.atencion_solicitada, count(atenciones_coordinaciones.atencion_solicitada) as cantidad from atenciones_coordinaciones, coordinaciones_estadales, usuario 
			WHERE fecha_aten is null
			and usuario.coordinacion = coordinaciones_estadales.id and 
			atenciones_coordinaciones.asignado = usuario.cedula and 
			coordinaciones_estadales.id = :id
            GROUP BY atenciones_coordinaciones.atencion_solicitada");

			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
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



	public function graficasxatenciones()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT tipo_ayuda_tecnica.nombre_tipoayuda,count(atenciones_coordinaciones.atencion_recibida)as "Ayudas_dadas" 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales,tipo_ayuda_tecnica
			 WHERE
			 tipo_ayuda_tecnica.id = atenciones_coordinaciones.atencion_recibida and
			 atenciones_coordinaciones.atencion_brindada is not null and
			 `fecha_aten` is NOT NULL and
			coordinaciones_estadales.id = :id and
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id
			GROUP BY tipo_ayuda_tecnica.nombre_tipoayuda');

			// Asiganmos valores a los parametros
			$stmt->bindParam(':id', $this->id);
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
	public function graficasxdiscapacidad()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT 										
			discapacid_e.nombre_e as nombre_discapacidad,
			beneficiario.discapacidad,
			count(beneficiario.discapacidad)as discapacidad 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales, beneficiario, discapacid_e
			 WHERE 		
			 beneficiario.discapacidad = discapacid_e.id_e and
			`fecha_aten` is NOT NULL and
			atenciones_coordinaciones.cedula = beneficiario.cedula and
			coordinaciones_estadales.id = :id and
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id 
			GROUP BY beneficiario.discapacidad');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			/*  $stmt->bindParam(':id', $this->id); */
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
	public function graficasxsexo()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT 										
			beneficiario.sexo as sexos,
			count(beneficiario.sexo)as cantidades
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales, beneficiario, discapacid_e
			 WHERE 		
			 beneficiario.discapacidad = discapacid_e.id_e and
			`fecha_aten` is NOT NULL and
			atenciones_coordinaciones.cedula = beneficiario.cedula and
			coordinaciones_estadales.id = :id and
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id 
			GROUP BY beneficiario.sexo');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			/*  $stmt->bindParam(':id', $this->id); */
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

	public function graficasxtipoatencion()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT 										
			atencion_recibida.nombre,
			count(atenciones_coordinaciones.atencion_brindada)as Recibidas 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales, beneficiario, atencion_recibida
			 WHERE 		
			 atencion_recibida.id = atenciones_coordinaciones.atencion_brindada and
			`fecha_aten` is NOT NULL and
			atenciones_coordinaciones.cedula = beneficiario.cedula and
			coordinaciones_estadales.id = :id and
			atenciones_coordinaciones.por = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id 
			GROUP BY atencion_recibida.nombre');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->bindParam(':id', $this->id);
			/*  $stmt->bindParam(':id', $this->id); */
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



	public function consultarCoordinacion()
	{

		try {

			$stmt = $this->cnn->prepare('SELECT id, nombre_coordinacion FROM `coordinaciones_estadales` WHERE id = :id ');
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->bindParam(':id', $this->id);
			/*  $stmt->bindParam(':id', $this->id); */
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

	public function consultarTodasCitasDadas()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, 
                beneficiario.discapacidad, beneficiario.atencion_solicitada, audiometria.id, audiometria.fecha_cita
                 FROM beneficiario, audiometria WHERE beneficiario.cedula = audiometria.cedula  /* beneficiario.atencion_solicitada = '7-audiom' */ and audiometria.fecha_cita IS NOT NULL;");
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


	public function modificarCita()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE coordinaciones_estadales SET fecha_cita = :fecha_cita
                                             WHERE id = :id");

			// Asignamos valores a los parametros
			$stmt->bindParam(':id', $this->id);
			/*  $stmt->bindParam(':id', $this->id); */
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



	public function eliminaraudio()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM audiometria WHERE id = :id");

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


//SIN IMPLEMENTAR
	public function PDF_solicitudes($coordinacion){
		try {

			$stmt = $this->cnn->prepare("SELECT coordinaciones_estadales.nombre_coordinacion,atenciones_coordinaciones.atencion_solicitada, count(atenciones_coordinaciones.cedula)as cantidades 
			FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales WHERE `fecha_aten` is NULL and
			atenciones_coordinaciones.atencion_solicitada is not null and
			atenciones_coordinaciones.asignado = usuario.cedula AND
			usuario.coordinacion = coordinaciones_estadales.id and
            coordinaciones_estadales.id = :coordinacion
            GROUP BY atenciones_coordinaciones.atencion_solicitada;");

			$stmt->setFetchMode(PDO::FETCH_ASSOC); 
			// Asiganmos valores a los parametros
			$stmt->bindParam(':coordinacion', $coordinacion);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
}
