<?php 

require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/Tipo.php';

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
            $tipos[] = new Tipo($row['id_tipo'], $row['nome_tipo'], $row['cor_tipo']);
        }
        return $tipos;
    }

    public function findById(int $id): ?Tipo {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id_tipo = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Tipo($row['id_tipo'], $row['nome_tipo'], $row['cor_tipo']);
    }

    public function save($obj): void {
        $nome = $obj->getNome();
        $cor = $obj->getCor();
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nome_tipo, cor_tipo) VALUES (:nome, :cor)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cor', $cor);
        $stmt->execute();
    }

    public function update($obj): ?Tipo {
        $id = $obj->getId();
        $nome = $obj->getNome();
        $cor = $obj->getCor();

        if($this->findById($id) === null){
            return null;
        }

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nome_tipo = :nome, cor_tipo = :cor WHERE id_tipo = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cor', $cor);
        $stmt->execute();
        return $obj;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id_tipo = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>