<?php
include_once("ManejadorBD.php");


class participante_escuela extends ManejadorBD{
        /* ================================== */
        private $cedula;
        private $nombre;
		private $apellido;
        private $discapacidad;
        private $id_curso;
        private $telefono;
        private $email;
        private $estado;
        private $municipio;
        private $parroquia;

		private $edad;
        private $fecha_naci;
        private $sexo;
        private $nacionalidad;
		
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


		public function getnombre()
        {
            return $this->nombre;
        }
		public function setnombre($nombre)
		{
		    $this->nombre = $nombre;		    
		}


		public function getapellido()
        {
            return $this->apellido;
        }
		public function setapellido($apellido)
		{
		    $this->apellido = $apellido;		    
		}


		public function getdiscapacidad()
        {
            return $this->discapacidad;
        }
		public function setdiscapacidad($discapacidad)
		{
		    $this->discapacidad = $discapacidad;		    
		}

		
        public function getid_curso()
		{
		    return $this->id_curso;
		}
		public function setid_curso ($id_curso)
		{
		    $this->id_curso = $id_curso;		    
		}



		public function gettelefono()
		{
		    return $this->telefono;
		}
		public function settelefono($telefono)
		{
		    $this->telefono = $telefono;		    
		}

        public function getemail()
		{
		    return $this->email;
		}
		public function setemail($email)
		{
		    $this->email = $email;		    
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

		public function getsexo()
		{
		    return $this->sexo;
		}
		public function setsexo($sexo)
		{
		    $this->sexo = $sexo;		    
		}


		public function getnacionalidad()
		{
		    return $this->nacionalidad;
		}
		public function setnacionalidad($nacionalidad)
		{
		    $this->nacionalidad = $nacionalidad;		    
		}


		public function getedad()
		{
		    return $this->edad;
		}
		public function setedad($edad)
		{
		    $this->edad = $edad;		    
		}


		public function getfecha_naci()
		{
		    return $this->fecha_naci;
		}
		public function setfecha_naci($fecha_naci)
		{
		    $this->fecha_naci = $fecha_naci;		    
		}




		public function insertarParticipante(){
			try{	

				$stmt = $this->cnn->prepare("INSERT INTO `participante_escuela`(`cedula`, `nombre`, `apellido`, `discapacidad`, `id_curso`, `telefono`, `email`, estado, municipio, parroquia, edad, sexo, fecha_nacimiento, nacionalidad
            															) VALUES (:cedula, :nombre, :apellido, :discapacidad, :id_curso, :telefono, :email, :estado, :municipio, :parroquia, :edad, :sexo, :fecha_nacimiento, :nacionalidad)");
				
				// Asignamos valores a los parametros
                $stmt->bindParam(':cedula', $this->cedula);
				$stmt->bindParam(':nombre', $this->nombre);
				$stmt->bindParam(':apellido', $this->apellido);
                $stmt->bindParam(':discapacidad', $this->discapacidad);
				$stmt->bindParam(':telefono', $this->telefono);
				$stmt->bindParam(':email', $this->email);
                $stmt->bindParam(':estado', $this->estado);
				$stmt->bindParam(':municipio', $this->municipio);
				$stmt->bindParam(':parroquia', $this->parroquia);
		        $stmt->bindParam(':id_curso', $this->id_curso);
				$stmt->bindParam(':edad', $this->edad);
				$stmt->bindParam(':sexo', $this->sexo);
				$stmt->bindParam(':fecha_nacimiento', $this->fecha_naci);
		        $stmt->bindParam(':nacionalidad', $this->nacionalidad);
				// Ejecutamos
				$exito = $stmt->execute();

				// Numero de Filas Afectadas
				/* echo "<br>Se realizo el registro: ".$stmt->rowCount()." Registro<br>"; */

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

				$stmt = $this->cnn->prepare("SELECT * FROM participante_escuela WHERE cedula = :cedula");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				$stmt->bindParam(':cedula', $this->cedula);
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
		public function consultarSolicitud(){
			try{	

				$stmt = $this->cnn->prepare("SELECT solicitudes_desarrollo.id, beneficiario.nombre, beneficiario.apellido, 
                beneficiario.cedula, beneficiario.estado ,solicitudes_desarrollo.solicitud FROM 
                beneficiario, solicitudes_desarrollo where solicitudes_desarrollo.id = :id and beneficiario.cedula = solicitudes_desarrollo.cedula");
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				// Asiganmos valores a los parametros
				/* $stmt->bindParam(':id', $this->id); */
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

		public function consultarTodosParticipantes(){

			try{	

				$stmt = $this->cnn->prepare("SELECT participante_escuela.cedula, participante_escuela.nombre , participante_escuela.apellido, participante_escuela.discapacidad, participante_escuela.id_curso, participante_escuela.telefono, participante_escuela.email, estados.nombre_estado, municipios.nombre as nombre_municipio, parroquia.nombre_parroquia 

				FROM `participante_escuela`, estados, municipios, parroquia
				WHERE estados.id_estados = participante_escuela.estado
                and municipios.id_municipios = participante_escuela.municipio
                and parroquia.id = participante_escuela.parroquia 
                and participante_escuela.id_curso = :id_curso" );
				// Especificamos el fetch mode antes de llamar a fetch()
				$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
				$stmt->bindParam(':id_curso', $this->id_curso);
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

		

		public function eliminarDiscapacitados(){

			try{	

				$stmt = $this->cnn->prepare("DELETE FROM discapacitados WHERE numero_aten = :numero_aten");
				
				// Asiganmos valores a los parametros
			/* 	$stmt->bindParam(':numero_aten', $this->numero_aten); */
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