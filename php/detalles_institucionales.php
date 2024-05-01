<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class detalles_institucionales extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $fecha_cita;
        private $proteccion_social;
        private $institucion_registrado;
		private $direccion;
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

		public function getdireccion()
        {
            return $this->direccion;
        }
		public function setdireccion($direccion)
		{
		    $this->direccion = $direccion;		    
		}



		public function getproteccion_social()
        {
            return $this->proteccion_social ;
        }
		public function setproteccion_social($proteccion_social)
		{
		    $this->proteccion_social = $proteccion_social;		    
		}



        public function getinstitucion_registrado()
        {
            return $this->institucion_registrado ;
        }
		public function setinstitucion_registrado($institucion_registrado)
		{
		    $this->institucion_registrado = $institucion_registrado;		    
		}


		
         public function getid()
		{
		    return $this->id;
		}
		public function setid ($id)
		{
		    $this->id = $id;		    
		}
 


		public function getfecha_cita()
		{
		    return $this->fecha_cita;
		}
		public function setfecha_cita($fecha_cita)
		{
		    $this->fecha_cita = $fecha_cita;		    
		}




		public function insertardetalles(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO detalles_institucionales (cedula, proteccion_social, institucion_registrado) VALUES (:cedula, :proteccion_social, :institucion_registrado)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':proteccion_social', $this->proteccion_social);
				$stmt->bindParam(':institucion_registrado', $this->institucion_registrado);
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";
 */
				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function insertardireccion(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO direcciones (cedula, descripcion) VALUES (:cedula, :descripcion)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':descripcion', $this->direccion);
				
               
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>";
 */
				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 
		}

		public function autenticarAudiometria(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM audiometria WHERE cedula = :cedula ");
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
		public function consultarCita(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad,
                 beneficiario.atencion_solicitada, audiometria.id FROM `audiometria`, beneficiario WHERE 
                 beneficiario.cedula = audiometria.cedula 
				AND audiometria.id = :id;");
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

		
		public function consultarTodasAyudas_tecRecibidas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, atenciones.numero_aten, ayudas_tec.id, ayudas_tec.tipo_ayuda_tec FROM `ayudas_tec`, beneficiario, atenciones WHERE ayudas_tec.numero_aten = atenciones.numero_aten and beneficiario.cedula = atenciones.cedula AND atenciones.atencion_recibida = '-ayudatec' AND ayudas_tec.tipo_ayuda_tec IS NOT NULL;");
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
				$stmt->bindParam(':fecha_cita', $this->fecha_cita);
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