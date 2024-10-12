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
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " INNER JOIN tipo ON habilidade.Habilidade_Tipo = tipo.Tipo_ID INNER JOIN efeito ON habilidade.Habilidade_Efeito = efeito.Efeito_ID");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $habilidades = [];
        foreach($result as $row){
            $habilidades[] = new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], 
            new Efeito($row['habilidade_efeito'], $row['efeito_nome'], $row['efeito_info']), 
            new Tipo($row['habilidade_tipo'], $row['tipo_nome'], $row['cor']));
        }
        return $habilidades;
    }

    public function findById(int $id): ?Habilidade {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " INNER JOIN tipo ON habilidade.Habilidade_Tipo = tipo.Tipo_ID INNER JOIN efeito ON habilidade.Habilidade_Efeito = efeito.Efeito_ID WHERE habilidade.Habilidade_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], 
        new Efeito($row['habilidade_efeito'], $row['efeito_nome'], $row['efeito_info']), 
        new Tipo($row['habilidade_tipo'], $row['tipo_nome'], $row['cor']));
    }

    public function save($obj): void {

        $nome = $obj->getNome();
        $descricao = $obj->getDescricao();
        $efeito = $obj->getEfeito()->getId();
        $tipo = $obj->getTipo()->getId();

        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito, Habilidade_Tipo) VALUES (:nome, :descricao, :efeito, :tipo)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':efeito', $efeito);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();
    }

    public function update(int $id, $obj): ?Habilidade {

        $id = $obj->getId();
        if($this->findById($id) === null){
            return null;
        }
        $nome = $obj->getNome();
        $descricao = $obj->getDescricao();
        $efeito = $obj->getEfeito()->getId();
        $tipo = $obj->getTipo()->getId();

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET Habilidade_Nome = :nome, Habilidade_Descricao = :descricao, Habilidade_Efeito = :efeito, Habilidade_Tipo = :tipo WHERE Habilidade_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':efeito', $efeito);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->execute();

        return $obj;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE Habilidade_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>