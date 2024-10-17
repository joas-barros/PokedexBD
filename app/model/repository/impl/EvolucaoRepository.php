<?php 

class EvolucaoRepository {
    private PDO $pdo;
    public const TABLE = 'evolucao';
    private PokedexRepository $pokedexRepository;

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
        $this->pokedexRepository = new PokedexRepository();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " ORDER BY Anterior ASC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $evolucoes = [];
        foreach($result as $row){
            $anterior = $this->pokedexRepository->findById($row['anterior']);
            $sucessor = $this->pokedexRepository->findById($row['sucessor']);
            $evolucoes[] = new Evolucao($anterior, $sucessor);
        }
        return $evolucoes;
    }

    public function findById(int $id1, int $id2): ?Evolucao {
        $stmt = $this->pdo->prepare("SELECT * FROM " . self::TABLE . " WHERE Anterior = :id1 AND Sucessor = :id2");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        $anterior = $this->pokedexRepository->findById($row['anterior']);
        $sucessor = $this->pokedexRepository->findById($row['sucessor']);
        return new Evolucao($anterior, $sucessor);
    }

    public function save($obj): void {
        $anterior = $obj->getAnterior()->getId();
        $sucessor = $obj->getSucessor()->getId();
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Anterior, Sucessor) VALUES (:anterior, :sucessor)");
        $stmt->bindParam(':anterior', $anterior);
        $stmt->bindParam(':sucessor', $sucessor);
        $stmt->execute();
    }

    public function update(int $id1, int $id2, $objetos): ?Evolucao {
        $evolucaoAtualizada = $this->findById($id1, $id2);

        if($evolucaoAtualizada === null){
            return null;
        }

        $evolucaoAtualizada->setAnterior($objetos->getAnterior());
        $evolucaoAtualizada->setSucessor($objetos->getSucessor());

        $anterior = $evolucaoAtualizada->getAnterior()->getId();
        $sucessor = $evolucaoAtualizada->getSucessor()->getId();

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET Anterior = :anterior, Sucessor = :sucessor WHERE Anterior = :id1 AND Sucessor = :id2");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->bindParam(':anterior', $anterior);
        $stmt->bindParam(':sucessor', $sucessor);
        $stmt->execute();
        return $evolucaoAtualizada;
    }

    public function delete(int $id1, int $id2): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE Anterior = :id1 AND Sucessor = :id2");
        $stmt->bindParam(':id1', $id1);
        $stmt->bindParam(':id2', $id2);
        $stmt->execute();
    }
}
?>