<?php
include_once("ManejadorBD.php");

class informes_medicos extends ManejadorBD
{
    private $id;
    private $cedula;
    private $nombre;
    private $pdf_path;
    private $cnn; // Declara una propiedad para la conexión

    public function __construct($tipoConexion)
    {
        parent::__construct($tipoConexion); // Llama al constructor de la clase padre
        $this->cnn = parent::conectar($tipoConexion); // Asigna la conexión a $cnn
    }

    public function __destruct()
    {
        parent::cerrarConexion();
    }

    public function getid()
    {
        return $this->id;
    }

    public function setid($id)
    {
        $this->id = $id;
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

    public function insertarInforme()
    {
        $sql = "INSERT INTO informes_medicos (cedula, nombre) VALUES (:cedula, :nombre)";
        $stmt = $this->cnn->prepare($sql); // Usa $this->cnn
        $stmt->bindParam(':cedula', $this->cedula);
        $stmt->bindParam(':nombre', $this->nombre);
        return $stmt->execute();
    }

    public function eliminarInforme($id)
    {
        $sql = "DELETE FROM informes_medicos WHERE id = :id";
        $stmt = $this->cnn->prepare($sql); // Usa $this->cnn
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function consultarInformes()
    {
        $sql = "SELECT * FROM informes_medicos";
        $stmt = $this->cnn->prepare($sql); // Usa $this->cnn
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarInformePorCedula($cedula)
    {
        $sql = "SELECT * FROM informes_medicos WHERE cedula = :cedula";
        $stmt = $this->cnn->prepare($sql); // Usa $this->cnn
        $stmt->bindParam(':cedula', $cedula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function setpdf_path($pdf_path)
{
    $this->pdf_path = $pdf_path;
}

public function actualizarPdf()
{
    $sql = "UPDATE informes_medicos SET pdf_path = :pdf_path WHERE id = :id";
    $stmt = $this->cnn->prepare($sql);
    $stmt->bindParam(':pdf_path', $this->pdf_path);
    $stmt->bindParam(':id', $this->id);
    return $stmt->execute();
}
}
?>