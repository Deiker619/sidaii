<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class orientacion extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $fecha_orientacion;
		private $por;
		/* private $cedula;
        private $fecha_aten;
        ; */
		private $descripcion;
		private $coordinacion;
	
	
       

        private $cnn;
        /*===============================  */

        public function __construct($tipoConexion){
            $this->cnn = parent::conectar($tipoConexion);
        }

        public function __destruct(){ 
            parent::cerrarConexion(); 
        }



		public function getpor()
        {
            return $this->por;
        }
		public function setpor($por)
		{
		    $this->por = $por;		    
		}

		public function getcoordinacion()
			{
				return $this->coordinacion;
			}
			public function setcoordinacion($coordinacion)
			{
				$this->coordinacion = $coordinacion;		    
			}

		
		public function getcedula()
        {
            return $this->cedula;
        }
		public function setcedula($cedula)
		{
		    $this->cedula = $cedula;		    
		}


		

		public function getdescripcion()
        {
            return $this->descripcion ;
        }
		public function setdescripcion($descripcion)
		{
		    $this->descripcion = $descripcion;		    
		}

		
         public function getid()
		{
		    return $this->id;
		}
		public function setid ($id)
		{
		    $this->id = $id;		    
		}
 


		public function getfecha_orientacion()
		{
		    return $this->fecha_orientacion;
		}
		public function setfecha_orientacion($fecha_orientacion)
		{
		    $this->fecha_orientacion = $fecha_orientacion;		    
		}




		public function insertarOrientacion(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `orientaciones`(cedula, descripcion, fecha_orientacion) VALUES (:cedula, :descripcion, :fecha_orientacion)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
                $stmt->bindParam(':descripcion', $this->descripcion);
		        $stmt->bindParam(':fecha_orientacion', $this->fecha_orientacion);
				/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				//echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function consultarorientacion()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT orientaciones.descripcion, orientaciones.fecha_orientacion, beneficiario.cedula, beneficiario.nombre, beneficiario.apellido from orientaciones, beneficiario WHERE beneficiario.cedula=orientaciones.cedula and orientaciones.por is null');
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

		public function consultarTodasCitasSindar(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, 
                beneficiario.atencion_solicitada, audiometria.id FROM beneficiario, audiometria 
                WHERE beneficiario.cedula = audiometria.cedula  /* beneficiario.atencion_solicitada = '7-audiom' */
                 and audiometria.fecha_cita IS NULL;");
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

		public function consultarTodasCitasDadas(){

			try{	

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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		/* OP ESTADAL */
		public function insertarOrientacionEstadal(){  /* 22/8/2023     */

			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `orientaciones`(cedula, descripcion, fecha_orientacion, por) VALUES (:cedula, :descripcion, :fecha_orientacion, :por)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
                $stmt->bindParam(':descripcion', $this->descripcion);
		        $stmt->bindParam(':fecha_orientacion', $this->fecha_orientacion);
				 $stmt->bindParam(':por', $this->por);
				/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				//echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function orientaciones_dadas_por(){  /* 22/8/2023     */

			try{	

				$stmt = $this->cnn->prepare("SELECT orientaciones.id,orientaciones.cedula, orientaciones.descripcion, orientaciones.fecha_orientacion FROM `orientaciones`, usuario WHERE orientaciones.por = usuario.cedula and usuario.coordinacion = :coordinacion ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->bindParam(':coordinacion', $this->coordinacion);
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

		public function orientacionesADMIN(){  /* 22/8/2023     */

			try{	

				$stmt = $this->cnn->prepare("SELECT orientaciones.id,orientaciones.cedula, orientaciones.descripcion, orientaciones.fecha_orientacion FROM `orientaciones` WHERE 1");
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

		


		public function modificarCita(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE audiometria SET fecha_cita = :fecha_cita
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':fecha_orientacion', $this->fecha_orientacion);
               /*  $stmt->bindParam(':id', $this->id); */
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

		

		public function eliminaraudio(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM audiometria WHERE id = :id");
				
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