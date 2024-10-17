<?php 

require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/Fraqueza.php';
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/model/repository/impl/TipoRepository.php';

class FraquezaRepository implements RepositoryInterface {
    private PDO $connection;
    public const TABLE = 'fraquezas';
    private TipoRepository $tipoRepository;

    public function __construct() {
        $this->connection = DBConnection::getInstance()->getConnection();
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(): array {
        $stmt = $this->connection->query('SELECT * FROM ' . self::TABLE . ' ORDER BY tipo_id ASC');
        $result = $stmt->fetchAll();

        $fraquezas = [];
        foreach($result as $row){
            $fraquezas[] = new Fraqueza(
                $this->tipoRepository->findById($row['tipo_id']),
                $this->tipoRepository->findById($row['fraqueza_1_id']),
                $this->tipoRepository->findById($row['fraqueza_2_id']),
                $this->tipoRepository->findById($row['fraqueza_3_id']),
                $this->tipoRepository->findById($row['fraqueza_4_id']),
                $this->tipoRepository->findById($row['fraqueza_5_id']),
            );
        }
        return $fraquezas;
    }

    public function findById(int $id): ?Fraqueza {
        $stmt = $this->connection->prepare('SELECT * FROM ' . self::TABLE . ' WHERE tipo_id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Fraqueza(
            $this->tipoRepository->findById($row['tipo_id']),
            $this->tipoRepository->findById($row['fraqueza_1_id']),
            $this->tipoRepository->findById($row['fraqueza_2_id']),
            $this->tipoRepository->findById($row['fraqueza_3_id']),
            $this->tipoRepository->findById($row['fraqueza_4_id']),
            $this->tipoRepository->findById($row['fraqueza_5_id']),
        );
    }

    public function save($fraqueza): void {
        $stmt = $this->connection->prepare('INSERT INTO ' . self::TABLE . ' (tipo_id, fraqueza_1_id, fraqueza_2_id, fraqueza_3_id, fraqueza_4_id, fraqueza_5_id) VALUES (:tipo_id, :fraqueza_1_id, :fraqueza_2_id, :fraqueza_3_id, :fraqueza_4_id, :fraqueza_5_id)');
        $stmt->bindValue(':tipo_id', $fraqueza->getTipo()->getId());
        $stmt->bindValue(':fraqueza_1_id', $fraqueza->getFraqueza1()->getId());
        $stmt->bindValue(':fraqueza_2_id', $fraqueza->getFraqueza2() ? $fraqueza->getFraqueza2()->getId() : null);
        $stmt->bindValue(':fraqueza_3_id', $fraqueza->getFraqueza3() ? $fraqueza->getFraqueza3()->getId() : null);
        $stmt->bindValue(':fraqueza_4_id', $fraqueza->getFraqueza4() ? $fraqueza->getFraqueza4()->getId() : null);
        $stmt->bindValue(':fraqueza_5_id', $fraqueza->getFraqueza5() ? $fraqueza->getFraqueza5()->getId() : null);
        $stmt->execute();
    }

    public function update(int $id, $fraquezaAntiga): ?Fraqueza {
        $fraquezaAtualizada = $this->findById($id);

        if($fraquezaAtualizada === null){
            return null;
        }

        $fraquezaAtualizada->setFraqueza1($fraquezaAntiga->getFraqueza1());
        $fraquezaAtualizada->setFraqueza2($fraquezaAntiga->getFraqueza2());
        $fraquezaAtualizada->setFraqueza3($fraquezaAntiga->getFraqueza3());
        $fraquezaAtualizada->setFraqueza4($fraquezaAntiga->getFraqueza4());
        $fraquezaAtualizada->setFraqueza5($fraquezaAntiga->getFraqueza5());

        $fraqueza_id_1 = $fraquezaAtualizada->getFraqueza1()->getId();
        $fraqueza_id_2 = $fraquezaAtualizada->getFraqueza2() ? $fraquezaAtualizada->getFraqueza2()->getId() : null;
        $fraqueza_id_3 = $fraquezaAtualizada->getFraqueza3() ? $fraquezaAtualizada->getFraqueza3()->getId() : null;
        $fraqueza_id_4 = $fraquezaAtualizada->getFraqueza4() ? $fraquezaAtualizada->getFraqueza4()->getId() : null;
        $fraqueza_id_5 = $fraquezaAtualizada->getFraqueza5() ? $fraquezaAtualizada->getFraqueza5()->getId() : null;

        $stmt = $this->connection->prepare('
            UPDATE 
                ' . self::TABLE . ' SET 
                fraqueza_1_id = :fraqueza_1_id,
                fraqueza_2_id = :fraqueza_2_id,
                fraqueza_3_id = :fraqueza_3_id,
                fraqueza_4_id = :fraqueza_4_id,
                fraqueza_5_id = :fraqueza_5_id 
                WHERE tipo_id = :id'
        );
        $stmt->bindParam(':fraqueza_1_id', $fraqueza_id_1);
        $stmt->bindParam(':fraqueza_2_id', $fraqueza_id_2);
        $stmt->bindParam(':fraqueza_3_id', $fraqueza_id_3);
        $stmt->bindParam(':fraqueza_4_id', $fraqueza_id_4);
        $stmt->bindParam(':fraqueza_5_id', $fraqueza_id_5);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $fraquezaAtualizada;
    }

    public function delete(int $id): void {
        $stmt = $this->connection->prepare('DELETE FROM ' . self::TABLE . ' WHERE tipo_id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

}

?>