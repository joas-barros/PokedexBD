<?php 
require_once 'app/model/repository/RepositoryInterface.php';
require_once 'app/model/entities/Pokemon.php';

class PokemonRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'pokemon';
    private PokedexRepository $pokedexRepository;
    private EfeitoRepository $efeitoRepository;
    private TipoRepository $tipoRepository;
    private HabilidadeRepository $habilidadeRepository;

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
        $this->pokedexRepository = new PokedexRepository();
        $this->efeitoRepository = new EfeitoRepository();
        $this->tipoRepository = new TipoRepository();
        $this->habilidadeRepository = new HabilidadeRepository();
    }

    public function findAll(): array {
        
        $stmt = $this->pdo->prepare("
        SELECT
        * 
        from " . self::TABLE . " as p
        inner join habilidade_passiva h1 on p.Pokemon_Habilidade_1 = h1.habilidade_id 
        ORDER BY pokemon_id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $pokemons = [];
        foreach ($result as $row) {
            $pokemons[] = new Pokemon(
                $this->pokedexRepository->findById($row['pokemon_id']),
                $row['pokemon_nome'],
                new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], $this->efeitoRepository->findById( $row['habilidade_efeito'])),
                $this->habilidadeRepository->findById($row['pokemon_habilidade_2']),
                $this->habilidadeRepository->findById($row['pokemon_habilidade_3']),
                $this->habilidadeRepository->findById($row['pokemon_habilidade_4']),
                $row['pokemon_level_min'],
                $row['pokemon_level_max'],
                $row['pokemon_hp_min'],
                $row['pokemon_hp_max'],
                $row['pokemon_atk_min'],
                $row['pokemon_atk_max'],
                $row['pokemon_def_min'],
                $row['pokemon_def_max'],
                $row['pokemon_sp_atk_min'],
                $row['pokemon_sp_atk_max'],
                $row['pokemon_sp_def_min'],
                $row['pokemon_sp_def_max'],
                $row['pokemon_velocidade_min'],
                $row['pokemon_velocidade_max'],
                $row['pokemon_sexo'],
                $row['pokemon_altura'],
                $row['pokemon_peso'],
                $row['pokemon_img']
            );
        }
        return $pokemons;
    }

    public function findById(?int $id): ?Pokemon {

        if ($id === null){
            return null;
        }
        
        $stmt = $this->pdo->prepare("
        SELECT
        * 
        from " . self::TABLE . " as p
        inner join habilidade_passiva h1 on p.Pokemon_Habilidade_1 = h1.habilidade_id
        where p.pokemon_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if ($row === false) {
            return null;
        }
        return new Pokemon(
            $this->pokedexRepository->findById($row['pokemon_id']),
            $row['pokemon_nome'],
            new Habilidade($row['habilidade_id'], $row['habilidade_nome'], $row['habilidade_descricao'], $this->efeitoRepository->findById( $row['habilidade_efeito'])),
            $this->habilidadeRepository->findById($row['pokemon_habilidade_2']),
            $this->habilidadeRepository->findById($row['pokemon_habilidade_3']),
            $this->habilidadeRepository->findById($row['pokemon_habilidade_4']),
            $row['pokemon_level_min'],
            $row['pokemon_level_max'],
            $row['pokemon_hp_min'],
            $row['pokemon_hp_max'],
            $row['pokemon_atk_min'],
            $row['pokemon_atk_max'],
            $row['pokemon_def_min'],
            $row['pokemon_def_max'],
            $row['pokemon_sp_atk_min'],
            $row['pokemon_sp_atk_max'],
            $row['pokemon_sp_def_min'],
            $row['pokemon_sp_def_max'],
            $row['pokemon_velocidade_min'],
            $row['pokemon_velocidade_max'],
            $row['pokemon_sexo'],
            $row['pokemon_altura'],
            $row['pokemon_peso'],
            $row['pokemon_img']
        );
    }

    public function save($pokemon): void {

        $pokemon_id = $pokemon->getPokedex()->getId();
        $pokemon_nome = $pokemon->getNome();
        $habilidade1 = $pokemon->getHabilidade1()->getId();
        $habilidade2 = $pokemon->getHabilidade2() ? $pokemon->getHabilidade2()->getId() : null;
        $habilidade3 = $pokemon->getHabilidade3() ? $pokemon->getHabilidade3()->getId() : null;
        $habilidade4 = $pokemon->getHabilidade4() ? $pokemon->getHabilidade4()->getId() : null;
        $pokemon_level_min = $pokemon->getLevelMin();
        $pokemon_level_max = $pokemon->getLevelMax();
        $pokemon_hp_min = $pokemon->getHpMin();
        $pokemon_hp_max = $pokemon->getHpMax();
        $pokemon_atk_min = $pokemon->getAttackMin();
        $pokemon_atk_max = $pokemon->getAttackMax();
        $pokemon_def_min = $pokemon->getDefenseMin();
        $pokemon_def_max = $pokemon->getDefenseMax();
        $pokemon_sp_atk_min = $pokemon->getSpAttackMin();
        $pokemon_sp_atk_max = $pokemon->getSpAttackMax();
        $pokemon_sp_def_min = $pokemon->getSpDefenseMin();
        $pokemon_sp_def_max = $pokemon->getSpDefenseMax();
        $pokemon_velocidade_min = $pokemon->getVelocidadeMin();
        $pokemon_velocidade_max = $pokemon->getVelocidadeMax();
        $pokemon_sexo = $pokemon->getSexo();
        $pokemon_altura = $pokemon->getAltura();
        $pokemon_peso = $pokemon->getPeso();
        $pokemon_img = $pokemon->getPokemonIMG();

        $stmt = $this->pdo->prepare("
        INSERT INTO " . self::TABLE . " (pokemon_id, pokemon_nome, Pokemon_habilidade_1, Pokemon_habilidade_2, Pokemon_habilidade_3, Pokemon_habilidade_4, pokemon_level_min, pokemon_level_max, pokemon_hp_min, pokemon_hp_max, pokemon_atk_min, pokemon_atk_max, pokemon_def_min, pokemon_def_max, pokemon_sp_atk_min, pokemon_sp_atk_max, pokemon_sp_def_min, pokemon_sp_def_max, pokemon_velocidade_min, pokemon_velocidade_max, pokemon_sexo, pokemon_altura, pokemon_peso, pokemon_img) 
        VALUES (:pokemon_id, :pokemon_nome, :habilidade1, :habilidade2, :habilidade3, :habilidade4, :pokemon_level_min, :pokemon_level_max, :pokemon_hp_min, :pokemon_hp_max, :pokemon_atk_min, :pokemon_atk_max, :pokemon_def_min, :pokemon_def_max, :pokemon_sp_atk_min, :pokemon_sp_atk_max, :pokemon_sp_def_min, :pokemon_sp_def_max, :pokemon_velocidade_min, :pokemon_velocidade_max, :pokemon_sexo, :pokemon_altura, :pokemon_peso, :pokemon_img)");
        $stmt->bindParam(':pokemon_id', $pokemon_id);
        $stmt->bindParam(':pokemon_nome', $pokemon_nome);
        $stmt->bindParam(':habilidade1', $habilidade1);
        $stmt->bindParam(':habilidade2', $habilidade2);
        $stmt->bindParam(':habilidade3', $habilidade3);
        $stmt->bindParam(':habilidade4', $habilidade4);
        $stmt->bindParam(':pokemon_level_min', $pokemon_level_min);
        $stmt->bindParam(':pokemon_level_max', $pokemon_level_max);
        $stmt->bindParam(':pokemon_hp_min', $pokemon_hp_min);
        $stmt->bindParam(':pokemon_hp_max', $pokemon_hp_max);
        $stmt->bindParam(':pokemon_atk_min', $pokemon_atk_min);
        $stmt->bindParam(':pokemon_atk_max', $pokemon_atk_max);
        $stmt->bindParam(':pokemon_def_min', $pokemon_def_min);
        $stmt->bindParam(':pokemon_def_max', $pokemon_def_max);
        $stmt->bindParam(':pokemon_sp_atk_min', $pokemon_sp_atk_min);
        $stmt->bindParam(':pokemon_sp_atk_max', $pokemon_sp_atk_max);
        $stmt->bindParam(':pokemon_sp_def_min', $pokemon_sp_def_min);
        $stmt->bindParam(':pokemon_sp_def_max', $pokemon_sp_def_max);
        $stmt->bindParam(':pokemon_velocidade_min', $pokemon_velocidade_min);
        $stmt->bindParam(':pokemon_velocidade_max', $pokemon_velocidade_max);
        $stmt->bindParam(':pokemon_sexo', $pokemon_sexo);
        $stmt->bindParam(':pokemon_altura', $pokemon_altura);
        $stmt->bindParam(':pokemon_peso', $pokemon_peso);
        $stmt->bindParam(':pokemon_img', $pokemon_img);
        $stmt->execute();
    }

    public function update(int $id, $pokemon): ?Pokemon {

        $pokemon_num = $pokemon->getPokedex()->getId();
        if ($this->findById($pokemon_num) === null) {
            return null;
        }
        $pokemon_nome = $pokemon->getNome();
        $habilidade1 = $pokemon->getHabilidade1()->getId();
        $habilidade2 = $pokemon->getHabilidade2() ? $pokemon->getHabilidade2()->getId() : null;
        $habilidade3 = $pokemon->getHabilidade3() ? $pokemon->getHabilidade3()->getId() : null;
        $habilidade4 = $pokemon->getHabilidade4() ? $pokemon->getHabilidade4()->getId() : null;
        $pokemon_level_min = $pokemon->getLevelMin();
        $pokemon_level_max = $pokemon->getLevelMax();
        $pokemon_hp_min = $pokemon->getHpMin();
        $pokemon_hp_max = $pokemon->getHpMax();
        $pokemon_atk_min = $pokemon->getAttackMin();
        $pokemon_atk_max = $pokemon->getAttackMax();
        $pokemon_def_min = $pokemon->getDefenseMin();
        $pokemon_def_max = $pokemon->getDefenseMax();
        $pokemon_sp_atk_min = $pokemon->getSpAttackMin();
        $pokemon_sp_atk_max = $pokemon->getSpAttackMax();
        $pokemon_sp_def_min = $pokemon->getSpDefenseMin();
        $pokemon_sp_def_max = $pokemon->getSpDefenseMax();
        $pokemon_velocidade_min = $pokemon->getVelocidadeMin();
        $pokemon_velocidade_max = $pokemon->getVelocidadeMax();
        $pokemon_sexo = $pokemon->getSexo();
        $pokemon_altura = $pokemon->getAltura();
        $pokemon_peso = $pokemon->getPeso();
        $pokemon_img = $pokemon->getPokemonIMG();

        $stmt = $this->pdo->prepare("
        UPDATE " . self::TABLE . " 
        SET pokemon_id = :pokemon_num, pokemon_nome = :pokemon_nome, pokemon_habilidade_1 = :habilidade1, pokemon_habilidade_2 = :habilidade2, pokemon_habilidade_3 = :habilidade3, pokemon_habilidade_4 = :habilidade4, pokemon_level_min = :pokemon_level_min, pokemon_level_max = :pokemon_level_max, pokemon_hp_min = :pokemon_hp_min, pokemon_hp_max = :pokemon_hp_max, pokemon_atk_min = :pokemon_atk_min, pokemon_atk_max = :pokemon_atk_max, pokemon_def_min = :pokemon_def_min, pokemon_def_max = :pokemon_def_max, pokemon_sp_atk_min = :pokemon_sp_atk_min, pokemon_sp_atk_max = :pokemon_sp_atk_max, pokemon_sp_def_min = :pokemon_sp_def_min, pokemon_sp_def_max = :pokemon_sp_def_max, pokemon_velocidade_min = :pokemon_velocidade_min, pokemon_velocidade_max = :pokemon_velocidade_max, pokemon_sexo = :pokemon_sexo, pokemon_altura = :pokemon_altura, pokemon_peso = :pokemon_peso, pokemon_img = :pokemon_img 
        WHERE pokemon_id = :id");
        $stmt->bindParam(':pokemon_num', $pokemon_num);
        $stmt->bindParam(':pokemon_nome', $pokemon_nome);
        $stmt->bindParam(':habilidade1', $habilidade1);
        $stmt->bindParam(':habilidade2', $habilidade2);
        $stmt->bindParam(':habilidade3', $habilidade3);
        $stmt->bindParam(':habilidade4', $habilidade4);
        $stmt->bindParam(':pokemon_level_min', $pokemon_level_min);
        $stmt->bindParam(':pokemon_level_max', $pokemon_level_max);
        $stmt->bindParam(':pokemon_hp_min', $pokemon_hp_min);
        $stmt->bindParam(':pokemon_hp_max', $pokemon_hp_max);
        $stmt->bindParam(':pokemon_atk_min', $pokemon_atk_min);
        $stmt->bindParam(':pokemon_atk_max', $pokemon_atk_max);
        $stmt->bindParam(':pokemon_def_min', $pokemon_def_min);
        $stmt->bindParam(':pokemon_def_max', $pokemon_def_max);
        $stmt->bindParam(':pokemon_sp_atk_min', $pokemon_sp_atk_min);
        $stmt->bindParam(':pokemon_sp_atk_max', $pokemon_sp_atk_max);
        $stmt->bindParam(':pokemon_sp_def_min', $pokemon_sp_def_min);
        $stmt->bindParam(':pokemon_sp_def_max', $pokemon_sp_def_max);
        $stmt->bindParam(':pokemon_velocidade_min', $pokemon_velocidade_min);
        $stmt->bindParam(':pokemon_velocidade_max', $pokemon_velocidade_max);
        $stmt->bindParam(':pokemon_sexo', $pokemon_sexo);
        $stmt->bindParam(':pokemon_altura', $pokemon_altura);
        $stmt->bindParam(':pokemon_peso', $pokemon_peso);
        $stmt->bindParam(':pokemon_img', $pokemon_img);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $pokemon;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare("DELETE FROM " . self::TABLE . " WHERE pokemon_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>