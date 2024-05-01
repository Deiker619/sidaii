<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Ayudas_tec extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $tipo_ayuda_tec;
		/* private $cedula;
        private $fecha_aten;
        private $atencion_recibida ; */
		

	
	
       

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


		

	/* 	public function getatencion_recibida()
        {
            return $this->atencion_recibida ;
        }
		public function setatencion_recibida($atencion_recibida)
		{
		    $this->atencion_recibida = $atencion_recibida;		    
		} */

		
         public function getid()
		{
		    return $this->id;
		}
		public function setid ($id)
		{
		    $this->id = $id;		    
		}
 


		public function gettipo_ayuda_tec()
		{
		    return $this->tipo_ayuda_tec;
		}
		public function settipo_ayuda_tec($tipo_ayuda_tec)
		{
		    $this->tipo_ayuda_tec = $tipo_ayuda_tec;		    
		}




		public function insertarAyuda_tec(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `ayudas_tec`(`cedula`) VALUES (:cedula)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
		
				/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function autenticarAyuda(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM ayudas_tec WHERE cedula = :cedula");
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

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}
		public function consultarAyudas_tec(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,estados.nombre_estado, discapacid.nombre_discapacidad, ayudas_tec.id FROM `ayudas_tec`, beneficiario, discapacid, estados WHERE 
				beneficiario.estado = estados.id_estados and
				ayudas_tec.cedula = beneficiario.cedula  AND
				discapacid.id_disca = beneficiario.discapacidad and 
				ayudas_tec.id = :id and
				ayudas_tec.tipo_ayuda_tec IS NULL;");
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

		public function consultarTodasAyudas_tec(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula,estados.nombre_estado, discapacid.nombre_discapacidad, ayudas_tec.id FROM `ayudas_tec`, beneficiario, discapacid, estados WHERE 
				beneficiario.estado = estados.id_estados and
				ayudas_tec.cedula = beneficiario.cedula  AND
				discapacid.id_disca = beneficiario.discapacidad and 
				ayudas_tec.tipo_ayuda_tec IS NULL;");
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

		
		public function consultarTodasAyudas_tecRecibidas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, discapacid.nombre_discapacidad, ayudas_tec.id, tipo_ayuda_tecnica.nombre_tipoayuda 
				FROM `ayudas_tec`, beneficiario, discapacid, tipo_ayuda_tecnica
				
				WHERE
				ayudas_tec.cedula =  beneficiario.cedula AND
				discapacid.id_disca = beneficiario.discapacidad and
				tipo_ayuda_tecnica.id = ayudas_tec.tipo_ayuda_tec and
				ayudas_tec.tipo_ayuda_tec IS NOT NULL;");
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

		public function consultarTodasAyudas_porAyuda(){

			try{	

				$stmt = $this->cnn->prepare("SELECT tipo_ayuda_tecnica.nombre_tipoayuda, COUNT(ayudas_tec.tipo_ayuda_tec) as total FROM 
				`ayudas_tec`, beneficiario, tipo_ayuda_tecnica WHERE ayudas_tec.cedula =  beneficiario.cedula AND ayudas_tec.tipo_ayuda_tec
				 IS NOT NULL and tipo_ayuda_tecnica.id = ayudas_tec.tipo_ayuda_tec GROUP by tipo_ayuda_tecnica.nombre_tipoayuda;");
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


		public function modificarAyudas_tec(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE ayudas_tec SET tipo_ayuda_tec = :tipo_ayuda_tec
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':tipo_ayuda_tec', $this->tipo_ayuda_tec);
                $stmt->bindParam(':id', $this->id);
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

		

		public function eliminarayuda(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM ayudas_tec WHERE id = :id");
				
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
