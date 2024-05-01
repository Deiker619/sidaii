<?php
   
	include_once("Config.php"); // Valores de la conexion

	class ManejadorBD extends PDO {

		public $srv	= SRV; // Servidor
		public $usr	= USR; // Usuario
		public $pas	= PAS; // Password
		public $dbn	= BDN; // Base de Datos

		private $conexionBD; // Conexion Base de Database

		public function __construct($tipoConexion) { 
			// Constructor de la clase
		}

		public function conectar($tipoConexion){
			try{
				switch ($tipoConexion) {
				    case 0: // Postgresql
				        $dsn = "pgsql:dbname=$this->dbn;host=$this->srv";
				        $mensaje = "Conexion Exitosa Postgresql<br>";
				        break;
				    case 1: // Mysql
				        $dsn = "mysql:host=$this->srv;dbname=$this->dbn";
				        /* $mensaje = "Conexion Exitosa Mysql<br>"; */
				        break;				    
				}
				$dbh = new PDO($dsn, $this->usr, $this->pas);
    			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Permite manejar los errores
    			/* echo $mensaje; */
			}catch(PDOException $error){
                echo "Error al Conectar con la Base de Datos: ".$error->getMessage();
                exit(); 
			}
            
            $this->conexionBD = $dbh;
			return $this->conexionBD;	
		}

		public function cerrarConexion(){
			$this->conexionBD = null;
		}
	}
?>