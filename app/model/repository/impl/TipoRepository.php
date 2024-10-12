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
            $tipos[] = new Tipo($row['tipo_id'], $row['tipo_nome'], $row['cor']);
        }
        return $tipos;
    }

    public function findById(int $id): ?Tipo {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE Tipo_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Tipo($row['tipo_id'], $row['tipo_nome'], $row['cor']);
    }

    public function save($obj): void {
        $nome = $obj->getNome();
        $cor = $obj->getCor();
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Tipo_Nome, Cor) VALUES (:nome, :cor)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cor', $cor);
        $stmt->execute();
    }

    public function update(int $id, $tipo): ?Tipo {

        $tipoAtualizado = $this->findById($id);
        if($tipoAtualizado === null){
            return null;
        }

        $tipoAtualizado->setNome($tipo->getNome());
        $tipoAtualizado->setCor($tipo->getCor());

        $nome = $tipoAtualizado->getNome();
        $cor = $tipoAtualizado->getCor();

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET Tipo_Nome = :nome, Cor = :cor WHERE Tipo_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cor', $cor);
        $stmt->execute();
        return $tipoAtualizado;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE Tipo_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>