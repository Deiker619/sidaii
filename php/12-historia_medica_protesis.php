<?php
/* include_once("xampp/htdocs/SIDDAI/php/ManejadorBD.php"); */

include_once("ManejadorBD.php");

class historia_medica_protesis extends ManejadorBD
{
    /* ================================== */
    private $cedula;
    private $id;
    private $fecha_apertura;
    private $fecha_medidas;
    private $codigo_cita;
    private $diseno;
    private $artificio;
    private $nivel_actividad;
    private $lado_amputacion;


    private $nivel_amputacion;
    private $zona_afectada;
    private $caracteristicas_protesis;



    /* Carateristicas de la protesis */
    private $id_historia;
    private $tipo_rodilla;
    private $tipo_pie;
    private $tipo_socket;
    private $clasificacion_socket;
    private $metodo_suspension;


    /* Estado del muñon */
    private $forma;
    private $cicatriz;
    private $piel;
    private $musculatura;







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

    public function getcodigo_cita()
    {
        return $this->codigo_cita;
    }
    public function setcodigo_cita($codigo_cita)
    {
        $this->codigo_cita = $codigo_cita;
    }

    public function getcedula()
    {
        return $this->cedula;
    }
    public function setcedula($cedula)
    {
        $this->cedula = $cedula;
    }


    public function getnivel_actividad()
    {
        return $this->nivel_actividad;
    }
    public function setnivel_actividad($nivel_actividad)
    {
        $this->nivel_actividad = $nivel_actividad;
    }



    public function getlado_amputacion()
    {
        return $this->lado_amputacion;
    }
    public function setlado_amputacion($lado_amputacion)
    {
        $this->lado_amputacion = $lado_amputacion;
    }


    public function getnivel_amputacion()
    {
        return $this->nivel_amputacion;
    }
    public function setnivel_amputacion($nivel_amputacion)
    {
        $this->nivel_amputacion = $nivel_amputacion;
    }


    public function getzona_afectada()
    {
        return $this->zona_afectada;
    }
    public function setzona_afectada($zona_afectada)
    {
        $this->zona_afectada = $zona_afectada;
    }

