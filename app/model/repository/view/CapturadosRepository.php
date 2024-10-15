<?php 

require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/view/Capturados.php';
require_once 'app/model/repository/impl/PokedexRepository.php';
require_once 'app/model/repository/impl/HabilidadeRepository.php';

class CapturadosRepository{
    private PDO $pdo;
    public const VIEW = 'capturados';
    private PokedexRepository $pokedexRepository;
    private HabilidadeRepository $habilidadeRepository;

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
        $this->pokedexRepository = new PokedexRepository();
        $this->habilidadeRepository = new HabilidadeRepository();
    }

    public function findAll(): array{
        $stmt = $this->pdo->query('SELECT * FROM ' . self::VIEW);
        $result = $stmt->fetchAll();

        $capturados = [];
        foreach($result as $row){
            $capturados[] = new Capturados(
                $this->pokedexRepository->findById($row['numero']),
                $row['nome'],
                $this->habilidadeRepository->findById($row['habilidade']),
                $row['hp'],
                $row['ataque'],
                $row['defesa'],
                $row['sp_ataque'],
                $row['sp_defesa'],
                $row['velocidade'],
                $row['nivel'],
                $row['sexo'],
                $row['altura'],
                $row['peso_em_kg'],
                $row['peso_em_libras'],
                new DateTime($row['data_captura'])
            );
        }
        return $capturados;
    }

    public function findById(int $id): ?Capturados{
        $stmt = $this->pdo->prepare('SELECT * FROM ' . self::VIEW . ' WHERE numero = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch();
        if($row === false){
            return null;
        }
        return new Capturados(
            $this->pokedexRepository->findById($row['numero']),
            $row['nome'],
            $this->habilidadeRepository->findById($row['habilidade']),
            $row['hp'],
            $row['ataque'],
            $row['defesa'],
            $row['sp_ataque'],
            $row['sp_defesa'],
            $row['velocidade'],
            $row['nivel'],
            $row['sexo'],
            $row['altura'],
            $row['peso_em_kg'],
            $row['peso_em_libras'],
            new DateTime($row['data_captura'])
        );
    }


}

?>