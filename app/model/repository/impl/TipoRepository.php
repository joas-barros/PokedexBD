<?php 

require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';

class TipoRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'tipo';

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $tipos = [];
        foreach($result as $row){
            $tipos[] = new Tipo($row['id'], $row['nome'], $row['cor']);
        }
        return $tipos;
    }

    public function findById(int $id): ?Tipo {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Tipo($row['id'], $row['nome'], $row['cor']);
    }

    public function save($obj): void {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nome, cor) VALUES (:nome, :cor)");
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':cor', $obj->getCor());
        $stmt->execute();
    }

    public function update($obj): void {
        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nome = :nome, cor = :cor WHERE id = :id");
        $stmt->bindParam(':id', $obj->getId());
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':cor', $obj->getCor());
        $stmt->execute();
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>