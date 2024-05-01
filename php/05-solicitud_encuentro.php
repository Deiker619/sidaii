<?php
include_once("ManejadorBD.php");


class solicitud_encuentro extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $solicitud;
        private $fecha_asig;
		private $id;
		
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


	/* 	public function getactividad()
        {
            return $this->actividad;
        }
		public function setactividad($actividad)
		{
		    $this->actividad = $actividad;		    
		}
 */

		public function getid()
        {
            return $this->id;
        }
		public function setid($id)
		{
		    $this->id = $id;		    
		}

		
        public function getfecha_asig()
		{
		    return $this->fecha_asig;
		}
		public function setfecha_asig ($fecha_asig)
		{
		    $this->fecha_asig = $fecha_asig;		    
		}



	/* 	public function gettipoasistencia()
		{
		    return $this->tipoasistencia;
		}
		public function settipoasistencia($tipoasistencia)
		{
		    $this->tipoasistencia = $tipoasistencia;		    
		}
 */



		public function insertarsolicitud(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO solicitudes_encuentro (cedula, solicitud) 
											VALUES (:cedula, :solicitud)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':solicitud', $this->solicitud);
		
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function autenticar(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM solicitudes_encuentro WHERE cedula = :cedula AND passwordd = :passwordd");
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
		public function consultarSolicitud(){
			try{	

				$stmt = $this->cnn->prepare("SELECT solicitudes_encuentro.id, beneficiario.nombre, beneficiario.apellido, 
                beneficiario.cedula, beneficiario.estado ,solicitudes_encuentro.solicitud FROM 
                beneficiario, solicitudes_encuentro where solicitudes_encuentro.id = :id and beneficiario.cedula = solicitudes_encuentro.cedula");
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

		public function consultarTodasSolicitudes(){

			try{	

				$stmt = $this->cnn->prepare("SELECT solicitudes_encuentro.id, beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, beneficiario.estado ,
				solicitudes_encuentro.solicitud FROM beneficiario, solicitudes_encuentro where 
                solicitud = '11-partic' and beneficiario.cedula = solicitudes_encuentro.cedula and solicitudes_encuentro.fecha_asig IS NULL ");
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

		public function contarJornadas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM solicitudes_encuentro WHERE numero_personas = :numero_personas");
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		/* Para ver cuales son las atenciones que no tiene fecha null (Para consultar todas la atenciones dadas) */
		public function consultarTodosAtencionesa(){

			try{	

				$stmt = $this->cnn->prepare("SELECT atenciones.numero_aten, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.estado,beneficiario.discapacidad, atenciones.atencion_recibida FROM 
				atenciones, beneficiario WHERE beneficiario.cedula = atenciones.cedula and atenciones.fecha_aten IS NOT NULL;");
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

		public function contarTodasAtencionesa(){

			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM `atenciones` WHERE fecha_aten IS NOT NULL");
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


		public function modificarSolicitud(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE solicitudes_encuentro SET fecha_asig = :fecha_asig
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':fecha_asig', $this->fecha_asig);
				
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

		}

		

		public function eliminarSolic(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM solicitudes_encuentro WHERE id = :id");
				
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
?>