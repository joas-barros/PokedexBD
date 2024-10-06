<?php 
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';

class EfeitoRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'efeito';

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $efeitos = [];
        foreach($result as $row){
            $efeitos[] = new Efeito($row['id'], $row['nome'], $row['descricao']);
        }
        return $efeitos;
    }

    public function findById(int $id): ?Efeito {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Efeito($row['id'], $row['nome'], $row['descricao']);
    }

    public function save($obj): void {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nome, informacao) VALUES (:nome, :descricao)");
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':descricao', $obj->getInformacao());
        $stmt->execute();
    }

    public function update($obj): void {
        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nome = :nome, informacao = :descricao WHERE id = :id");
        $stmt->bindParam(':id', $obj->getId());
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':descricao', $obj->getInformacao());
        $stmt->execute();
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>