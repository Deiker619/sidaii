<?php
/**
 * Modelo para la tabla campamentos_transitorios.
 *
 * Proporciona métodos para listar campamentos filtrados por parroquia
 * y obtener la ubicación completa (parroquia, municipio, estado) de un
 * campamento específico mediante JOINs con las tablas geográficas.
 */

include_once 'ManejadorBD.php';

class CampamentoTransitorio extends ManejadorBD
{
    private $cnn;

    public function __construct(int $tipoConexion)
    {
        $this->cnn = parent::conectar($tipoConexion);
    }

    /**
     * Retorna todos los campamentos asociados a una parroquia.
     *
     * @param string $idParroquia ID de la parroquia (varchar(10)).
     * @return array Lista de campamentos con id_campamento y nombre_campamento.
     */
    public function listarPorParroquia(string $idParroquia): array
    {
        try {
            $stmt = $this->cnn->prepare(
                'SELECT id_campamento, nombre_campamento
                 FROM campamentos_transitorios
                 WHERE id_parroquia = :id_parroquia
                 ORDER BY nombre_campamento'
            );
            $stmt->bindParam(':id_parroquia', $idParroquia);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            return $stmt->fetchAll();
        } catch (PDOException $error) {
            echo 'Error: ejecutando consulta SQL.' . $error->getMessage();
            exit();
        }
    }

    /**
     * Retorna los datos completos de un campamento incluyendo su ubicación
     * geográfica (parroquia, municipio, estado).
     *
     * @param int $idCampamento ID del campamento.
     * @return array|false Arreglo asociativo con los datos o false si no existe.
     */
    public function obtener(int $idCampamento): array|false
    {
        try {
            $stmt = $this->cnn->prepare(
                'SELECT ct.id_campamento,
                        ct.nombre_campamento,
                        p.nombre_parroquia,
                        m.nombre AS nombre_municipio,
                        e.nombre_estado
                 FROM campamentos_transitorios ct
                 JOIN parroquia p ON ct.id_parroquia = p.id
                 JOIN municipios m ON p.municipio = m.id_municipios
                 JOIN estados e ON m.estado = e.id_estados
                 WHERE ct.id_campamento = :id_campamento'
            );
            $stmt->bindParam(':id_campamento', $idCampamento, PDO::PARAM_INT);
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $stmt->execute();

            return $stmt->fetch();
        } catch (PDOException $error) {
            echo 'Error: ejecutando consulta SQL.' . $error->getMessage();
            exit();
        }
    }
}
