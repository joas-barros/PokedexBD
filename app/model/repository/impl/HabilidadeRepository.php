<?php 

require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';

class HabilidadeRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'habilidade_passiva';
    private EfeitoRepository $efeitoRepository;

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
        $this->efeitoRepository = new EfeitoRepository();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $habilidades = [];
        foreach($result as $row){
            $habilidades[] = new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], 
            $this->efeitoRepository->findById($row['habilidade_efeito']));
        }
        return $habilidades;
    }

    public function findById(?int $id): ?Habilidade {

        if ($id === null){
            return null;
        }
        
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE habilidade_id = :id" );
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], 
        $this->efeitoRepository->findById($row['habilidade_efeito']));
    }

    public function save($obj): void {

        $id = $obj->getId();
        $nome = $obj->getNome();
        $descricao = $obj->getDescricao();
        $efeito = $obj->getEfeito() ? $obj->getEfeito()->getId() : null;

        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Habilidade_ID ,Habilidade_Nome, Habilidade_Descricao, Habilidade_Efeito) VALUES (:id, :nome, :descricao, :efeito)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':efeito', $efeito);
        $stmt->execute();
    }

    public function update(int $id, $obj): ?Habilidade {

        $id = $obj->getId();
        if($this->findById($id) === null){
            return null;
        }
        $nome = $obj->getNome();
        $descricao = $obj->getDescricao();
        $efeito = $obj->getEfeito() ? $obj->getEfeito()->getId() : null;

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET Habilidade_Nome = :nome, Habilidade_Descricao = :descricao, Habilidade_Efeito = :efeito WHERE Habilidade_ID = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':efeito', $efeito);
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