<?php 

require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';

class HabilidadeRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'habilidade';

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " INNER JOIN tipo ON habilidade.tipo_habilidade = tipo.id_tipo INNER JOIN efeito ON habilidade.efeito_habilidade = efeito.id_efeito");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $habilidades = [];
        foreach($result as $row){
            $habilidades[] = new Habilidade($row['id_habilidade'], $row['nome_habilidade'], $row['descricao_habilidade'], 
            new Efeito($row['efeito_habilidade'], $row['nome_efeito'], $row['informacao_efeito']), 
            new Tipo($row['tipo_habilidade'], $row['nome_tipo'], $row['cor_tipo']));
        }
        return $habilidades;
    }

    public function findById(int $id): ?Habilidade {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " INNER JOIN tipo ON habilidade.tipo_habilidade = tipo.id_tipo INNER JOIN efeito ON habilidade.efeito_habilidade = efeito.id_efeito WHERE habilidade.id_habilidade = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Habilidade($row['id_habilidade'], $row['nome_habilidade'], $row['descricao_habilidade'], 
        new Efeito($row['efeito_habilidade'], $row['nome_efeito'], $row['informacao_efeito']), 
        new Tipo($row['tipo_habilidade'], $row['nome_tipo'], $row['cor_tipo']));
    }

    public function save($obj): void {
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (nome_habilidade, descricao_habilidade, efeito_habilidade, tipo_habilidade) VALUES (:nome, :descricao, :efeito, :tipo)");
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':descricao', $obj->getDescricao());
        $stmt->bindParam(':efeito', $obj->getEfeito()->getId());
        $stmt->bindParam(':tipo', $obj->getTipo()->getId());
        $stmt->execute();
    }

    public function update($obj): void {
        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET nome_habilidade = :nome, descricao_habilidade = :descricao, efeito_habilidade = :efeito, tipo_habilidade = :tipo WHERE id_habilidade = :id");
        $stmt->bindParam(':id', $obj->getId());
        $stmt->bindParam(':nome', $obj->getNome());
        $stmt->bindParam(':descricao', $obj->getDescricao());
        $stmt->bindParam(':efeito', $obj->getEfeito()->getId());
        $stmt->bindParam(':tipo', $obj->getTipo()->getId());
        $stmt->execute();
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE id_habilidade = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>