<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("../php/ManejadorBD.php");

class rehabilitacion extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $id;
        private $fecha;
		private $descripcion;
		private $status;
        private $por;
        private $fecha_cita;
        private $rehabilitacion;
		
		

	
	
       

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


		public function getrehabilitacion()
        {
            return $this->rehabilitacion;
        }
		public function setrehabilitacion($rehabilitacion)
		{
		    $this->rehabilitacion = $rehabilitacion;		    
		}


		public function getfecha_cita()
        {
            return $this->fecha_cita;
        }
		public function setfecha_cita($fecha_cita)
		{
		    $this->fecha_cita = $fecha_cita;		    
		}



        public function getpor()
        {
            return $this->por;
        }
		public function setpor($por)
		{
		    $this->por = $por;		    
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
 


		public function getfecha()
		{
		    return $this->fecha;
		}
		public function setfecha($fecha)
		{
		    $this->fecha = $fecha;		    
		}
		public function getdescripcion()
		{
		    return $this->descripcion;
		}
		public function setdescripcion($descripcion)
		{
		    $this->descripcion = $descripcion;		    
		}
		public function getstatus()
		{
		    return $this->status;
		}
		public function setstatus($status)
		{
		    $this->status = $status;		    
		}




		public function insertarCita(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `rehabilitaciones`(cedula, por, status) VALUES (:cedula, :por, 'inactivo')");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':por', $this->por);
		
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
		public function insertarDescripcionDeControl(){
			try{	

				$stmt = $this->cnn->prepare("UPDATE `avances` set descripcion = :descripcion, status = 'completo' where id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':descripcion', $this->descripcion);
				$stmt->bindParam(':id', $this->id);
		
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
		public function cerrarCaso(){
			try{	

				$stmt = $this->cnn->prepare("UPDATE `rehabilitaciones` set status = 'Caso cerrado' where id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':id', $this->id);
		
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
		public function insertarAvance(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `avances`(fecha_cita, rehabilitacion) VALUES ( :fecha_cita, :rehabilitacion)");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':fecha_cita', $this->fecha_cita);
				$stmt->bindParam(':rehabilitacion', $this->rehabilitacion);
		
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
		public function modificarDescripcionGeneral(){
			try{	

				$stmt = $this->cnn->prepare("UPDATE `rehabilitaciones` SET descripcion = :descripcion, status = 'activo' where id = :id ");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':descripcion', $this->descripcion);
				$stmt->bindParam(':id', $this->id);

		
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
		public function consultarControl(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM avances WHERE id = :id ");
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
		public function consultarCita(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad,
                 rehabilitaciones.id, rehabilitaciones.fecha_insertado, rehabilitaciones.descripcion, rehabilitaciones.status  FROM `rehabilitaciones`, beneficiario WHERE 
                 beneficiario.cedula = rehabilitaciones.cedula 
				AND rehabilitaciones.id = :id;");
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
		public function consultarTodosAvancesDeProceso(){
			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.discapacidad,
                avances.id, avances.fecha_cita, avances.status , avances.descripcion FROM `rehabilitaciones`, beneficiario, avances WHERE 
                 beneficiario.cedula = rehabilitaciones.cedula 
				AND rehabilitaciones.id = :id ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':id', $this->id);
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

		public function consultarTodasCitasSindar(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, 
                beneficiario.atencion_solicitada, rehabilitaciones.id, rehabilitaciones.status  FROM beneficiario, rehabilitaciones 
                WHERE beneficiario.cedula = rehabilitaciones.cedula and rehabilitaciones.status = 'inactivo'
                 ");
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
                beneficiario.atencion_solicitada, rehabilitaciones.id, rehabilitaciones.status  FROM beneficiario, rehabilitaciones 
                WHERE beneficiario.cedula = rehabilitaciones.cedula and rehabilitaciones.status = 'activo'
                 ");
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
		public function consultarTodasCitasCerradas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, 
                beneficiario.atencion_solicitada, rehabilitaciones.id, rehabilitaciones.status  FROM beneficiario, rehabilitaciones 
                WHERE beneficiario.cedula = rehabilitaciones.cedula and rehabilitaciones.status = 'Caso cerrado'
                 ");
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

				$stmt = $this->cnn->prepare("UPDATE audiometria SET fecha = :fecha, descripcion = :descripcion, status = 'cita dada'
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':fecha', $this->fecha);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':descripcion', $this->descripcion);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}
		public function modificarCitaDada(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE audiometria SET fecha = :fecha, descripcion = :descripcion
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
				$stmt->bindParam(':fecha', $this->fecha);
                $stmt->bindParam(':id', $this->id);
                $stmt->bindParam(':descripcion', $this->descripcion);
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

				// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
				return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				echo "Error: ejecutando consulta SQL.".$error->getMessage();
				exit();
	        } 

		}
		public function cargar_nuevo_estado(){

			try{	

				$stmt = $this->cnn->prepare("UPDATE audiometria SET status = 'Audiometria completada'
                                             WHERE id = :id");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':id', $this->id);
             
				// Ejecutamos
				$stmt->execute();

				// Numero de Filas Afectadas
			/* 	echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

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