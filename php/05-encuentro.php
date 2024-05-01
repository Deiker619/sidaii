<?php
include_once("ManejadorBD.php");


class encuentro extends ManejadorBD{
        /* ================================== */
        private $estado;
		private $municipio;
		private $parroquia;
        private $actividad;
        private $fecha_encuentro;
		private $id;
		private $gerencia;
		
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

		
        public function getfecha_encuentro()
		{
		    return $this->fecha_encuentro;
		}
		public function setfecha_encuentro($fecha_encuentro)
		{
		    $this->fecha_encuentro = $fecha_encuentro;		    
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



		public function insertarEncuentro(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO encuentros (fecha_encuentro, estado, municipio, parroquia, actividad, gerencia) 
											VALUES (:fecha_encuentro, :estado, :municipio,:parroquia, :actividad, :gerencia)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':fecha_encuentro', $this->fecha_encuentro);
				$stmt->bindParam(':estado', $this->estado);
				$stmt->bindParam(':municipio', $this->municipio);
				$stmt->bindParam(':parroquia', $this->parroquia);
				$stmt->bindParam(':actividad', $this->actividad);
				$stmt->bindParam(':gerencia', $this->gerencia);
		
				/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				echo "1";// "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "0";//"Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function autenticarAdministrador(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM encuentros WHERE cedula = :cedula AND passwordd = :passwordd");
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
		public function consultarEncuentro(){
			try{	

				$stmt = $this->cnn->prepare("SELECT  encuentros.id, encuentros.fecha_encuentro, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, encuentros.actividad FROM encuentros, municipios, estados, parroquia WHERE 

				encuentros.estado = estados.id_estados AND
				encuentros.municipio = municipios.id_municipios AND
				encuentros.parroquia = parroquia.id and
				 encuentros.id = :id;");
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

		public function consultarTodosEncuentro(){

			try{	

				$stmt = $this->cnn->prepare("SELECT encuentros.id, encuentros.fecha_encuentro, estados.nombre_estado, municipios.nombre, parroquia.nombre_parroquia, encuentros.actividad, encuentros.gerencia FROM encuentros, municipios, estados, parroquia WHERE 

				encuentros.estado = estados.id_estados AND
				encuentros.municipio = municipios.id_municipios AND
				encuentros.parroquia = parroquia.id");
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

				$stmt = $this->cnn->prepare("SELECT * FROM encuentros WHERE numero_personas = :numero_personas");
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

				$stmt = $this->cnn->prepare("SELECT atenciones.numero_aten, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.estado,beneficiario.discapacidad, 
				atenciones.atencion_recibida FROM encuentros, beneficiario WHERE
                beneficiario.cedula = atenciones.cedula and atenciones.fecha_aten IS NOT NULL;");
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

				$stmt = $this->cnn->prepare("SELECT * FROM `encuentros` WHERE fecha_aten IS NOT NULL");
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


		public function modificarencuentro(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE encuentros SET fecha_encuentro = :fecha_encuentro, atencion_recibida = :atencion_recibida 
                                             WHERE id = :id");
				
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

		

		public function eliminarEncuentro(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM encuentros WHERE id = :id");
				
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