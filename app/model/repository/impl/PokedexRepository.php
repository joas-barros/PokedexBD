<?php 

require_once 'app/model/entities/Pokedex.php';
require_once 'app/model/entities/Tipo.php';
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/connection/DBConnection.php';

class PokedexRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'pokedex';

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("
        SELECT 
            pokedex.pokedex_num,
            pokedex.pokedex_nome,
            pokedex.pokedex_tipo_1,
            pokedex.pokedex_tipo_2,
            pokedex.pokedex_taxa_captura,
            pokedex.pokedex_geracao,
            pokedex.pokedex_info,
            t1.tipo_nome AS tipo1_nome,
            t1.cor AS tipo1_cor,
            t2.tipo_nome AS tipo2_nome,
            t2.cor AS tipo2_cor
        FROM " . self::TABLE . " 
        INNER JOIN tipo t1 ON pokedex.Pokedex_Tipo_1 = t1.Tipo_ID 
        INNER JOIN tipo t2 ON pokedex.Pokedex_Tipo_2 = t2.Tipo_ID
    ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $pokemons = [];
        foreach($result as $row){
            $pokemons[] = new Pokedex($row['pokedex_num'], $row['pokedex_nome'], 
            new Tipo($row['pokedex_tipo_1'], $row['tipo1_nome'], $row['tipo1_cor']),
            new Tipo($row['pokedex_tipo_2'], $row['tipo2_nome'], $row['tipo2_cor']),
            $row['pokedex_taxa_captura'], $row['pokedex_geracao'], $row['pokedex_info']);
        }
        return $pokemons;
    }

    public function findById(int $id): ?Pokedex {
        $stmt = $this->pdo->prepare("
        SELECT 
            pokedex.pokedex_num,
            pokedex.pokedex_nome,
            pokedex.pokedex_tipo_1,
            pokedex.pokedex_tipo_2,
            pokedex.pokedex_taxa_captura,
            pokedex.pokedex_geracao,
            pokedex.pokedex_info,
            t1.tipo_nome AS tipo1_nome,
            t1.cor AS tipo1_cor,
            t2.tipo_nome AS tipo2_nome,
            t2.cor AS tipo2_cor
        FROM " . self::TABLE . " 
        INNER JOIN tipo t1 ON pokedex.Pokedex_Tipo_1 = t1.Tipo_ID 
        INNER JOIN tipo t2 ON pokedex.Pokedex_Tipo_2 = t2.Tipo_ID
        WHERE Pokedex_Num = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Pokedex($row['pokedex_num'], $row['pokedex_nome'], 
        new Tipo($row['pokedex_tipo_1'], $row['tipo1_nome'], $row['tipo1_cor']),
        new Tipo($row['pokedex_tipo_2'], $row['tipo2_nome'], $row['tipo2_cor']),
        $row['pokedex_taxa_captura'], $row['pokedex_geracao'], $row['pokedex_info']);
    }

    public function save($obj): void {
        $nome = $obj->getNome();
        $tipo1 = $obj->getTipo1()->getId();
        $tipo2 = $obj->getTipo2()->getId();
        $taxaDeCaptura = $obj->getTaxaDeCaptura();
        $geracao = $obj->getGeracao();
        $informacao = $obj->getInformacao();
        $stmt = $this->pdo->prepare("INSERT INTO " . self::TABLE . " (Pokedex_Nome, Pokedex_Tipo_1, Pokedex_Tipo_2, Pokedex_Taxa_Captura, Pokedex_Geracao, Pokedex_Info) VALUES (:nome, :tipo1, :tipo2, :taxaDeCaptura, :geracao, :informacao)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo1', $tipo1);
        $stmt->bindParam(':tipo2', $tipo2);
        $stmt->bindParam(':taxaDeCaptura', $taxaDeCaptura);
        $stmt->bindParam(':geracao', $geracao);
        $stmt->bindParam(':informacao', $informacao);
        $stmt->execute();
    }

    public function update(int $id, $pokedex): ?Pokedex {

        $pokedexAtualizado = $this->findById($id);
        if($pokedexAtualizado === null){
            return null;
        }

        $pokedexAtualizado->setNome($pokedex->getNome());
        $pokedexAtualizado->setTipo1($pokedex->getTipo1());
        $pokedexAtualizado->setTipo2($pokedex->getTipo2());
        $pokedexAtualizado->setTaxaDeCaptura($pokedex->getTaxaDeCaptura());
        $pokedexAtualizado->setGeracao($pokedex->getGeracao());
        $pokedexAtualizado->setInformacao($pokedex->getInformacao());

        $nome = $pokedexAtualizado->getNome();
        $tipo1 = $pokedexAtualizado->getTipo1()->getId();
        $tipo2 = $pokedexAtualizado->getTipo2()->getId();
        $taxaDeCaptura = $pokedexAtualizado->getTaxaDeCaptura();
        $geracao = $pokedexAtualizado->getGeracao();
        $informacao = $pokedexAtualizado->getInformacao();

        $stmt = $this->pdo->prepare("UPDATE " . self::TABLE . " SET Pokedex_Nome = :nome, Pokedex_Tipo_1 = :tipo1, Pokedex_Tipo_2 = :tipo2, Pokedex_Taxa_Captura = :taxaDeCaptura, Pokedex_Geracao = :geracao, Pokedex_Info = :informacao WHERE Pokedex_Num = :id");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':tipo1', $tipo1);
        $stmt->bindParam(':tipo2', $tipo2);
        $stmt->bindParam(':taxaDeCaptura', $taxaDeCaptura);
        $stmt->bindParam(':geracao', $geracao);
        $stmt->bindParam(':informacao', $informacao);
        $stmt->execute();
        return $pokedexAtualizado;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE Pokedex_Num = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>