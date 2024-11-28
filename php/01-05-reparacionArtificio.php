<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class raparacion_artificio extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $fecha_reparacion;
        private $artificio;
		private $descripcion;
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

		

		public function getartificio()
        {
            return $this->artificio ;
        }
		public function setartificio($artificio)
		{
		    $this->artificio = $artificio;		    
		}
		public function getDescripcion()
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
 


		public function getfecha_reparacion()
		{
		    return $this->fecha_reparacion;
		}
		public function setfecha_reparacion($fecha_reparacion)
		{
		    $this->fecha_reparacion = $fecha_reparacion;		    
		}




		public function insertarReparacion(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `reparacion_artificios`(cedula) VALUES (:cedula)");
				
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

		public function autenticarAdministrador(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM prueba_artificio WHERE cedula = :cedula AND passwordd = :passwordd");
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
		public function consultarReparacion(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad, beneficiario.atencion_solicitada,
				 reparacion_artificios.id, reparacion_artificios.artificio FROM `reparacion_artificios`, beneficiario WHERE beneficiario.cedula = reparacion_artificios.cedula 
				AND reparacion_artificios.id = :id;");
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
		public function consultarReparacionModificar(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad, beneficiario.atencion_solicitada,
				 reparacion_artificios.id, reparacion_artificios.artificio, reparacion_artificios.fecha_reparacion,  reparacion_artificios.descripcion FROM `reparacion_artificios`, beneficiario WHERE beneficiario.cedula = reparacion_artificios.cedula 
				AND reparacion_artificios.id = :id;");
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

		public function autenticarReparacion(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM reparacion_artificios WHERE cedula = :cedula ");
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

		public function consultarTodasReparacionesSindar(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, reparacion_artificios.id FROM beneficiario, 
                reparacion_artificios WHERE beneficiario.cedula = reparacion_artificios.cedula AND 
                /* beneficiario.atencion_solicitada = '6-repaart' */  reparacion_artificios.artificio IS NULL;");
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

		public function consultarTodasReparacionesDadas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, beneficiario.discapacidad,
				 beneficiario.atencion_solicitada, reparacion_artificios.id, reparacion_artificios.artificio, reparacion_artificios.status, reparacion_artificios.fecha_reparacion, reparacion_artificios.descripcion FROM 
				 beneficiario, reparacion_artificios WHERE beneficiario.cedula = reparacion_artificios.cedula AND 
				 /* beneficiario.atencion_solicitada = '6-repaart' */  reparacion_artificios.artificio IS NOT NULL;");
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


		public function modificarArtificio(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE reparacion_artificios SET artificio = :artificio
                                             WHERE id = :id");
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
				$stmt->bindParam(':artificio', $this->artificio);
              
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}
		public function InsertarCitaReparacion(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE reparacion_artificios SET artificio = :artificio, 
				descripcion = :descripcion, fecha_reparacion = :fecha_reparacion, status = 'Cita dada' 
                                             WHERE id = :id");
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
				$stmt->bindParam(':artificio', $this->artificio);
				$stmt->bindParam(':descripcion', $this->descripcion);
				$stmt->bindParam(':fecha_reparacion', $this->fecha_reparacion);

              
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}
		public function reparcionAtendida(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE reparacion_artificios SET status = 'Reparacion completada' 
                                             WHERE id = :id");
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
				
				

              
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}

		

		public function eliminarReparacion(){

			try{	

				$stmt = $this->cnn->prepare("DELETE  FROM reparacion_artificios WHERE id = :id");
				
				$stmt->bindParam(':id', $this->id);
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


		

	
		


}
