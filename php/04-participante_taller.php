<?php
include_once("ManejadorBD.php");


class participante_taller extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $fecha_recibido;
		private $taller;
		
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

/* 
		public function getsolicitud()
        {
            return $this->solicitud;
        }
		public function setsolicitud($solicitud)
		{
		    $this->solicitud = $solicitud;		    
		}
 */

	/* 	public function getactividad()
        {
            return $this->actividad;
        }
		public function setactividad($actividad)
		{
		    $this->actividad = $actividad;		    
		}
 */

		public function gettaller()
        {
            return $this->taller;
        }
		public function settaller($taller)
		{
		    $this->taller = $taller;		    
		}

		
        public function getfecha_recibido()
		{
		    return $this->fecha_recibido;
		}
		public function setfecha_recibido ($fecha_recibido)
		{
		    $this->fecha_recibido = $fecha_recibido;		    
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



		public function insertarParticipante(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO participante_taller (cedula, fecha_recibido, taller) 
											VALUES (:cedula, :fecha_recibido, :taller)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':fecha_recibido', $this->fecha_recibido);
				$stmt->bindParam(':taller', $this->taller);
		
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

				$stmt = $this->cnn->prepare("SELECT * FROM solicitudes_desarrollo WHERE cedula = :cedula AND passwordd = :passwordd");
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function consultarTodosParticipantes(){

			try{	

				$stmt = $this->cnn->prepare("SELECT participante_taller.id, beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, participante_taller.fecha_recibido
				from beneficiario, participante_taller where beneficiario.cedula = participante_taller.cedula and participante_taller.taller = :taller");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				$stmt->bindParam(':taller', $this->taller);
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		/* Para ver cuales son las atenciones que no tiene fecha null (Para consultar todas la atenciones dadas) */
		public function consultarTodosAtencionesa(){

			try{	

				$stmt = $this->cnn->prepare("SELECT atenciones.numero_aten, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.estado,beneficiario.discapacidad, atenciones.atencion_recibida FROM atenciones, beneficiario WHERE beneficiario.cedula = atenciones.cedula and atenciones.fecha_aten IS NOT NULL;");
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


		public function modificarAtenciones(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE atenciones SET fecha_aten = :fecha_aten, atencion_recibida = :atencion_recibida 
                                             WHERE numero_aten = :numero_aten");
				
				// Asignamos valores a los parametros
				/* $stmt->bindParam(':numero_aten', $this->numero_aten);
                $stmt->bindParam(':fecha_aten', $this->fecha_aten);
                $stmt->bindParam(':atencion_recibida', $this->atencion_recibida); */
				
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

		

		public function eliminarDiscapacitados(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM discapacitados WHERE numero_aten = :numero_aten");
				
				// Asiganmos valores a los parametros
			/* 	$stmt->bindParam(':numero_aten', $this->numero_aten); */
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