    public function getdiseno()
    {
        return $this->diseno;
    }
    public function setdiseno($diseno)
    {
        $this->diseno = $diseno;
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





    public function getid()
    {
        return $this->id;
    }
    public function setid($id)
    {
        $this->id = $id;
    }









    public function getartificio()
    {
        return $this->artificio;
    }
    public function setartificio($artificio)
    {
        $this->artificio = $artificio;
    }






    /*  public function getsolicitud()
    {
        return $this->solicitud;
    }
    public function setsolicitud($solicitud)
    {
        $this->solicitud = $solicitud;
    } */









    public function getcaracteristicas_protesis()
    {
        return $this->caracteristicas_protesis;
    }
    public function setcaracteristicas_protesis($caracteristicas_protesis)
    {
        $this->caracteristicas_protesis = $caracteristicas_protesis;
    }

    /* Estado del muñon */

    public function getforma()
    {
        return $this->forma;
    }
    public function setforma($forma)
    {
        $this->forma = $forma;
    }

    public function getcicatriz()
    {
        return $this->cicatriz;
    }
    public function setcicatriz($cicatriz)
    {
        $this->cicatriz = $cicatriz;
    }

    public function getpiel()
    {
        return $this->piel;
    }
    public function setpiel($piel)
    {
        $this->piel = $piel;
    }

    public function getmusculatura()
    {
        return $this->musculatura;
    }
    public function setmusculatura($musculatura)
    {
        $this->musculatura = $musculatura;
    }
    /*_________________________________________________  */

    /* Caracterisiticas de la protesis */
    public function getid_historia()
    {
        return $this->id_historia;
    }
    public function setid_historia($id_historia)
    {
        $this->id_historia = $id_historia;
    }

    public function gettipo_rodilla()
    {
        return $this->tipo_rodilla;
    }
    public function settipo_rodilla($tipo_rodilla)
    {
        $this->tipo_rodilla = $tipo_rodilla;
    }

    public function gettipo_pie()
    {
        return $this->tipo_pie;
    }
    public function settipo_pie($tipo_pie)
    {
        $this->tipo_pie = $tipo_pie;
    }

    public function gettipo_socket()
    {
        return $this->tipo_socket;
    }
    public function settipo_socket($tipo_socket)
    {
        $this->tipo_socket = $tipo_socket;
    }

    public function getclasificacion_socket()
    {
        return $this->clasificacion_socket;
    }
    public function setclasificacion_socket($clasificacion_socket)
    {
        $this->clasificacion_socket = $clasificacion_socket;
    }

    public function getmetodo_suspension()
    {
        return $this->metodo_suspension;
    }
    public function setmetodo_suspension($metodo_suspension)
    {
        $this->metodo_suspension = $metodo_suspension;
    }
    /* ___________________ */









    public function insertarHistoriaProtesis()
    {
        try {

            $stmt = $this->cnn->prepare("INSERT INTO `historia_medica_protesis`(cedula, nivel_actividad, lado_amputacion, nivel_amputacion, z_afectada, diseno, fecha_medidas, fecha_cita, codigo_cita) 
                                                                         VALUES (:cedula, :nivel_actividad, :lado_amputacion, :nivel_amputacion, :z_afectada, :diseno, :fecha_medidas, :fecha_cita, :codigo_cita)");

            // Asignamos valores a los parametros
            $stmt->bindParam(':codigo_cita', $this->codigo_cita);
            $stmt->bindParam(':cedula', $this->cedula);
            $stmt->bindParam(':nivel_actividad', $this->nivel_actividad);
            $stmt->bindParam(':lado_amputacion', $this->lado_amputacion);
            $stmt->bindParam(':nivel_amputacion', $this->nivel_amputacion);
            $stmt->bindParam(':z_afectada', $this->zona_afectada);
            $stmt->bindParam(':diseno', $this->diseno);
            $stmt->bindParam(':fecha_medidas', $this->fecha_medidas);
            $stmt->bindParam(':fecha_cita', $this->fecha_apertura);


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
    public function Modificar_al_cargar_HM()
    {

        try {

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
        } catch (PDOException $error) {
            // Mostramos un mensaje genérico de error.
            echo "Error: ejecutando consulta SQL." . $error->getMessage();
            exit();
        }
    }


    public function consultar()
    {
        try {

            $stmt = $this->cnn->prepare("SELECT * FROM historia_medica_protesis WHERE codigo_cita = :codigo_cita");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
            // Asiganmos valores a los parametros
            $stmt->bindParam(':codigo_cita', $this->codigo_cita);
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

    public function insertarEstadoMunon()
    {
        try {

            $stmt = $this->cnn->prepare("INSERT INTO `estado_muñon`(id_historia, forma, cicatriz, piel, musculatura) 
            VALUES (:id_historia, :forma, :cicatriz, :piel, :musculatura)");

            // Asignamos valores a los parametros
            $stmt->bindParam(':id_historia', $this->id_historia);
            $stmt->bindParam(':forma', $this->forma);
            $stmt->bindParam(':cicatriz', $this->cicatriz);
            $stmt->bindParam(':piel', $this->piel);
            $stmt->bindParam(':musculatura', $this->musculatura);

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
    public function insertarCaracteristicasProtesis()
    {
        try {

            $stmt = $this->cnn->prepare("INSERT INTO `caracteristicas_protesis`(id_historia, tipo_rodilla, tipo_pie, tipo_socket, clasificacion_socket, metodo_suspension) 
            VALUES (:id_historia, :tipo_rodilla, :tipo_pie, :tipo_socket, :clasificacion_socket, :metodo_suspension)");

            // Asignamos valores a los parametros
            $stmt->bindParam(':id_historia', $this->id_historia);
            $stmt->bindParam(':tipo_rodilla', $this->tipo_rodilla);
            $stmt->bindParam(':tipo_pie', $this->tipo_pie);
            $stmt->bindParam(':tipo_socket', $this->tipo_socket);
            $stmt->bindParam(':clasificacion_socket', $this->clasificacion_socket);
            $stmt->bindParam(':metodo_suspension', $this->metodo_suspension);

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

    /* Historia medica de protesis */
    public function consultarHistoriaProtesis()
    {

        try {

            $stmt = $this->cnn->prepare("SELECT 
            historia_medica_protesis.id,
            historia_medica_protesis.codigo_cita,
            beneficiario.cedula,
            beneficiario.nombre,
            beneficiario.apellido,
            beneficiario.telefono,
            beneficiario.fecha_naci,
            beneficiario.edad,
            beneficiario.email,
            beneficiario.discapacidad,
            beneficiario.sexo,
            beneficiario.estado,
            beneficiario.municipio,
            beneficiario.parroquia,

            historia_medica_protesis.nivel_actividad,
            historia_medica_protesis.lado_amputacion,
            historia_medica_protesis.nivel_amputacion,


            historia_medica_protesis.z_afectada,
            historia_medica_protesis.diseno,
            historia_medica_protesis.fecha_medidas,
            historia_medica_protesis.fecha_cita,
            estado.musculatura,
            estado.forma,
            estado.cicatriz,
            estado.piel,
            
            caracteristicas.tipo_rodilla,
            caracteristicas.tipo_pie,
            caracteristicas.tipo_socket,
            caracteristicas.clasificacion_socket,
            caracteristicas.metodo_suspension
            
          FROM historia_medica_protesis
          JOIN beneficiario ON historia_medica_protesis.cedula = beneficiario.cedula
          LEFT JOIN estado_muñon estado ON estado.id_historia = historia_medica_protesis.id
           LEFT JOIN caracteristicas_protesis caracteristicas ON caracteristicas.id_historia = historia_medica_protesis.id
          WHERE historia_medica_protesis.codigo_cita = :codigo_cita;");
            // Especificamos el fetch mode antes de llamar a fetch()
            $stmt->bindParam(':codigo_cita', $this->codigo_cita);
            $stmt->setFetchMode(PDO::FETCH_ASSOC); // Devuelve los datos en un arreglo asociativo
            // Ejecutamos
            $stmt->execute();

            // Numero de Filas Afectadas
            /* 	echo "<br>Se devolvieron: ".$stmt->rowCount()." Registros<br>"; */

            // Devuelve los resultados obtenidos
            return $stmt->fetch();
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
