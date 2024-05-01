<?php 
include_once("ManejadorBD.php");
class Estados extends ManejadorBD{

    private $id_estados;
    private $nombre;


    private $cnn;


    public function __construct($tipoConexion){
        $this->cnn = parent::conectar($tipoConexion);
    }

    public function __destruct(){ 
        parent::cerrarConexion(); 
    }

    public function getid_estados()
    {
        return $this->id_estados;
    }
    public function setid_estados($id_estados)
    {
        $this->id_estados = $id_estados;		    
    }


    public function getnombre()
    {
        return $this->nombre;
    }
    public function setnombre($nombre)
    {
        $this->nombre = $nombre;		    
    }



    public function insertarEstados(){
        try{	

            $stmt = $this->cnn->prepare("INSERT INTO estados ( id_estados, nombre) 
                                         VALUES ( :id_estados, :nombre)");
            
            // Asignamos valores a los parametros
            $stmt->bindParam(':id_estados', $this->id_estados);
            $stmt->bindParam(':nombre', $this->nombre);
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

    public function autenticarEstados(){ 
        try{	

            $stmt = $this->cnn->prepare("SELECT * FROM estados WHERE id_estados = :id_estados");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
            // Asiganmos valores a los parametros
            $stmt->bindParam(':id_estados', $this->id_estados);
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
    public function consultarEstados(){
        try{	

            $stmt = $this->cnn->prepare("SELECT * FROM estados WHERE id_estados = :id_estados");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
            // Asiganmos valores a los parametros
            $stmt->bindParam(':id_estados', $this->id_estados);
            // Ejecutamos
            $stmt->execute();

            // Numero de Filas Afectadas
            echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>";

            // Devuelve los resultados obtenidos
            return $stmt->fetch();	

        }catch(PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL.".$error->getMessage();
            exit();
        } 
    }

    public function consultarTodosEstados(){

        try{	

            $stmt = $this->cnn->prepare("SELECT * FROM estados");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
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
    public function modificarEstados(){

        try{	

            $stmt = $this->cnn->prepare("UPDATE estados SET id_estados = :id_estados, nombre = :nombre,
                                        WHERE nombre = :nombre");
            
            // Asignamos valores a los parametros
            $stmt->bindParam(':id_estados', $this->id_estados);
            $stmt->bindParam(':nombre', $this->nombre);
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

    public function eliminarEstados(){

        try{	

            $stmt = $this->cnn->prepare("DELETE FROM estados WHERE id_estados = :id_estados");
            
            // Asiganmos valores a los parametros
            $stmt->bindParam(':id_estados', $this->id_estados);
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