<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Discapacitados extends ManejadorBD
{
	/* ================================== */
	private $nombre;
	private $apellido;
	private $email;
	private $telefono;
	private $fecha_naci;
	private $cedula;
	private $edad;
	private $hijos;
	private $civil;
	private $cod_carnet;
	private $direccion;
	private $atencion_solicitada;
	private $estado;
	private $municipio;
	private $parroquia;
	private $discapacidad;
	private $registrado_por;
	private $fecha_registro;
	private $sexo;
	private $nacionalidad;





	private $cnn;
	/*===============================  */

	public function __construct($tipoConexion)
	{
		$this->cnn = parent::conectar($tipoConexion);
	}

	public function __destruct()
	{
		parent::cerrarConexion();
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


	public function getfecha_naci()
	{
		return $this->fecha_naci;
	}
	public function setfecha_naci($fecha_naci)
	{
		$this->fecha_naci = $fecha_naci;
	}


	public function getedad()
	{
		return $this->edad;
	}
	public function setedad($edad)
	{
		$this->edad = $edad;
	}

	public function gethijos()
	{
		return $this->hijos;
	}
	public function sethijos($hijos)
	{
		$this->hijos = $hijos;
	}

	public function getcivil()
	{
		return $this->civil;
	}
	public function setcivil($civil)
	{
		$this->civil = $civil;
	}


	public function getemail()
	{
		return $this->email;
	}
	public function setemail($email)
	{
		$this->email = $email;
	}


	public function gettelefono()
	{
		return $this->telefono;
	}
	public function settelefono($telefono)
	{
		$this->telefono = $telefono;
	}


	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}


	public function getcod_carnet()
	{
		return $this->cod_carnet;
	}
	public function setcod_carnet($cod_carnet)
	{
		$this->cod_carnet = $cod_carnet;
	}

	public function getsexo()
	{
		return $this->sexo;
	}
	public function setsexo($sexo)
	{
		$this->sexo = $sexo;
	}


	/*  public function getdireccion()
		{
		    return $this->direccion;
		}
		public function setdireccion ($direccion)
		{
		    $this->direccion = $direccion;		    
		}
 */


	public function getatencion_solicitada()
	{
		return $this->atencion_solicitada;
	}
	public function setatencion_solicitada($atencion_solicitada)
	{
		$this->atencion_solicitada = $atencion_solicitada;
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


	/*  */
	public function getdiscapacidad()
	{
		return $this->discapacidad;
	}
	public function setdiscapacidad($discapacidad)
	{
		$this->discapacidad = $discapacidad;
	}

	public function getregistrado_por()
	{
		return $this->registrado_por;
	}
	public function setregistrado_por($registrado_por)
	{
		$this->registrado_por = $registrado_por;
	}

	public function getfecha_registro()
	{
		return $this->fecha_registro;
	}
	public function setfecha_registro($fecha_registro)
	{
		$this->fecha_registro = $fecha_registro;
	}


	public function getnacionalidad()
	{
		return $this->nacionalidad;
	}
	public function setnacionalidad($nacionalidad)
	{
		$this->nacionalidad = $nacionalidad;
	}




	public function insertarDiscapacitados()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO beneficiario (cedula, nombre, apellido, fecha_naci, email, telefono,nacionalidad, edad,sexo, edo_civil, nro_hijo, estado, municipio, parroquia, discapacidad, atencion_solicitada, certificado, registrado_por, fecha_registro ) 
											VALUES (:cedula, :nombre, :apellido, :fecha_naci, :email, :telefono,:nacionalidad, :edad,:sexo, :edo_civil, :nro_hijo, :estado, :municipio, :parroquia, :discapacidad, :atencion_solicitada, :certificado, :registrado_por, :fecha_registro )");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':apellido', $this->apellido);
			$stmt->bindParam(':fecha_naci', $this->fecha_naci);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':nacionalidad', $this->nacionalidad);
			$stmt->bindParam(':edad', $this->edad);
			$stmt->bindParam(':edo_civil', $this->civil);
			$stmt->bindParam(':nro_hijo', $this->hijos);
			$stmt->bindParam(':estado', $this->estado);
			$stmt->bindParam(':municipio', $this->municipio);
			$stmt->bindParam(':parroquia', $this->parroquia);
			$stmt->bindParam(':discapacidad', $this->discapacidad);
			$stmt->bindParam(':atencion_solicitada', $this->atencion_solicitada);
			$stmt->bindParam(':certificado', $this->cod_carnet);
			$stmt->bindParam(':registrado_por', $this->registrado_por);
			$stmt->bindParam(':fecha_registro', $this->fecha_registro);
			$stmt->bindParam(':sexo', $this->sexo);
			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function insertarCopiaCedula($archivo, $cedula)
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO  copiascedula (cedula, archivo) 
											VALUES (:cedula, :archivo)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':archivo', $archivo);

			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function insertarPartidaNacimiento($archivo, $cedula)
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO  partida_nacimiento (cedula, archivo) 
											VALUES (:cedula, :archivo)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':archivo', $archivo);

			/* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function ConsultarCopiaCedula($cedula)
	{
		try {

			$stmt = $this->cnn->prepare(" SELECT *  FROM copiascedula WHERE cedula = :cedula");

			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function ConsultarPartidaNacimiento($cedula)
	{
		try {

			$stmt = $this->cnn->prepare(" SELECT *  FROM partida_nacimiento WHERE cedula = :cedula");

			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetch();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function autenticarAdministrador()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM dispacitados WHERE cedula = :cedula AND passwordd = :passwordd");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>";

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function consultarDiscapacitados()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT 
			beneficiario.nombre, 
			beneficiario.cedula, 
			beneficiario.apellido, 
			beneficiario.fecha_naci, 
			beneficiario.email, 
			beneficiario.telefono, 
			beneficiario.edad, 
			beneficiario.sexo, 
			beneficiario.edo_civil,
			beneficiario.estado, 
			beneficiario.municipio,
			beneficiario.parroquia,
			beneficiario.nro_hijo, 
			estados.nombre_estado, 
			municipios.nombre AS nombre_municipio, 
			parroquia.nombre_parroquia, 
			discapacid_e.nombre_e,
            discapacid_e.id_e,
			beneficiario.certificado, 
			beneficiario.registrado_por, 
			beneficiario.fecha_registro,
            discapacid.id_disca,
            discapacid.nombre_discapacidad
		FROM 
			beneficiario
			JOIN estados ON beneficiario.estado = estados.id_estados
			JOIN municipios ON beneficiario.municipio = municipios.id_municipios
			JOIN parroquia ON beneficiario.parroquia = parroquia.id
			JOIN discapacid_e ON beneficiario.discapacidad = discapacid_e.id_e
            join discapacid on discapacid_e.general = discapacid.id_disca
		WHERE 
			beneficiario.cedula = :cedula;
		");
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultarDirecciones()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT `descripcion` FROM `direcciones` WHERE cedula = :cedula");
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			/* echo "Error: ejecutando consulta SQL." . $error->getMessage(); */
			echo "No tiene dirección";
			exit();
		}
	}

	public function consultarDiscapacitadosP()
	{
		try {

			$stmt = $this->cnn->prepare('SELECT nombre, apellido, cedula FROM beneficiario WHERE cedula like :cedula"%" or nombre like :cedula"%" or apellido like :cedula"%" ');
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}


	public function consultageneral()
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, estados.nombre_estado, discapacid_e.nombre_e , beneficiario.telefono, beneficiario.edad, beneficiario.email, beneficiario.certificado, beneficiario.registrado_por FROM `beneficiario`,estados, discapacid_e WHERE beneficiario.estado = estados.id_estados AND beneficiario.discapacidad = discapacid_e.id_e");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	//PAGINAR AUTOMATICAMENTE
	/* public function consultageneral1() 
	{
		// Establecer la cantidad de elementos por página
		$elementosPorPagina =25;

		try {
			// Obtener el número de página actual
			if (isset($_GET['pagina'])) {
				$paginaActual = $_GET['pagina'];
			} else {
				$paginaActual = 1;
			}

			// Calcular el offset para la consulta SQL
			$offset = ($paginaActual - 1) * $elementosPorPagina;

			// Consulta SQL para obtener los registros paginados
			$sql = "SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, estados.nombre_estado, discapacid_e.nombre_e, beneficiario.telefono, beneficiario.edad, beneficiario.email, beneficiario.certificado, beneficiario.registrado_por 
			FROM beneficiario, estados, discapacid_e WHERE beneficiario.estado = estados.id_estados AND beneficiario.discapacidad = discapacid_e.id_e ORDER BY beneficiario.nombre";
			$stmt = $this->cnn->prepare($sql);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();

			// Obtener los resultados de la consulta
			$resultados = $stmt->fetchAll();

			// Calcular el número total de páginas
			$sqlTotal = "SELECT COUNT(*) as total FROM beneficiario";
			$stmtTotal = $this->cnn->prepare($sqlTotal);
			$stmtTotal->execute();
			$filaTotal = $stmtTotal->fetch(PDO::FETCH_ASSOC);
			$totalElementos = $filaTotal['total'];
			$totalPaginas = ceil($totalElementos / $elementosPorPagina);

			// Construir arreglo que contiene los resultados y la información de paginación
			$datosPaginacion = array(
				'resultados' => $resultados,
				'totalPaginas' => $totalPaginas,
				'paginaActual' => $paginaActual,
				'total'=> $sql
			);

			// Devolver los resultados y la información de paginación
			return $datosPaginacion;
		} catch (PDOException $error) {
			// Mostrar un mensaje de error específico.
			echo "Error: ejecutando consulta SQL. " . $error->getMessage();
			exit();
		}
	} */


	public function PersonasProteccionSocial()
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare("SELECT beneficiario.cedula, beneficiario.nombre, beneficiario.apellido, beneficiario.telefono, estados.nombre_estado, detalles_institucionales.proteccion_social FROM 
				beneficiario, estados, detalles_institucionales WHERE 
				beneficiario.estado = estados.id_estados and 
				beneficiario.cedula = detalles_institucionales.cedula");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function emprendimientos()
	{

		try {

			/* ACTU */
			$stmt = $this->cnn->prepare("SELECT detalles_emprendimiento.nombre_emprendimiento, detalles_emprendimiento.cedula, detalles_emprendimiento.rif_emprendimiento, detalles_emprendimiento.area_comercial, beneficiario.nombre, beneficiario.apellido FROM
				 `detalles_emprendimiento`, beneficiario WHERE 
				 beneficiario.cedula = detalles_emprendimiento.cedula and 
				 `nombre_emprendimiento`!='' and rif_emprendimiento !=''");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function consultageneralsincarnet()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cedula, nombre, apellido, estados.nombre_estado, discapacid_e.nombre_e , telefono, edad, email, certificado FROM `beneficiario` , estados, discapacid_e WHERE certificado = ''and beneficiario.estado = estados.id_estados and beneficiario.discapacidad = discapacid_e.id_e; ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}



	public function consultarTodosDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cedula, nombre, apellido, estado, discapacidad FROM `beneficiario` WHERE 1");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function modificarDiscapacitados()
	{
		try {
			$stmt = $this->cnn->prepare("UPDATE beneficiario SET 
                                        nombre = :nombre, 
                                        apellido = :apellido, 
                                        fecha_naci = :fecha_naci, 
                                        email = :email, 
                                        telefono = :telefono, 
                                        edad = :edad,
                                        sexo = :sexo,
                                        edo_civil = :edo_civil, 
                                        nro_hijo = :nro_hijo, 
                                        estado = :estado, 
                                        municipio = :municipio, 
                                        parroquia = :parroquia, 
                                        discapacidad = :discapacidad, 
                                        certificado = :certificado
                                        
                                    WHERE cedula = :cedula");

			// Asignamos valores a los parámetros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':apellido', $this->apellido);
			$stmt->bindParam(':fecha_naci', $this->fecha_naci);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':edad', $this->edad);
			$stmt->bindParam(':sexo', $this->sexo);
			$stmt->bindParam(':edo_civil', $this->civil);
			$stmt->bindParam(':nro_hijo', $this->hijos);
			$stmt->bindParam(':estado', $this->estado);
			$stmt->bindParam(':municipio', $this->municipio);
			$stmt->bindParam(':parroquia', $this->parroquia);
			$stmt->bindParam(':discapacidad', $this->discapacidad);
			$stmt->bindParam(':certificado', $this->cod_carnet);

			// Ejecutamos
			$exito = $stmt->execute();
			echo $this->getnombre() . " " . $this->getapellido() . " Se ha modificado correctamente";

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se modificó correctamente el registro

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}




	public function eliminarDiscapacitados()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM beneficiario WHERE cedula = :cedula");

			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}




	/* CODIGO DE PRUEBA */

	public function buscar()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT cedula, nombre, apellido, estado, discapacidad FROM `beneficiario` WHERE 1");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}






	public function Detalles_institucionales()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM `detalles_institucionales` WHERE cedula = :cedula");
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}


	public function Detalles_emprendimiento()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM `detalles_emprendimiento` WHERE cedula = :cedula");
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function detalles_cuidador()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM `detalles_cuidador` WHERE cedula = :cedula");
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
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function historico()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT 
			atenciones.numero_aten, 
			tipo_ayuda_tecnica.nombre_tipoayuda, 
			atenciones.archivo, 
			atenciones.fecha_aten as fecha_atencion,
			NULL as año_solicitud,
			NULL as fecha_solicitud,
			NULL as atencion_solicitada
			
		FROM 
			
			atenciones 
			JOIN tipo_ayuda_tecnica ON atenciones.atencion_recibida = tipo_ayuda_tecnica.id 
		WHERE 
			atenciones.cedula = :cedula AND 
			atenciones.fecha_aten IS NOT NULL 
		UNION ALL
		SELECT 
			atenciones.numero_aten, 
			NULL as nombre_tipoayuda, 
			NULL as archivo, 
			null as fecha_atencion,
			YEAR(atenciones.fecha_creada) as año_solicitud, 
			atenciones.fecha_creada as fecha_solicitud,
			atenciones.atencion_solicitada
		FROM 
			atenciones
			
		WHERE
			atenciones.cedula = :cedula AND
			atenciones.fecha_aten IS NULL ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 			echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function historicoOP()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT 
			atenciones_coordinaciones.numero_aten, 
			tipo_ayuda_tecnica.nombre_tipoayuda, 
			atenciones_coordinaciones.archivo, 
			atenciones_coordinaciones.fecha_aten as fecha_atencion,
			NULL as año_solicitud,
			NULL as fecha_solicitud,
			NULL as atencion_solicitada,
			coordinaciones_estadales.nombre_coordinacion
		FROM 
			usuario,coordinaciones_estadales,
			atenciones_coordinaciones 
			JOIN tipo_ayuda_tecnica ON atenciones_coordinaciones.atencion_recibida = tipo_ayuda_tecnica.id 
		WHERE 
			atenciones_coordinaciones.cedula = :cedula AND 
			atenciones_coordinaciones.fecha_aten IS NOT NULL AND
			usuario.cedula = atenciones_coordinaciones.por AND
			usuario.coordinacion = coordinaciones_estadales.id
		UNION ALL
		SELECT 
			atenciones_coordinaciones.numero_aten, 
			NULL as nombre_tipoayuda, 
			NULL as archivo, 
			null as fecha_atencion,
			YEAR(atenciones_coordinaciones.fecha_creada) as año_solicitud, 
			atenciones_coordinaciones.fecha_creada as fecha_solicitud,
			atenciones_coordinaciones.atencion_solicitada,
			coordinaciones_estadales.nombre_coordinacion
		FROM 
			atenciones_coordinaciones, 
			usuario, 
			coordinaciones_estadales 
		WHERE
			atenciones_coordinaciones.cedula = :cedula AND
			atenciones_coordinaciones.fecha_aten IS NULL AND
			usuario.cedula = atenciones_coordinaciones.asignado AND
			usuario.coordinacion = coordinaciones_estadales.id;");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 			echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function SolicitudesHistoricoOP()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT atenciones_coordinaciones.numero_aten, YEAR(atenciones_coordinaciones.fecha_creada) as año, atenciones_coordinaciones.fecha_creada, atenciones_coordinaciones.atencion_solicitada, 
			coordinaciones_estadales.nombre_coordinacion
			FROM atenciones_coordinaciones, usuario, coordinaciones_estadales WHERE
			atenciones_coordinaciones.cedula = :cedula and
			fecha_aten is null AND
			usuario.cedula = atenciones_coordinaciones.asignado AND
			usuario.coordinacion = coordinaciones_estadales.id");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			/* 			echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function EliminarFotoCedula($id)
	{
		try {

			$stmt = $this->cnn->prepare("DELETE FROM copiascedula WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()

			// Asiganmos valores a los parametros
			$stmt->bindParam(':id', $id);
			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $exito;
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function EliminarPartidaNacimiento($id)
	{
		try {

			$stmt = $this->cnn->prepare("DELETE FROM partida_nacimiento WHERE id = :id");
			// Especificamos el fetch mode antes de llamar a fetch()

			// Asiganmos valores a los parametros
			$stmt->bindParam(':id', $id);
			// Ejecutamos
			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $exito;
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
}
