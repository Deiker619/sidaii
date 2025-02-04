<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class AtencionesEstadales extends ManejadorBD
{
	/* ================================== */
	private $numero_aten;
	private $cedula;
	private $fecha_aten;
	private $statu;
	private $atencion_recibida;
	private $atencion_brindada;
	private $atencion_solicitada;
	private $por;
	private $asignado;
	private$coordinacion;
	private $urgencia;






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


	public function geturgencia()
	{
		return $this->urgencia;
	}
	public function seturgencia($urgencia)
	{
		$this->urgencia = $urgencia;
	}

	public function getpor()
	{
		return $this->por;
	}
	public function setpor($por)
	{
		$this->por = $por;
	}

	public function getasignado()
		{
			return $this->asignado;
		}
		public function setasignado($asignado)
		{
			$this->asignado = $asignado;
		}

	public function getnumero_aten()
	{
		return $this->numero_aten;
	}
	public function setnumero_aten($numero_aten)
	{
		$this->numero_aten = $numero_aten;
	}


	public function getfecha_aten()
	{
		return $this->fecha_aten;
	}
	public function setfecha_aten($fecha_aten)
	{
		$this->fecha_aten = $fecha_aten;
	}


	public function getatencion_recibida()
	{
		return $this->atencion_recibida;
	}
	public function setatencion_recibida($atencion_recibida)
	{
		$this->atencion_recibida = $atencion_recibida;
	}

	public function getatencion_solicitada()
		{
			return $this->atencion_solicitada;
		}
		public function setatencion_solicitada($atencion_solicitada)
		{
			$this->atencion_solicitada = $atencion_solicitada;
		}


	
	public function getatencion_brindada()
	{
		return $this->atencion_brindada;
	}
	public function setatencion_brindada($atencion_brindada)
	{
		$this->atencion_brindada = $atencion_brindada;
	}

	public function getcoordinacion()
	{
		return $this->coordinacion;
	}
	public function setcoordinacion($coordinacion)
	{
		$this->coordinacion = $coordinacion;
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



	public function insertarAtencion()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO atenciones_coordinaciones (cedula, asignado) 
											VALUES (:cedula, :asignado)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':asignado', $this->asignado);

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


	public function insertarStatu()
	{
		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones_coordinaciones SET statu = :statu WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			$stmt->bindParam(':numero_aten', $this->numero_aten);
			$stmt->bindParam(':statu', $this->statu);


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

	public function autenticarAtencion()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM atenciones_coordinaciones WHERE cedula = :cedula
								and atencion_solicitada is not null
								 ORDER BY numero_aten DESC 
										LIMIT 1;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
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
	public function consultarAtenciones()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT  numero_aten,  beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.estado,beneficiario.discapacidad, atenciones_coordinaciones.atencion_solicitada, atenciones_coordinaciones.informe FROM atenciones_coordinaciones, beneficiario WHERE numero_aten = :numero_aten and beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten IS NULL;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_aten', $this->numero_aten);
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

	/* ====================================PARA CONSULTAR TODAS LAS ATENCIONES QUE NO SE LES HA DADO ATENCION, LISTAS PARA RECIBIR */

	
public function consultarTodosAtenciones()
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare('SELECT atenciones_coordinaciones.numero_aten,atenciones_coordinaciones.urgencia,atenciones_coordinaciones.atencion_solicitada,usuario.nombre, atenciones_coordinaciones.numero_aten, beneficiario.cedula, beneficiario.nombre,beneficiario.email, beneficiario.apellido, estados.nombre_estado, discapacid_e.nombre_e,  atenciones_coordinaciones.statu, coordinaciones_estadales.nombre_coordinacion, atenciones_coordinaciones.informe
			FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e,  usuario, coordinaciones_estadales WHERE
			
			usuario.cedula = atenciones_coordinaciones.asignado and
			usuario.coordinacion =  :coordinacion and 
            usuario.coordinacion = coordinaciones_estadales.id and
			beneficiario.cedula = atenciones_coordinaciones.cedula and 
			beneficiario.estado = estados.id_estados and 
			beneficiario.discapacidad = discapacid_e.id_e and
			atenciones_coordinaciones.fecha_aten IS NULL;');
			$stmt->bindParam(':coordinacion', $this->coordinacion);
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



	public function consultarTodosAtencionesAdmin() //consulta para administradores
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare('SELECT atenciones_coordinaciones.numero_aten, atenciones_coordinaciones.urgencia ,atenciones_coordinaciones.atencion_solicitada, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.email, estados.nombre_estado, discapacid_e.nombre_e, atenciones_coordinaciones.statu, coordinaciones_estadales.nombre_coordinacion
			,atenciones_coordinaciones.informe FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e, usuario, coordinaciones_estadales WHERE
			atenciones_coordinaciones.asignado = usuario.cedula and 
            usuario.coordinacion = coordinaciones_estadales.id and
			beneficiario.cedula = atenciones_coordinaciones.cedula and 
			beneficiario.estado = estados.id_estados and 
			beneficiario.discapacidad = discapacid_e.id_e and

			atenciones_coordinaciones.fecha_aten IS NULL;');
			
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

	public function CalculoeAtenciones()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.atencion_recibida, max(atenciones_coordinaciones.fecha_aten) as fecha_aten, coordinaciones_estadales.nombre_coordinacion  FROM `atenciones_coordinaciones`, usuario, coordinaciones_estadales
			WHERE
			atenciones_coordinaciones.cedula = :cedula and 
			atenciones_coordinaciones.atencion_recibida = :atencion_recibida AND
			atenciones_coordinaciones.por = usuario.cedula and 
			usuario.coordinacion = coordinaciones_estadales.id ");

			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':atencion_recibida', $this->atencion_recibida);
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
	/* ================================================PARA CONTAR TODAS LAS ATENCIONES DADAS CON ATRBUTOS */
	public function consultarTodosAtencionesa()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.numero_aten,
			beneficiario.cedula,
			beneficiario.nombre,
			beneficiario.apellido,
			estados.nombre_estado,
			discapacid_e.nombre_e,
			 CASE WHEN atenciones_coordinaciones.atencion_recibida IS NOT NULL THEN
				(SELECT tipo_ayuda_tecnica.nombre_tipoayuda
				 FROM tipo_ayuda_tecnica
				 WHERE atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id)
			END AS nombre_ayuda,
		  
			atenciones_coordinaciones.atencion_solicitada,
			atenciones_coordinaciones.atencion_brindada,
			atenciones_coordinaciones.informe
			FROM atenciones_coordinaciones
			INNER JOIN beneficiario ON beneficiario.cedula = atenciones_coordinaciones.cedula
			INNER JOIN estados ON beneficiario.estado = estados.id_estados
			INNER JOIN discapacid_e ON beneficiario.discapacidad = discapacid_e.id_e
			WHERE atenciones_coordinaciones.fecha_aten IS NOT NULL;");
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

	public function consultarTodosAtencionesaPOR() /* 22/8/2023     */
			{

				try {

					$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.numero_aten,
					beneficiario.cedula,
					beneficiario.nombre,
					beneficiario.apellido,
					estados.nombre_estado,
					discapacid_e.nombre_e,
					 CASE WHEN atenciones_coordinaciones.atencion_recibida IS NOT NULL THEN
						(SELECT tipo_ayuda_tecnica.nombre_tipoayuda
						 FROM tipo_ayuda_tecnica
						 WHERE atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id)
					END AS nombre_ayuda,
				  
					atenciones_coordinaciones.atencion_solicitada,
					atenciones_coordinaciones.atencion_brindada,
					atenciones_coordinaciones.informe
					FROM atenciones_coordinaciones
					INNER JOIN beneficiario ON beneficiario.cedula = atenciones_coordinaciones.cedula
					INNER JOIN estados ON beneficiario.estado = estados.id_estados
					INNER JOIN usuario ON atenciones_coordinaciones.por = usuario.cedula
					INNER JOIN discapacid_e ON beneficiario.discapacidad = discapacid_e.id_e
					WHERE atenciones_coordinaciones.fecha_aten IS NOT NULL
					AND
					usuario.coordinacion = :coordinacion;
		 ");
					// Especificamos el fetch mode antes de llamar a fetch()
					$stmt->bindParam(':coordinacion', $this->coordinacion);
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

	/* ================================================PARA CONTAR TODAS LAS ATENCIONES DADAS */

	public function contarTodasAtencionesa()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM `atenciones_coordinaciones` WHERE fecha_aten IS NOT NULL");
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



	public function atencionesDadas_por_estado()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT estados.nombre_estado, COUNT(beneficiario.estado) as numero FROM `atenciones`, beneficiario, estados WHERE beneficiario.cedula = atenciones.cedula and atenciones.fecha_aten !='' 
				AND beneficiario.estado = estados.id_estados GROUP BY beneficiario.estado;");
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


	public function atencionesDadas_por_discapacidad()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT discapacid.nombre_discapacidad,COUNT(beneficiario.discapacidad) as total FROM `atenciones`, beneficiario,discapacid WHERE 
				 beneficiario.cedula = atenciones.cedula and fecha_aten IS NOT NULL 
				and beneficiario.discapacidad = discapacid.id_disca GROUP BY beneficiario.discapacidad");
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

	public function atencionesDadas_por_mes()
	{

		try {

			$stmt = $this->cnn->prepare(" SELECT MONTH(fecha_aten) as Mes, COUNT(fecha_aten) as Total FROM `atenciones` WHERE fecha_aten IS not null GROUP BY MONTH (fecha_aten)");
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


	public function consultarTodosAtencionesPorStatus()
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.statu,COUNT(atenciones_coordinaciones.statu) as cantidades FROM `atenciones_coordinaciones` WHERE 1 GROUP by atenciones_coordinaciones.statu");
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

	/* =============================ORTESIS Y PROTESIS======================== */



	public function consultarTodasOrtesisProtesis()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, atenciones.numero_aten,atenciones.atencion_recibida FROM beneficiario, atenciones WHERE beneficiario.cedula = atenciones.cedula AND atenciones.atencion_recibida = '-orte' OR atenciones.atencion_recibida = '-prote' GROUP BY atencion_recibida");
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




	/* ============================= _FINAL DE ORTESIS Y PROTESIS_ ======================== */




	public function modificarAtenciones()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones_coordinaciones SET fecha_aten = :fecha_aten, atencion_recibida = :atencion_recibida, atencion_brindada = :atencion_brindada,  por = :por, statu = 'Atendido'
                                             WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			$stmt->bindParam(':numero_aten', $this->numero_aten);
			$stmt->bindParam(':fecha_aten', $this->fecha_aten);
			$stmt->bindParam(':atencion_recibida', $this->atencion_recibida);
			$stmt->bindParam(':atencion_brindada', $this->atencion_brindada);
			$stmt->bindParam(':por', $this->por);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
		/* 	echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>"; */

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function carga_solicitud()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones_coordinaciones SET atencion_solicitada = :atencion_solicitada,
											urgencia = :urgencia
											WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			$stmt->bindParam(':atencion_solicitada', $this->atencion_solicitada);
			$stmt->bindParam(':numero_aten', $this->numero_aten);
			$stmt->bindParam(':urgencia', $this->urgencia);

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



	public function eliminarAtencion()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM atenciones_coordinaciones WHERE numero_aten = :numero_aten");

			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_aten', $this->numero_aten);
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

	public function consultadeSolicitudes()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT `atencion_solicitada`, COUNT(atencion_solicitada) as cantidad FROM `atenciones` WHERE `atencion_solicitada`is NOT null and atencion_recibida is null GROUP by atencion_solicitada");

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


	public function ReportesOPCargarSolicitud()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.numero_aten, beneficiario.cedula, beneficiario.nombre, 
			beneficiario.apellido,discapacid_e.nombre_e, atenciones_coordinaciones.atencion_solicitada
			FROM atenciones_coordinaciones, beneficiario, discapacid_e WHERE
			atenciones_coordinaciones.numero_aten = :numero_aten and
			beneficiario.cedula = atenciones_coordinaciones.cedula and
			beneficiario.discapacidad = discapacid_e.id_e");

			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			$stmt->bindParam(':numero_aten', $this->numero_aten);
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
	public function ReportesOP()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.numero_aten, beneficiario.cedula, beneficiario.nombre, 
			beneficiario.apellido, estados.nombre_estado,discapacid_e.nombre_e, tipo_ayuda_tecnica.nombre_tipoayuda, 
			atenciones_coordinaciones.atencion_brindada, atenciones_coordinaciones.atencion_solicitada, atenciones_coordinaciones.fecha_aten
			FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e, tipo_ayuda_tecnica WHERE
            atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id and
			atenciones_coordinaciones.numero_aten = :numero_aten and
			beneficiario.cedula = atenciones_coordinaciones.cedula and
			beneficiario.discapacidad = discapacid_e.id_e and
			beneficiario.estado = estados.id_estados and 
			atenciones_coordinaciones.fecha_aten IS NOT NULL;");

			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			$stmt->bindParam(':numero_aten', $this->numero_aten);
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

	public function atencionesDadas_por_discapacidadg()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT discapacid.nombre_discapacidad,COUNT(beneficiario.discapacidad) as cantidades FROM `atenciones_coordinaciones`, beneficiario, discapacid,discapacid_e 
			WHERE 
			atenciones_coordinaciones.cedula = beneficiario.cedula and atenciones_coordinaciones.fecha_aten is not null and beneficiario.discapacidad = discapacid_e.id_e and discapacid_e.general = discapacid.id_disca GROUP BY beneficiario.discapacidad");
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

	public function atencionesDadas_por_discapacidadE()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.discapacidad,COUNT(beneficiario.discapacidad) as cantidades FROM `atenciones_coordinaciones`, beneficiario WHERE 
			atenciones_coordinaciones.cedula = beneficiario.cedula and atenciones_coordinaciones.fecha_aten is not null GROUP BY beneficiario.discapacidad");
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

	public function atencionesDadas_por_edad()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT beneficiario.edad, COUNT(beneficiario.edad) as cantidades FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula 
			and fecha_aten is not null GROUP by beneficiario.edad");
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

	
	public function atencionesDadas_por_sexo()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT 										
			beneficiario.sexo as sexos,
			count(beneficiario.sexo)as cantidades
			FROM `atenciones_coordinaciones`, beneficiario
			 WHERE 		
			`fecha_aten` is NOT NULL and
			atenciones_coordinaciones.cedula = beneficiario.cedula
			GROUP BY beneficiario.sexo");
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
	public function consultarTodosAtencionesporayuda()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT tipo_ayuda_tecnica.nombre_tipoayuda, COUNT(atenciones_coordinaciones.atencion_recibida)as cantidad
			FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e, tipo_ayuda_tecnica WHERE
            atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id and
			beneficiario.cedula = atenciones_coordinaciones.cedula and
			beneficiario.discapacidad = discapacid_e.id_e and
			beneficiario.estado = estados.id_estados and 
			atenciones_coordinaciones.fecha_aten IS NOT NULL GROUP BY tipo_ayuda_tecnica.nombre_tipoayuda");
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
	public function graficasxtipoatencion()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT 										
			atencion_recibida.nombre,
			count(atenciones_coordinaciones.atencion_brindada)as Recibidas 
			FROM `atenciones_coordinaciones`, beneficiario, atencion_recibida
			 WHERE 		
			 atencion_recibida.id = atenciones_coordinaciones.atencion_brindada and
			`fecha_aten` is NOT NULL and
			atenciones_coordinaciones.cedula = beneficiario.cedula 
			GROUP BY atencion_recibida.nombre');
			// Especificamos el fetch mode antes de llamar a fetch()

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
	/* CONSULTAS PARA GENERAR PDF'S */
	public function BuscarAtencionesMensuales($mes, $anio)
	{
		try {
			$stmt = $this->cnn->prepare('SELECT
                YEAR(fecha_aten) AS anio,
                MONTH(fecha_aten) AS mes,
                MONTHNAME(fecha_aten) as nombre_mes,
                COUNT(*) AS cantidad_registros
            FROM
			atenciones_coordinaciones
            WHERE
                fecha_aten IS NOT NULL AND
                YEAR(fecha_aten) = :anio AND
                MONTH(fecha_aten) = :mes
            GROUP BY
                YEAR(fecha_aten), MONTH(fecha_aten)
            ORDER BY
                anio, mes
        ');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);
			

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function DatosMensuales($mes, $anio)
	{
		try {
			$stmt = $this->cnn->prepare('SELECT
			atenciones_coordinaciones.numero_aten, atenciones_coordinaciones.cedula,beneficiario.nombre, beneficiario.apellido, atenciones_coordinaciones.fecha_aten, atenciones_coordinaciones.atencion_solicitada, tipo_ayuda_tecnica.nombre_tipoayuda
			FROM
			atenciones_coordinaciones,beneficiario,tipo_ayuda_tecnica,artificios
			 WHERE
			 YEAR(fecha_aten)=:anio and
			 MONTH(fecha_aten)=:mes and 
			 fecha_aten is NOT null and
			 beneficiario.cedula = atenciones_coordinaciones.cedula and
			 atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id
			 GROUP by atenciones_coordinaciones.numero_aten
			
        ');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function DatosMensuales_ESTADOS($mes, $anio)
	{
		try {
			$stmt = $this->cnn->prepare('SELECT estados.nombre_estado, COUNT(beneficiario.estado) as numero FROM `atenciones_coordinaciones`, beneficiario, estados WHERE beneficiario.cedula = atenciones_coordinaciones.cedula and atenciones_coordinaciones.fecha_aten is not null
			and YEAR(atenciones_coordinaciones.fecha_aten)=:anio 
			and MONTH(atenciones_coordinaciones.fecha_aten)=:mes
			AND beneficiario.estado = estados.id_estados GROUP BY beneficiario.estado;
			
        ');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_DG($mes, $anio) //discapacidad general
	{
		try {
			$stmt = $this->cnn->prepare('SELECT discapacid.nombre_discapacidad,COUNT(beneficiario.discapacidad) as cantidades FROM `atenciones_coordinaciones`, beneficiario, discapacid,discapacid_e 
			WHERE 
			atenciones_coordinaciones.cedula = beneficiario.cedula and atenciones_coordinaciones.fecha_aten is not null 
            and YEAR(atenciones_coordinaciones.fecha_aten) = :anio and MONTH(atenciones_coordinaciones.fecha_aten)=:mes
            and beneficiario.discapacidad = discapacid_e.id_e and discapacid_e.general = discapacid.id_disca GROUP BY beneficiario.discapacidad
			');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_DE($mes, $anio) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT beneficiario.discapacidad,COUNT(beneficiario.discapacidad) as cantidades FROM `atenciones_coordinaciones`, beneficiario WHERE 
			atenciones_coordinaciones.cedula = beneficiario.cedula and atenciones_coordinaciones.fecha_aten is not null and YEAR(atenciones_coordinaciones.fecha_aten) = :anio and MONTH(atenciones_coordinaciones.fecha_aten) = :mes GROUP BY beneficiario.discapacidad
			');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_SEXO($mes, $anio) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT 										
			beneficiario.sexo as sexos,
			count(beneficiario.sexo)as cantidades
			FROM `atenciones_coordinaciones`, beneficiario
			 WHERE 	
             
			`fecha_aten` is NOT NULL and
            Year(fecha_aten) = :anio AND
            month(fecha_aten) = :mes and
			atenciones_coordinaciones.cedula = beneficiario.cedula
			GROUP BY beneficiario.sexo');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_EDAD($mes, $anio) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT beneficiario.edad, COUNT(beneficiario.edad) as cantidades FROM `atenciones_coordinaciones`, beneficiario WHERE beneficiario.cedula = atenciones_coordinaciones.cedula 
			and fecha_aten is not null
            and year(fecha_aten) = :anio AND
            month(fecha_aten) = :mes
            GROUP by beneficiario.edad');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_AYUDATECNICA($mes, $anio) //por tipo de ayuda
	{
		try {
			$stmt = $this->cnn->prepare('SELECT tipo_ayuda_tecnica.nombre_tipoayuda, COUNT(atenciones_coordinaciones.atencion_recibida)as cantidad
			FROM atenciones_coordinaciones, beneficiario, estados, discapacid_e, tipo_ayuda_tecnica WHERE
            atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id and
            Year(fecha_aten) = :anio AND
            month(fecha_aten) = :mes and
			beneficiario.cedula = atenciones_coordinaciones.cedula and
			beneficiario.discapacidad = discapacid_e.id_e and
			beneficiario.estado = estados.id_estados and 
			atenciones_coordinaciones.fecha_aten IS NOT NULL GROUP BY tipo_ayuda_tecnica.nombre_tipoayuda');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_ATENCION($mes, $anio) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT 										
			atencion_recibida.nombre,
			count(atenciones_coordinaciones.atencion_brindada)as Recibidas 
			FROM `atenciones_coordinaciones`, beneficiario, atencion_recibida
			 WHERE 		
			 atencion_recibida.id = atenciones_coordinaciones.atencion_brindada and
			`fecha_aten` is NOT NULL and
            Year(fecha_aten) = :anio AND
            month(fecha_aten) = :mes and
			atenciones_coordinaciones.cedula = beneficiario.cedula 
			GROUP BY atencion_recibida.nombre');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function DatosMensuales_COORDINACION($mes, $anio) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT
			coordinaciones_estadales.nombre_coordinacion,
			COUNT(atenciones_coordinaciones.atencion_brindada) as Recibidas
		FROM
			atenciones_coordinaciones
		JOIN
			atencion_recibida ON atencion_recibida.id = atenciones_coordinaciones.atencion_brindada
		JOIN
			usuario ON usuario.cedula = atenciones_coordinaciones.por
		JOIN
			coordinaciones_estadales ON usuario.coordinacion = coordinaciones_estadales.id
		JOIN
			beneficiario ON atenciones_coordinaciones.cedula = beneficiario.cedula
		WHERE
			fecha_aten IS NOT NULL
			AND YEAR(fecha_aten) = :anio
			AND MONTH(fecha_aten) = :mes
		GROUP BY
			atenciones_coordinaciones.por;
		');

			// Bind de parámetros
			$stmt->bindParam(':anio', $anio, PDO::PARAM_INT);
			$stmt->bindParam(':mes', $mes, PDO::PARAM_INT);

			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function atencionesDadas_COORDINACION() //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT
			coordinaciones_estadales.nombre_coordinacion,
			COUNT(atenciones_coordinaciones.atencion_brindada) as Recibidas
		FROM
			atenciones_coordinaciones
		JOIN
			atencion_recibida ON atencion_recibida.id = atenciones_coordinaciones.atencion_brindada
		JOIN
			usuario ON usuario.cedula = atenciones_coordinaciones.por
		JOIN
			coordinaciones_estadales ON usuario.coordinacion = coordinaciones_estadales.id
		JOIN
			beneficiario ON atenciones_coordinaciones.cedula = beneficiario.cedula
		WHERE
			fecha_aten IS NOT NULL
			
		GROUP BY
			atenciones_coordinaciones.por;
		');

			// Bind de parámetros
	
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function atencionesDadas_COORDINACIONxAYUDATECNICA() //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare('SELECT
			coordinaciones_estadales.nombre_coordinacion,
			tipo_ayuda_tecnica.nombre_tipoayuda as Recibidas,
			COUNT(coordinaciones_estadales.nombre_coordinacion) as CantidadRecibidas
		FROM
			atenciones_coordinaciones
		JOIN
			atencion_recibida ON atencion_recibida.id = atenciones_coordinaciones.atencion_brindada
		 JOIN
			 tipo_ayuda_tecnica ON atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id
		JOIN
			usuario ON usuario.cedula = atenciones_coordinaciones.por
		JOIN
			coordinaciones_estadales ON usuario.coordinacion = coordinaciones_estadales.id
		JOIN
			beneficiario ON atenciones_coordinaciones.cedula = beneficiario.cedula
		WHERE
			fecha_aten IS NOT NULL
		GROUP BY
			atenciones_coordinaciones.atencion_recibida
		ORDER BY
			coordinaciones_estadales.nombre_coordinacion ASC;
		');

			// Bind de parámetros
	
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanal() //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			semanas.numero_semana + 1 as nroSemana,
			semanas.inicio_semana,
			DATE_ADD(semanas.fin_semana, INTERVAL 1 DAY) as fin_semana,
			COUNT(atenciones_coordinaciones.cedula) as registros
		FROM (
			SELECT
				WEEK(fecha) AS numero_semana,
				MIN(fecha) AS inicio_semana,
				MAX(fecha) AS fin_semana
			FROM (
				SELECT
					CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY AS fecha
				FROM
					(SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS a
					CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS b
					CROSS JOIN (SELECT 0 AS a UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4 UNION ALL SELECT 5 UNION ALL SELECT 6 UNION ALL SELECT 7 UNION ALL SELECT 8 UNION ALL SELECT 9) AS c
				WHERE
					CURDATE() - INTERVAL (a.a + (10 * b.a) + (100 * c.a)) DAY BETWEEN  MAKEDATE(YEAR(NOW()), 1) AND LAST_DAY(CONCAT(YEAR(NOW()), '-12-31'))
			) AS semanas
			GROUP BY
				WEEK(fecha)
		) AS semanas
		LEFT JOIN atenciones_coordinaciones ON WEEK(atenciones_coordinaciones.fecha_aten) = semanas.numero_semana
		GROUP BY
			semanas.numero_semana");

			// Bind de parámetros
				
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanalGeneral($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			atenciones_coordinaciones.numero_aten,
			atenciones_coordinaciones.cedula, 
			atenciones_coordinaciones.atencion_recibida,
			atenciones_coordinaciones.fecha_aten
		FROM
		atenciones_coordinaciones
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null
		
		");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanalAyudaTecnica($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			tipo_ayuda_tecnica.nombre_tipoayuda,
			count(tipo_ayuda_tecnica.nombre_tipoayuda) as cantidad
		FROM
		atenciones_coordinaciones, tipo_ayuda_tecnica
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null AND
			atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id 
              GROUP BY tipo_ayuda_tecnica.nombre_tipoayuda
		");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanalSexo($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			beneficiario.sexo,
			count(beneficiario.sexo) as cantidad
		FROM
		atenciones_coordinaciones, beneficiario
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null AND
              beneficiario.cedula = atenciones_coordinaciones.cedula
              GROUP BY beneficiario.sexo");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanalEdad($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			beneficiario.edad,
			count(beneficiario.sexo) as cantidad
		FROM
		atenciones_coordinaciones, beneficiario
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null AND
              beneficiario.cedula = atenciones_coordinaciones.cedula
              GROUP BY beneficiario.edad");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ReporteSemanalDiscapacidadE($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			discapacid_e.nombre_e,
			count(beneficiario.discapacidad) as cantidad
		FROM
		atenciones_coordinaciones, beneficiario, discapacid_e
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null AND
              beneficiario.cedula = atenciones_coordinaciones.cedula and
			  beneficiario.discapacidad = discapacid_e.id_e
              GROUP BY discapacid_e.nombre_e");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function ReporteSemanalDiscapacidadG($uno, $dos) //Discapacidad Especifica
	{
		try {
			$stmt = $this->cnn->prepare("SELECT
			discapacid_e.nombre_e,
			count(beneficiario.discapacidad) as cantidad
		FROM
		atenciones_coordinaciones, beneficiario, discapacid_e
		WHERE
			fecha_aten BETWEEN :fechaUno AND :fechaDos
			and fecha_aten IS NOT null AND
              beneficiario.cedula = atenciones_coordinaciones.cedula and
			  beneficiario.discapacidad = discapacid_e.id_e
              GROUP BY discapacid_e.nombre_e");

			// Bind de parámetros
			$stmt->bindParam(':fechaUno', $uno, PDO::PARAM_STR);
			$stmt->bindParam(':fechaDos', $dos, PDO::PARAM_STR);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function subirArchivo($archivo)
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones_coordinaciones SET archivo = :archivo
                                             WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			$stmt->bindParam(':archivo', $archivo);
			$stmt->bindParam(':numero_aten', $this->numero_aten);

			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>"; */

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			/* return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	 */

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function subirInforme($archivo)
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE atenciones_coordinaciones SET informe = :informe
                                             WHERE numero_aten = :numero_aten");

			// Asignamos valores a los parametros
			$stmt->bindParam(':informe', $archivo);
			$stmt->bindParam(':numero_aten', $this->numero_aten);

			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>"; */

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			/* return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	 */

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}


	public function insertarFamiliar($cedula, $nombre, $apellido, $id_atencion)
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO familiaresoac (cedula, nombre, apellido, id_atencion) 
											VALUES (:cedula, :nombre, :apellido, :id_atencion)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':nombre', $nombre);
			$stmt->bindParam(':apellido', $apellido);
			$stmt->bindParam(':id_atencion', $id_atencion);

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
	public function consultarFamiliar($numero_aten)
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * from familiaresoac WHERE familiaresoac.id_atencion = :numero_aten");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':numero_aten', $numero_aten);
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

	


	

}






