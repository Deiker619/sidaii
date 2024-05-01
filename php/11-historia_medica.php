<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class historia_medica extends ManejadorBD
{
    /* ================================== */
    private $cedula;
    private $id;
    private $fecha_apertura;
    private $fecha_medidas;
    private $artificio_medidas;
    private $diseno;
    private $zona_del_lado;
    private $lado_afectado;
    private $nervio_afectado;
    private $artificio;
    private $solicitud;
    private $clasificacion_de_ortesis;
    private $clasificacion_de_material;
    private $codigo_cita;
 
    /* private $cedula;
        private $fecha_aten;
        private $atencion_recibida ; */






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




    public function getid()
    {
        return $this->id;
    }
    public function setid($id)
    {
        $this->id = $id;
    }





    public function getfecha_apertura()
    {
        return $this->fecha_apertura;
    }
    public function setfecha_apertura($fecha_apertura)
    {
        $this->fecha_apertura = $fecha_apertura;
    }

    public function getfecha_medidas()
    {
        return $this->fecha_medidas;
    }
    public function setfecha_medidas($fecha_medidas)
    {
        $this->fecha_medidas = $fecha_medidas;
    }



    public function getartificio_medidas()
    {
        return $this->artificio_medidas;
    }
    public function setartificio_medidas($artificio_medidas)
    {
        $this->artificio_medidas = $artificio_medidas;
    }

    public function getartificio()
    {
        return $this->artificio;
    }
    public function setartificio($artificio)
    {
        $this->artificio = $artificio;
    }

    public function getdiseno()
    {
        return $this->diseno;
    }
    public function setdiseno($diseno)
    {
        $this->diseno = $diseno;
    }


    public function getzona_del_lado()
    {
        return $this->zona_del_lado;
    }
    public function setzona_del_lado($zona_del_lado)
    {
        $this->zona_del_lado = $zona_del_lado;
    }
    public function getlado_afectado()
    {
        return $this->lado_afectado;
    }
    public function setlado_afectado($lado_afectado)
    {
        $this->lado_afectado = $lado_afectado;
    }


    public function getnervio_afectado()
    {
        return $this->nervio_afectado;
    }
    public function setnervio_afectado($nervio_afectado)
    {
        $this->nervio_afectado = $nervio_afectado;
    }


    public function getsolicitud()
    {
        return $this->solicitud;
    }
    public function setsolicitud($solicitud)
    {
        $this->solicitud = $solicitud;
    }


    public function getclasificacion_de_ortesis()
    {
        return $this->clasificacion_de_ortesis;
    }
    public function setclasificacion_de_ortesis($clasificacion_de_ortesis)
    {
        $this->clasificacion_de_ortesis = $clasificacion_de_ortesis;
    }


    public function getclasificacion_de_material()
    {
        return $this->clasificacion_de_material;
    }
    public function setclasificacion_de_material($clasificacion_de_material)
    {
        $this->clasificacion_de_material = $clasificacion_de_material;
    }

    public function getcodigo_cita()
		{
		    return $this->codigo_cita;
		}
		public function setcodigo_cita($codigo_cita)
		{
		    $this->codigo_cita = $codigo_cita;		    
		}


    public function insertarHistoriaOrtesis()
    {
        try {

            $stmt = $this->cnn->prepare("INSERT INTO `historia_medica`(cedula, artificio, artificio_medidas, diseño, lado_afectado, zona_del_lado, nervio, fecha_medidas, fecha_apertura, solicitud, codigo_cita) 
            VALUES (:cedula, :artificio, :artificio_medidas, :diseno, :lado_afectado, :zona_del_lado, :nervio, :fecha_medidas, :fecha_apertura, :solicitud, :codigo_cita)");

            // Asignamos valores a los parametros
            $stmt->bindParam(':cedula', $this->cedula);
            $stmt->bindParam(':artificio', $this->artificio);
            $stmt->bindParam(':artificio_medidas', $this->artificio_medidas);
            $stmt->bindParam(':diseno', $this->diseno);
            $stmt->bindParam(':lado_afectado', $this->lado_afectado);
            $stmt->bindParam(':zona_del_lado', $this->zona_del_lado);
            $stmt->bindParam(':nervio', $this->nervio_afectado);
            $stmt->bindParam(':fecha_medidas', $this->fecha_medidas);
            $stmt->bindParam(':fecha_apertura', $this->fecha_apertura);
            $stmt->bindParam(':solicitud', $this->solicitud);
             $stmt->bindParam(':codigo_cita', $this->codigo_cita);
            /* $stmt->bindParam(':direccion', $this->direccion);
				$stmt->bindParam(':tipoasistencia', $this->tipoasistencia);
				$stmt->bindParam(':estado', $this->estado); */

            // Ejecutamos
            $exito = $stmt->execute();

            // Numero de Filas Afectadas
            echo "<br>Se Afecto: " . $stmt->rowCount() . " Registro<br>";

            // Devuelve los resultados obtenidos
            return $exito; // si es verdadero se insertó correctamente el registro	

        } catch (PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL." . $error->getMessage();
            exit();
        }
    }

    public function Modificar_al_cargar_HM(){

        try{	

            $stmt = $this->cnn->prepare("UPDATE cita_ortesis_protesis SET fecha_cita = :fecha_cita
            WHERE id = :id");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':fecha_cita', $this->fecha_medidas);
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

    public function autenticarMedidas()
    {
        try {

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
        } catch (PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL." . $error->getMessage();
            exit();
        }
    }
    public function ConsultarHistoria()
    {
        try {

            $stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, 
            beneficiario.discapacidad, beneficiario.fecha_naci, beneficiario.telefono, beneficiario.edad, beneficiario.sexo,
             beneficiario.estado, beneficiario.municipio, beneficiario.parroquia, 
            historia_medica.artificio, historia_medica.artificio_medidas, historia_medica.diseño, 
            historia_medica.lado_afectado, historia_medica.zona_del_lado, historia_medica.nervio, 
            historia_medica.tecnico, historia_medica.solicitud, historia_medica.codigo_cita, historia_medica.fecha_apertura, historia_medica.fecha_medidas, historia_medica.clasificacion
            from beneficiario, historia_medica WHERE historia_medica.codigo_cita = :codigo_cita and beneficiario.cedula = historia_medica.cedula");
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
        } catch (PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL." . $error->getMessage();
            exit();
        }
    }

    public function consultarTodasMedidasSindar()
    {

        try {

            $stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, beneficiario.atencion_solicitada, toma_medidas.id FROM beneficiario, toma_medidas WHERE beneficiario.cedula = toma_medidas.cedula /* AND beneficiario.atencion_solicitada = '4-tomedi' */ and toma_medidas.artificio IS NULL;");
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

    public function consultarTodasMedidasDadas()
    {

        try {

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
        } catch (PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL." . $error->getMessage();
            exit();
        }
    }


    public function consultarTodasAyudas_tecRecibidas()
    {

        try {

            $stmt = $this->cnn->prepare("SELECT beneficiario.nombre, beneficiario.apellido, beneficiario.cedula, atenciones.numero_aten, ayudas_tec.id, ayudas_tec.tipo_ayuda_tec FROM `ayudas_tec`, beneficiario, atenciones WHERE ayudas_tec.numero_aten = atenciones.numero_aten and beneficiario.cedula = atenciones.cedula AND atenciones.atencion_recibida = '-ayudatec' AND ayudas_tec.tipo_ayuda_tec IS NOT NULL;");
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


    public function modificarMedidas()
    {

        try {

            $stmt = $this->cnn->prepare("UPDATE toma_medidas SET medidas = :medidas, artificio = :artificio,
											fecha_medidas = :fecha_medidas
                                             WHERE id = :id");
            // Asignamos valores a los parametros
           /*  $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':artificio', $this->artificio);
            $stmt->bindParam(':medidas', $this->medidas);
            $stmt->bindParam(':fecha_medidas', $this->fecha_medidas);
 */
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



    public function eliminarDiscapacitados()
    {

        try {

            $stmt = $this->cnn->prepare("DELETE FROM discapacitados WHERE numero_aten = :numero_aten");

            // Asiganmos valores a los parametros
            /* $stmt->bindParam(':numero_aten', $this->numero_aten); */
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


    /* ============Consultar todas Protesis para asignar toma de medidas=========================  */


    public function consultarTodasProtesis()
    {

        try {

            $stmt = $this->cnn->prepare("SELECT protesis.id,protesis.nombre FROM protesis WHERE 1");
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


    /* ============Consultar todas Ortesis para asignar toma de medidas=========================  */

    public function consultarTodasOrtesis()
    {

        try {

            $stmt = $this->cnn->prepare("SELECT ortesis.id,ortesis.nombre FROM ortesis WHERE 1");
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
}
