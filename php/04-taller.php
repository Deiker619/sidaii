<?php
include_once("ManejadorBD.php");


class taller extends ManejadorBD{
        /* ================================== */
        private $estado;
		private $municipio;
		private $parroquia;
        private $actividad;
        private $fecha_taller;
		private $id;
		
        private $cnn;
        /*===============================  */

        public function __construct($tipoConexion){
            $this->cnn = parent::conectar($tipoConexion);
        }

        public function __destruct(){ 
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


		public function getactividad()
        {
            return $this->actividad;
        }
		public function setactividad($actividad)
		{
		    $this->actividad = $actividad;		    
		}


		public function getid()
        {
            return $this->id;
        }
		public function setid($id)
		{
		    $this->id = $id;		    
		}

		
        public function getfecha_taller()
		{
		    return $this->fecha_taller;
		}
		public function setfecha_taller ($fecha_taller)
		{
		    $this->fecha_taller = $fecha_taller;		    
		}




		public function insertarTaller(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO taller (fecha_taller, estado, municipio, parroquia, actividad) 
											VALUES (:fecha_taller, :estado, :municipio, :parroquia, :actividad)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':fecha_taller', $this->fecha_taller);
				$stmt->bindParam(':estado', $this->estado);
				$stmt->bindParam(':municipio', $this->municipio);
				$stmt->bindParam(':parroquia', $this->parroquia);
				$stmt->bindParam(':actividad', $this->actividad);
		
               
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
		public function consultarTaller(){
			try{	

				$stmt = $this->cnn->prepare("SELECT taller.id, taller.fecha_taller, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, taller.actividad FROM `taller`, estados, municipios, parroquia WHERE taller.estado = estados.id_estados 
				and taller.municipio = municipios.id_municipios and taller.parroquia = parroquia.id and taller.id = :id");
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

		public function consultarTodosTaller(){

			try{	

				$stmt = $this->cnn->prepare("SELECT taller.id, taller.fecha_taller, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, taller.actividad FROM `taller`, estados, municipios, parroquia WHERE taller.estado = estados.id_estados 
				and taller.municipio = municipios.id_municipios and taller.parroquia = parroquia.id");
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
?>