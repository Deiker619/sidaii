<?php
include_once("ManejadorBD.php");


class remitido extends ManejadorBD{
        /* ================================== */
        private $id;
		private $cedula;
        private $departamento;
		private $nombre;
        private $fecha;
		private $motivo;
		private $registrador;
		private $gerencia;
		private $coordinacion;
		private $statu;
		private $solicitud;
		private $informe;
        private $cnn;
        /*===============================  */

        public function __construct($tipoConexion){
            $this->cnn = parent::conectar($tipoConexion);
        }

        public function __destruct(){ 
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

        public function getsolicitud()
        {
            return $this->solicitud;
        }
		public function setsolicitud($solicitud)
		{
		    $this->solicitud = $solicitud;		    
		}


        public function getinforme()
        {
            return $this->informe;
        }
		public function setinforme($informe)
		{
		    $this->informe = $informe;		    
		}

        public function getcoordinacion()
        {
            return $this->coordinacion;
        }
		public function setcoordinacion($coordinacion)
		{
		    $this->coordinacion = $coordinacion;		    
		}



		public function getdepartamento()
        {
            return $this->departamento;
        }
		public function setdepartamento($departamento)
		{
		    $this->departamento = $departamento;		    
		}



		public function getid()
        {
            return $this->id;
        }
		public function setid($id)
		{
		    $this->id = $id;		    
		}



		public function getstatu()
        {
            return $this->statu;
        }
		public function setstatu($statu)
		{
		    $this->statu = $statu;		    
		}

		
        public function getfecha()
		{
		    return $this->fecha;
		}
		public function setfecha ($fecha)
		{
		    $this->fecha = $fecha;		    
		}



		public function getnombre()
		{
		    return $this->nombre;
		}
		public function setnombre($nombre)
		{
		    $this->nombre = $nombre;		    
		}


		public function getmotivo()
		{
		    return $this->motivo;
		}
		public function setmotivo($motivo)
		{
		    $this->motivo = $motivo;		    
		}


		public function getregistrador()
		{
		    return $this->registrador;
		}
		public function setregistrador($registrador)
		{
		    $this->registrador = $registrador;		    
		}

		public function getgerencia()
		{
		    return $this->gerencia;
		}
		public function setgerencia($gerencia)
		{
		    $this->gerencia = $gerencia;		    
		}





		public function insertarRemicion()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO remitidos (cedula, departamento,por, gerencia_remitente, coordinacion,  fecha, motivo, solicitud, informe) 
											VALUES (:cedula, :departamento,:por, :gerencia_remitente, :coordinacion, :fecha ,:motivo, :solicitud, :informe)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':departamento', $this->departamento);
			$stmt->bindParam(':fecha', $this->fecha);
			$stmt->bindParam(':motivo', $this->motivo);
			$stmt->bindParam(':por', $this->registrador);
			$stmt->bindParam(':gerencia_remitente', $this->gerencia);
			$stmt->bindParam(':coordinacion', $this->coordinacion);
			$stmt->bindParam(':solicitud', $this->solicitud);
			$stmt->bindParam(':informe', $this->informe);

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



		public function autenticarAdministrador(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM dispacitados WHERE cedula = :cedula AND passwordd = :passwordd");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				/* $stmt->bindParam(':cedula', $this->cedula); */
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>";

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}
		public function consultarRemitido(){
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE cedula = :cedula;");
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function consultarTodosRemitidos(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE 1");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		/* REMITIDOS: OAC */
		public function consultarTodosRemitidosSUPERADMIN(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE 1");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}


		public function consultarTodosRemitidosOAC(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE gerencia_remitente = :gerencia");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':gerencia', $this->gerencia);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}
		/*  */

		/* REMITIDOS: INFRAESTRUCTURA */


		public function consultarTodosRemitidoss(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE departamento = :departamento and statu IS NULL ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				$stmt->bindParam(':departamento', $this->departamento);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function consultarTodosRemitidossXCoordinacion(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE departamento = :departamento and coordinacion = :coordinacion and statu IS NULL ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				$stmt->bindParam(':departamento', $this->departamento);
				$stmt->bindParam(':coordinacion', $this->coordinacion);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function consultarRemitidosInfraestructura(){

			try{	

				$stmt = $this->cnn->prepare("SELECT remitidos.departamento,remitidos.cedula, remitidos.por, remitidos.gerencia_remitente,remitidos.fecha, remitidos.motivo, beneficiario.nombre, beneficiario.apellido,
				remitidos.solicitud, remitidos.informe
				FROM remitidos, beneficiario 
				WHERE remitidos.id = :id and
				beneficiario.cedula = remitidos.cedula");
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function ModificarRemitido(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE remitidos SET statu = :statu
				WHERE cedula = :cedula");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':statu', $this->statu);
				$stmt->bindParam(':cedula', $this->cedula);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetch();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}
		public function ModificarRemitidoRechazado(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE remitidos SET statu = :statu, motivo = :motivo
				WHERE cedula = :cedula");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':statu', $this->statu);
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':motivo', $this->motivo);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetch();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}




		/* Remitidos desarrollo social */


		
		public function consultarTodosRemitidosDesarrollo(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM remitidos WHERE departamento = '3Gtnd'and statu IS NULL ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

				// Devuelve los resultados obtenidos
				return $stmt->fetchAll();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		
		

		public function eliminarTaller(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM taller WHERE id = :id");
				
				// Asiganmos valores a los parametros
				$stmt->bindParam(':id', $this->id);
				// Ejecutamos
				$stmt->execute();

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount();	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}


}
