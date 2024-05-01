<?php
include_once("ManejadorBD.php");


class modulo extends ManejadorBD{
        /* ================================== */
        private $profesor;
        private $id_curso;
        private $fecha;
		private $hora;
        private $contenido;
        private $nombre_modulo;
        private $modulo;
       
		
        private $cnn;
        /*===============================  */

        public function __construct($tipoConexion){
            $this->cnn = parent::conectar($tipoConexion);
        }

        public function __destruct(){ 
            parent::cerrarConexion(); 
        }

        public function getprofesor()
        {
            return $this->profesor;
        }
		public function setprofesor($profesor)
		{
		    $this->profesor = $profesor;		    
		}


		public function getfecha()
        {
            return $this->fecha;
        }
		public function setfecha($fecha)
		{
		    $this->fecha = $fecha;		    
		}


		public function getid_curso()
        {
            return $this->id_curso;
        }
		public function setid_curso($id_curso)
		{
		    $this->id_curso = $id_curso;		    
		}


		public function gethora()
        {
            return $this->hora;
        }
		public function sethora($hora)
		{
		    $this->hora = $hora;		    
		}

        public function getcontenido()
        {
            return $this->contenido;
        }
		public function setcontenido($contenido)
		{
		    $this->contenido = $contenido;		    
		}

        public function getnombre_modulo()
        {
            return $this->nombre_modulo;
        }
		public function setnombre_modulo($nombre_modulo)
		{
		    $this->nombre_modulo = $nombre_modulo;		    
		}

		
    /*     private $profesor;
        private $id_curso;
        private $fecha;
		private $hora;
        private $contenido;
 */


		public function insertarmodulo(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO modulos_escuela (id_curso, profesor, fecha, hora, nombre_modulo, contenido) 
											VALUES (:id_curso, :profesor, :fecha, :hora,:nombre_modulo, :contenido)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':id_curso', $this->id_curso);
				$stmt->bindParam(':profesor', $this->profesor);
                $stmt->bindParam(':fecha', $this->fecha);
                $stmt->bindParam(':hora', $this->hora);
                $stmt->bindParam(':contenido', $this->contenido);
		        $stmt->bindParam(':nombre_modulo', $this->nombre_modulo);
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				echo "Se Registro modulo correctamente".$this->nombre_modulo;

				// Devuelve los resultados obtenidos
				return $exito; // si es verdadero se insertó correctamente el registro	

	        }catch(PDOException $error) {
			    // Mostramos un mensaje genérico de error.
				/* echo "Error: ejecutando consulta SQL.".$error->getMessage(); */
                echo "No se pudo registrar modulo".$this->nombre_modulo." verifique";
				exit();
	        } 
		}

		public function autenticarMedidas(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM toma_medidas WHERE cedula = :cedula ");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				/* $stmt->bindParam(':cedula', $this->cedula); */
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
		public function consultarModulos(){
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM `modulos_escuela` WHERE id_curso = :id_curso")
            ;
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':id_curso', $this->id_curso);
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

		public function consultarTodasMedidasSindar(){

			try{	

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, beneficiario.atencion_solicitada, toma_medidas.id FROM beneficiario, toma_medidas WHERE beneficiario.cedula = toma_medidas.cedula /* AND beneficiario.atencion_solicitada = '4-tomedi' */ and toma_medidas.medidas IS NULL;");
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

				$stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, beneficiario.discapacidad, beneficiario.atencion_solicitada, toma_medidas.id, toma_medidas.medidas FROM beneficiario, toma_medidas WHERE beneficiario.cedula = toma_medidas.cedula AND /* beneficiario.atencion_solicitada = '4-tomedi' */  toma_medidas.medidas IS NOT NULL;");
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

				$stmt = $this->cnn->prepare("UPDATE toma_medidas SET medidas = :medidas
                                             WHERE id = :id");
				// Asignamos valores a los parametros
			/* 	$stmt->bindParam(':id', $this->id);
				$stmt->bindParam(':medidas', $this->medidas); */
              
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

		

	
		


}
?>