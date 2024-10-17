<?php 

require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/RegistroPokedex.php';
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/model/repository/impl/TipoRepository.php';
require_once 'app/model/entities/Pokedex.php';
require_once 'app/model/entities/Treinador.php';
require_once 'app/model/entities/Tipo.php';

class RegistroPokedexRepository implements RepositoryInterface {

    private PDO $pdo;
    public const TABLE = 'registro_pokedex';
    private TipoRepository $tipoRepository;

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare("
        SELECT * FROM " . self::TABLE . 
        " INNER JOIN pokedex ON registro_pokedex.pokemon_id = pokedex.pokedex_num 
         INNER JOIN treinador ON registro_pokedex.treinador_id = treinador.treinador_id
        ");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $registros = [];
        foreach($result as $row){
            $registros[] = new RegistroPokedex(
                new Pokedex($row['pokedex_num'], $row['pokedex_nome'], $this->tipoRepository->findById($row['pokedex_tipo_1']), $this->tipoRepository->findById($row['pokedex_tipo_2']), $row['pokedex_taxa_captura'], $row['pokedex_geracao'], $row['pokedex_info']),
                new Treinador($row['treinador_id'], $row['treinador_nome'], $row['treinador_email'], $row['treinador_senha'], new DateTime($row['treinador_data_nascimento'])),
                new DateTime($row['pokemon_data_captura']),
                $row['pokemon_hp'],
                $row['pokemon_atk'],
                $row['pokemon_def'],
                $row['pokemon_sp_atk'],
                $row['pokemon_sp_def'],
                $row['pokemon_velocidade'],
                $row['pokemon_level']
            );
        }
        return $registros;
    }

    public function findById(?int $id): ?array {

        if ($id === null){
            return null;
        }
        
        $stmt = $this->pdo->prepare("
        SELECT * FROM " . self::TABLE . 
        " INNER JOIN pokedex ON registro_pokedex.pokemon_id = pokedex.pokedex_num 
        INNER JOIN treinador ON registro_pokedex.treinador_id = treinador.treinador_id
        WHERE registro_pokedex.treinador_id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $registros = [];
        foreach($result as $row){
            $registros[] = new RegistroPokedex(
                new Pokedex($row['pokedex_num'], $row['pokedex_nome'], $this->tipoRepository->findById($row['pokedex_tipo_1']), $this->tipoRepository->findById($row['pokedex_tipo_2']), $row['pokedex_taxa_captura'], $row['pokedex_geracao'], $row['pokedex_info']),
                new Treinador($row['treinador_id'], $row['treinador_nome'], $row['treinador_email'], $row['treinador_senha'], new DateTime($row['treinador_data_nascimento'])),
                new DateTime($row['pokemon_data_captura']),
                $row['pokemon_hp'],
                $row['pokemon_atk'],
                $row['pokemon_def'],
                $row['pokemon_sp_atk'],
                $row['pokemon_sp_def'],
                $row['pokemon_velocidade'],
                $row['pokemon_level']
            );
        }
        return $registros;
    }

    public function save($obj): void {
        $pokemonId = $obj->getPokemon()->getId();
        $treinadorId = $obj->getTreinador()->getId();
        $stmt = $this->pdo->prepare("
        INSERT INTO " . self::TABLE . " (pokemon_id, treinador_id) 
         VALUES (:pokemonId, :treinadorId)
        ");
        $stmt->bindParam(':pokemonId', $pokemonId);
        $stmt->bindParam(':treinadorId', $treinadorId);
        $stmt->execute();
    }

    public function update(int $id, $obj): ?RegistroPokedex {

        $find = $this->pdo->prepare("
        SELECT * FROM " . self::TABLE . 
        " INNER JOIN pokedex ON registro_pokedex.pokemon_id = pokedex.pokedex_num 
        INNER JOIN treinador ON registro_pokedex.treinador_id = treinador.treinador_id
        WHERE registro_pokedex.pokedex_num = :id
        ");
        $find->bindParam(':id', $id);
        $find->execute();
        $result = $find->fetch();

        if ($result === false){
            return null;
        }

        $registroAtualizado = new RegistroPokedex(
            new Pokedex($result['pokedex_num'], $result['pokedex_nome'], $this->tipoRepository->findById($result['pokedex_tipo_1']), $this->tipoRepository->findById($result['pokedex_tipo_2']), $result['pokedex_taxa_captura'], $result['pokedex_geracao'], $result['pokedex_info']),
            new Treinador($result['treinador_id'], $result['treinador_nome'], $result['treinador_email'], $result['treinador_senha'], new DateTime($result['treinador_data_nascimento'])),
            new DateTime($result['pokemon_data_captura']),
            $result['pokemon_hp'],
            $result['pokemon_atk'],
            $result['pokemon_def'],
            $result['pokemon_sp_atk'],
            $result['pokemon_sp_def'],
            $result['pokemon_velocidade'],
            $result['pokemon_level']
        );

        $registroAtualizado->setTreinador($obj->getTreinador());
        $registroAtualizado->setHp($obj->getHp());
        $registroAtualizado->setAtaque($obj->getAtaque());
        $registroAtualizado->setDefesa($obj->getDefesa());
        $registroAtualizado->setAtaqueEspecial($obj->getAtaqueEspecial());
        $registroAtualizado->setDefesaEspecial($obj->getDefesaEspecial());
        $registroAtualizado->setVelocidade($obj->getVelocidade());
        $registroAtualizado->setNivel($obj->getNivel());

        $treinadorId = $registroAtualizado->getTreinador()->getId();
        //$dataCaptura = $registroAtualizado->getDataCaptura()->format('Y-m-d');
        $hp = $registroAtualizado->getHp();
        $ataque = $registroAtualizado->getAtaque();
        $defesa = $registroAtualizado->getDefesa();
        $ataqueEspecial = $registroAtualizado->getAtaqueEspecial();
        $defesaEspecial = $registroAtualizado->getDefesaEspecial();
        $velocidade = $registroAtualizado->getVelocidade();
        $nivel = $registroAtualizado->getNivel();

        $stmt = $this->pdo->prepare("
        UPDATE " . self::TABLE . " 
         SET treinador_id = :treinadorId, pokemon_hp = :hp, pokemon_atk = :ataque, pokemon_def = :defesa, pokemon_sp_atk = :ataqueEspecial, pokemon_sp_def = :defesaEspecial, pokemon_velocidade = :velocidade, pokemon_level = :nivel
         WHERE pokemon_id = :id
        ");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':treinadorId', $treinadorId);
        //$stmt->bindParam(':dataCaptura', $dataCaptura);
        $stmt->bindParam(':hp', $hp);
        $stmt->bindParam(':ataque', $ataque);
        $stmt->bindParam(':defesa', $defesa);
        $stmt->bindParam(':ataqueEspecial', $ataqueEspecial);
        $stmt->bindParam(':defesaEspecial', $defesaEspecial);
        $stmt->bindParam(':velocidade', $velocidade);
        $stmt->bindParam(':nivel', $nivel);
        $stmt->execute();
        return $registroAtualizado;
    }

    public function delete(int $idTreinador): void {
        $stmt = $this->pdo->prepare("
        DELETE FROM " . self::TABLE . " 
        WHERE treinador_id = :id
        ");
        $stmt->bindParam(':id', $idTreinador);
        $stmt->execute();
    }

}

?>