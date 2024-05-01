<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class Usuario extends ManejadorBD
{
	/* ================================== */
	private $cedula;
	private $passwordd;
	private $nombre;
	private $email;
	private $telefono;
	private $sexo;
	private $gerencia;
	private $rol;
	private $coordinacion;



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


	public function getcedula()
	{
		return $this->cedula;
	}
	public function setcedula($cedula)
	{
		$this->cedula = $cedula;
	}

	public function getcoordinacion()
	{
		return $this->coordinacion;
	}
	public function setcoordinacion($coordinacion)
	{
		$this->coordinacion = $coordinacion;
	}

	public function getnombre()
	{
		return $this->nombre;
	}
	public function setnombre($nombre)
	{
		$this->nombre = $nombre;
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



	public function getpasswordd()
	{
		return $this->passwordd;
	}
	public function setpasswordd($passwordd)
	{
		$this->passwordd = $passwordd;
	}


	public function getsexo()
	{
		return $this->sexo;
	}
	public function setsexo($sexo)
	{
		$this->sexo = $sexo;
	}



	public function getgerencia()
	{
		return $this->gerencia;
	}
	public function setgerencia($gerencia)
	{
		$this->gerencia = $gerencia;
	}


	public function getrol()
	{
		return $this->rol;
	}
	public function setrol($rol)
	{
		$this->rol = $rol;
	}




	public function insertarUsuarios()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO usuario (cedula, passwordd, nombre, email, telefono, sexo, gerencia, rol) 
											 VALUES (:cedula, :passwordd, :nombre, :email, :telefono, :sexo, :gerencia, :rol)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':passwordd', $this->passwordd);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':sexo', $this->sexo);
			$stmt->bindParam(':gerencia', $this->gerencia);
			$stmt->bindParam(':rol', $this->rol);


			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			/* echo "Error: ejecutando consulta SQL.".$error->getMessage(); */
			echo "error";
			exit();
		}
	}


	public function insertarUsuariosDecoordinacion()
	{
		try {

			$stmt = $this->cnn->prepare("INSERT INTO usuario (cedula, passwordd, nombre, email, telefono, sexo, gerencia, rol, coordinacion) 
											 VALUES (:cedula, :passwordd, :nombre, :email, :telefono, :sexo, :gerencia, :rol, :coordinacion)");

			// Asignamos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':passwordd', $this->passwordd);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':sexo', $this->sexo);
			$stmt->bindParam(':gerencia', $this->gerencia);
			$stmt->bindParam(':rol', $this->rol);
			$stmt->bindParam(':coordinacion', $this->coordinacion);

			$exito = $stmt->execute();

			// Numero de Filas Afectadas
			/* echo "<br>Se Afecto: ".$stmt->rowCount()." Registro<br>"; */

			// Devuelve los resultados obtenidos
			return $exito; // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			/* echo "Error: ejecutando consulta SQL.".$error->getMessage(); */
			echo "error";
			exit();
		}
	}

	public function autenticarUsuarios()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM usuario WHERE cedula = :cedula AND passwordd = :passwordd");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
			$stmt->bindParam(':passwordd', $this->passwordd);
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
	public function consultarUsuarios()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM usuario WHERE cedula = :cedula");
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

	public function EliminarFotoPerfil()
	{
		try {

			$stmt = $this->cnn->prepare("UPDATE usuario SET profile_photo = NULL WHERE cedula = :cedula");
			// Especificamos el fetch mode antes de llamar a fetch()
			
			// Asiganmos valores a los parametros
			$stmt->bindParam(':cedula', $this->cedula);
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




	public function consultarUsuariosOAC()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT usuario.cedula, usuario.nombre, atenciones.numero_aten, atenciones.cedula  as beneficiarioCedula FROM `atenciones`, usuario WHERE atenciones.atencion_recibida is NOT null and usuario.cedula = atenciones.por and usuario.gerencia =:gerencia");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':gerencia', $this->gerencia);
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
	public function consultarUsuariosTotal()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT * FROM  usuario WHERE usuario.gerencia =:gerencia");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':gerencia', $this->gerencia);
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

	public function Total_atencion_por_usuario()
	{
		try {

			$stmt = $this->cnn->prepare("SELECT usuario.cedula, usuario.nombre, COUNT(atenciones.por) as numero FROM `atenciones`, usuario WHERE atenciones.atencion_recibida is NOT null and usuario.cedula = atenciones.por and usuario.gerencia = :gerencia GROUP BY (atenciones.por) ");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Asiganmos valores a los parametros
			$stmt->bindParam(':gerencia', $this->gerencia);
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

	public function consultarTodosUsuarios()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM usuario");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
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
	public function ben_eliminados()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM ben_eliminados");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
	/* 		echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function reg_beneficiario()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM reg_beneficiario");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
	/* 		echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function mod_beneficiario()
	{

		try {

			$stmt = $this->cnn->prepare("SELECT * FROM modificaciones_beneficiarios");
			// Especificamos el fetch mode antes de llamar a fetch()
			$stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
	/* 		echo "<br>Se devolvieron: " . $stmt->rowCount() . " Registros<br>"; */

			// Devuelve los resultados obtenidos
			return $stmt->fetchAll();
		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function modificarUsuarios()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE usuario SET passwordd = :passwordd, nombre = :nombre,
                                            email = :email, telefono = :telefono,  sexo = :sexo, gerencia = :gerencia, rol = :rol, estado = :estado WHERE cedula = :cedula");

			// Asignamos valores a los parametros
			$stmt->bindParam(':passwordd', $this->passwordd);
			$stmt->bindParam(':nombre', $this->nombre);
			$stmt->bindParam(':email', $this->email);
			$stmt->bindParam(':telefono', $this->telefono);
			$stmt->bindParam(':sexo', $this->sexo);
			$stmt->bindParam(':gerencia', $this->gerencia);
			$stmt->bindParam(':rol', $this->rol);

			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas
			echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>";

			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	function DetectarContraseñaPorDefecto($cedula)
	{
		// Contraseña por defecto
		$contraseñaPorDefecto = "12345";
		$this->setcedula($cedula);
		$consulta = $this->consultarUsuarios();

		// Verificar si la contraseña del usuario coincide con la contraseña por defecto
		if (password_verify($contraseñaPorDefecto, $consulta["passwordd"])) {
			return true;
		} else {
			return false;
		}
	}

	public function CambiarContraseña()
	{

		try {

			$stmt = $this->cnn->prepare("UPDATE usuario SET passwordd = :passwordd
                                             WHERE cedula = :cedula");

			// Asignamos valores a los parametros
			$stmt->bindParam(':passwordd', $this->passwordd);
			$stmt->bindParam(':cedula', $this->cedula);


			// Ejecutamos
			$stmt->execute();

			// Numero de Filas Afectadas


			// Devuelve los resultados obtenidos 1:Exitoso, 0:Fallido
			return $stmt->rowCount(); // si es verdadero se insertó correctamente el registro	

		} catch (PDOException $error) {
			// Mostramos un mensaje genérico de error.
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function eliminarUsuarios()
	{

		try {

			$stmt = $this->cnn->prepare("DELETE FROM usuario WHERE cedula = :cedula");

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
	public function bloquearUsuario()
	{
		try {
			$stmt = $this->cnn->prepare("UPDATE usuario SET bloqueado = 1 WHERE cedula = :cedula");
			$stmt->bindParam(':cedula', $this->cedula);
			$exito = $stmt->execute();
			return $exito;
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}

	public function cambiarEstadoBloqueo($cedula, $nuevoEstado)
	{
		try {
			$stmt = $this->cnn->prepare("UPDATE usuario SET bloqueado = :nuevoEstado WHERE cedula = :cedula");
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':nuevoEstado', $nuevoEstado);
			$exito = $stmt->execute();
			return $exito;
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
	public function InsertarFotoPerfil($photo, $cedula)
	{
		try {
			$stmt = $this->cnn->prepare("UPDATE usuario SET profile_photo = :photo WHERE cedula = :cedula");
			$stmt->bindParam(':cedula', $cedula);
			$stmt->bindParam(':photo', $photo);
			$exito = $stmt->execute();
			return $exito;
		} catch (PDOException $error) {
			echo "Error: ejecutando consulta SQL." . $error->getMessage();
			exit();
		}
	}
}




/* $prueba = new Usuario(1); */

/* $prueba->setcedula("30165406");
$prueba->setpasswordd("12345");
$prueba->setnombre("Deiker");
$prueba->setemail("Deiker1842@gmail.com");
$prueba->settelefono("04120183670");
$prueba->setsexo ("Masculino");
$prueba->setgerencia("1");
$prueba->setrol("1"); */

/* $prueba->insertarUsuarios(); */
