<?php 
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/Efeito.php';

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
            $efeitos[] = new Efeito($row['id_efeito'], $row['nome_efeito'], $row['informacao_efeito']);
        }
        return $efeitos;
    }

    public function findById(int $id): ?Efeito {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE id_efeito = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Efeito($row['id_efeito'], $row['nome_efeito'], $row['informacao_efeito']);
    }

    public function save($obj): void {
        $nome = $obj->getNome();
        $descricao = $obj->getInformacao();
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nome_efeito, informacao_efeito) VALUES (:nome, :descricao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
    }

    public function update(int $id, $obj): ?Efeito {
        
        $efeitoAtualizado = $this->findById($id);

        if($efeitoAtualizado === null){
            return null;
        }

        $efeitoAtualizado->setNome($obj->getNome());
        $efeitoAtualizado->setInformacao($obj->getInformacao());

        $nome = $efeitoAtualizado->getNome();
        $descricao = $efeitoAtualizado->getInformacao();

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nome_efeito = :nome, informacao_efeito = :descricao WHERE id_efeito = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->execute();
        return $efeitoAtualizado;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id_efeito = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>