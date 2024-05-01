<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class toma_medidas extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $fecha_medidas;
        private $medidas;
        private $artificio;
		private $codigo_cita;
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

		

		public function getmedidas()
        {
            return $this->medidas ;
        }
		public function setmedidas($medidas)
		{
		    $this->medidas = $medidas;		    
		}

		
         public function getid()
		{
		    return $this->id;
		}
		public function setid ($id)
		{
		    $this->id = $id;		    
		}


        public function getartificio()
		{
		    return $this->artificio;
		}
		public function setartificio ($artificio)
		{
		    $this->artificio = $artificio;		    
		}
 


		public function getfecha_medidas()
		{
		    return $this->fecha_medidas;
		}
		public function setfecha_medidas($fecha_medidas)
		{
		    $this->fecha_medidas = $fecha_medidas;		    
		}

		public function getcodigo_cita()
		{
		    return $this->codigo_cita;
		}
		public function setcodigo_cita($codigo_cita)
		{
		    $this->codigo_cita = $codigo_cita;		    
		}




		public function insertarMedidas(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `toma_medidas`(cedula, fecha_medidas, artificio, codigo_cita) VALUES (:cedula, :fecha_medidas, :artificio, :codigo_cita)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':fecha_medidas', $this->fecha_medidas);
				$stmt->bindParam(':artificio', $this->artificio);
				$stmt->bindParam(':codigo_cita', $this->codigo_cita);
				/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */
               
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

		public function autenticarMedidas(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM toma_medidas WHERE cedula = :cedula ");
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
		public function consultarMedidas(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, 
				beneficiario.discapacidad, beneficiario.atencion_solicitada, toma_medidas.fecha_medidas,
				toma_medidas.id, toma_medidas.codigo_cita
				FROM `toma_medidas`, beneficiario, cita_ortesis_protesis
				 WHERE beneficiario.cedula = toma_medidas.cedula 
				 AND toma_medidas.codigo_cita = cita_ortesis_protesis.id 
				 and toma_medidas.codigo_cita = :codigo_cita
			
				 and cita_ortesis_protesis.id = :codigo_cita;");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':codigo_cita', $this->codigo_cita);
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

		public function consultarTodasMedidasSindar(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, toma_medidas.artificio, toma_medidas.codigo_cita ,toma_medidas.id, toma_medidas.fecha_medidas  FROM beneficiario, toma_medidas WHERE beneficiario.cedula = toma_medidas.cedula /* AND beneficiario.atencion_solicitada = '4-tomedi' */ and toma_medidas.medidas IS NULL;");
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

		public function consultarTodasMedidasDadas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, discapacid.nombre_discapacidad, beneficiario.atencion_solicitada, toma_medidas.id, toma_medidas.medidas, toma_medidas.fecha_medidas, artificios.nombre_artificio 

				FROM beneficiario, toma_medidas, discapacid, artificios 
				
				WHERE
                artificios.id = toma_medidas.artificio and
				beneficiario.cedula = toma_medidas.cedula AND  
				beneficiario.discapacidad = discapacid.id_disca and
				toma_medidas.artificio IS NOT NULL;");
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


		public function modificarMedidas(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE toma_medidas SET medidas = :medidas, artificio = :artificio,
											fecha_medidas = :fecha_medidas
                                             WHERE id = :id");
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
				$stmt->bindParam(':artificio', $this->artificio);
				$stmt->bindParam(':medidas', $this->medidas);
				$stmt->bindParam(':fecha_medidas', $this->fecha_medidas);
              
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
				/* $stmt->bindParam(':numero_aten', $this->numero_aten); */
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


		/* ============Consultar todas Protesis para asignar toma de medidas=========================  */


		public function consultarTodasProtesis(){

			try{	

				$stmt = $this->cnn->prepare("SELECT protesis.id,protesis.nombre FROM protesis WHERE 1");
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

	
		/* ============Consultar todas Ortesis para asignar toma de medidas=========================  */

		public function consultarTodasOrtesis(){

			try{	

				$stmt = $this->cnn->prepare("SELECT ortesis.id,ortesis.nombre FROM ortesis WHERE 1");
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

}
