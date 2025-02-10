<?php
include_once("ManejadorBD.php");


class escuela extends ManejadorBD{
        /* ================================== */
        private $estado;
        private $municipio;
        private $parroquia;
		private $comunidad;
        private $fecha_inicio;
        private $fecha_final;
        private $tema;
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

        public function getcomunidad()
        {
            return $this->comunidad;
        }
		public function setcomunidad($comunidad)
		{
		    $this->comunidad = $comunidad;		    
		}


		public function getestado()
        {
            return $this->estado;
        }
		public function setestado($estado)
		{
		    $this->estado = $estado;		    
		}


		public function gettema()
        {
            return $this->tema;
        }
		public function settema($tema)
		{
		    $this->tema = $tema;		    
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
		public function setparroquia ($parroquia)
		{
		    $this->parroquia = $parroquia;		    
		}



		public function getfecha_inicio()
		{
		    return $this->fecha_inicio;
		}
		public function setfecha_inicio($fecha_inicio)
		{
		    $this->fecha_inicio = $fecha_inicio;		    
		}

        
		public function getfecha_final()
		{
		    return $this->fecha_final;
		}
		public function setfecha_final($fecha_final)
		{
		    $this->fecha_final = $fecha_final;		    
		}

        public function getid()
		{
		    return $this->id;
		}
		public function setid($id)
		{
		    $this->id = $id;		    
		}

		public function getgerencia()
		{
		    return $this->gerencia;
		}
		public function setgerencia($gerencia)
		{
		    $this->gerencia = $gerencia;		    
		}






		public function insertarescuela($coordinacion){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO escuela_comunitaria (fecha_inicio, fecha_final, tema, comunidad, estado, municipio, parroquia, gerencia, coordinacion) 
											VALUES (:fecha_inicio, :fecha_final, :tema, :comunidad, :estado, :municipio, :parroquia, :gerencia, :coordinacion )");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':fecha_inicio', $this->fecha_inicio);
				$stmt->bindParam(':fecha_final', $this->fecha_final);
                $stmt->bindParam(':tema', $this->tema);
                $stmt->bindParam(':comunidad', $this->comunidad);
                $stmt->bindParam(':estado', $this->estado);
                $stmt->bindParam(':municipio', $this->municipio);
                $stmt->bindParam(':parroquia', $this->parroquia);
                $stmt->bindParam(':gerencia', $this->gerencia);
                $stmt->bindParam(':coordinacion', $coordinacion);
		
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

		public function autenticar(){ 
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM estadoes_encuentro WHERE comunidad = :comunidad AND passwordd = :passwordd");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				/* $stmt->bindParam(':comunidad', $this->comunidad); */
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
		public function consultarescuela(){
			try{	

				$stmt = $this->cnn->prepare("SELECT * FROM `escuela_comunitaria` WHERE id_curso = :id");
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

		public function consultarTodasEscuelas(){

			try{	

				$stmt = $this->cnn->prepare("SELECT escuela_comunitaria.id_curso, escuela_comunitaria.fecha_inicio,escuela_comunitaria.fecha_final,escuela_comunitaria.Tema, escuela_comunitaria.coordinacion, escuela_comunitaria.gerencia ,escuela_comunitaria.comunidad,estados.nombre_estado ,municipios.nombre ,parroquia.nombre_parroquia FROM `escuela_comunitaria`, estados, municipios, parroquia WHERE escuela_comunitaria.estado = estados.id_estados and municipios.id_municipios = escuela_comunitaria.estado and parroquia.id = escuela_comunitaria.parroquia");
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
?>