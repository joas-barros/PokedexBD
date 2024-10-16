<?php 

require_once 'app/model/repository/impl/PokemonRepository.php';
require_once 'app/model/repository/impl/HabilidadeRepository.php';
require_once 'app/model/repository/impl/PokedexRepository.php';

class PokemonService {

    private PokemonRepository $pokemonRepository;
    private HabilidadeRepository $habilidadeRepository;
    private PokedexRepository $pokedexRepository;

    public function __construct(){
        $this->pokemonRepository = new PokemonRepository();
        $this->habilidadeRepository = new HabilidadeRepository();
        $this->pokedexRepository = new PokedexRepository();
    }

    public function findAll(){
        $pokemons = $this->pokemonRepository->findAll();
        echo json_encode($pokemons);
    }

    public function findById($id){
        $pokemon = $this->pokemonRepository->findById($id);
        if ($pokemon){
            echo json_encode($pokemon);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Pokemon não encontrado'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['pokedex']) && isset($input['nome']) && isset($input['habilidade1']) && isset($input['level_min']) && isset($input['level_max']) && isset($input['hp_min']) && isset($input['hp_max']) && isset($input['attack_min']) && isset($input['attack_max']) && isset($input['defense_min']) && isset($input['defense_max']) && isset($input['sp_attack_min']) && isset($input['sp_attack_max']) && isset($input['sp_defense_min']) && isset($input['sp_defense_max']) && isset($input['velocidade_min']) && isset($input['velocidade_max']) && isset($input['sexo']) && isset($input['altura']) && isset($input['peso']) && isset($input['pokemonIMG'])){
            $pokedex = $this->pokedexRepository->findById($input['pokedex']);
            $habilidade1 = $this->habilidadeRepository->findById($input['habilidade1']);
            $habilidade2 = $this->habilidadeRepository->findById($input['habilidade2']);
            $habilidade3 = $this->habilidadeRepository->findById($input['habilidade3']);
            $habilidade4 = $this->habilidadeRepository->findById($input['habilidade4']);
            if ($pokedex && (isset($input['habilidade2']) ? $habilidade2 : true) && (isset($input['habilidade3']) ? $habilidade3 : true) && (isset($input['habilidade4']) ? $habilidade4 : true)){
                $novoPokemon = new Pokemon($pokedex, $input['nome'], $habilidade1, $habilidade2, $habilidade3, $habilidade4, $input['level_min'], $input['level_max'], $input['hp_min'], $input['hp_max'], $input['attack_min'], $input['attack_max'], $input['defense_min'], $input['defense_max'], $input['sp_attack_min'], $input['sp_attack_max'], $input['sp_defense_min'], $input['sp_defense_max'], $input['velocidade_min'], $input['velocidade_max'], $input['sexo'], $input['altura'], $input['peso'], $input['pokemonIMG']);
                if($novoPokemon){
                    $this->pokemonRepository->save($novoPokemon);
                    http_response_code(201);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pokemon criado com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao criar pokemon'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Pokedex ou habilidade não encontrada'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Dados incompletos'
            ]);
        }
    }

    public function update($id){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['habilidade1']) && isset($input['level_min']) && isset($input['level_max']) && isset($input['hp_min']) && isset($input['hp_max']) && isset($input['attack_min']) && isset($input['attack_max']) && isset($input['defense_min']) && isset($input['defense_max']) && isset($input['sp_attack_min']) && isset($input['sp_attack_max']) && isset($input['sp_defense_min']) && isset($input['sp_defense_max']) && isset($input['velocidade_min']) && isset($input['velocidade_max']) && isset($input['sexo']) && isset($input['altura']) && isset($input['peso']) && isset($input['pokemonIMG'])){
            $pokedex = $this->pokedexRepository->findById($id);
            $habilidade1 = $this->habilidadeRepository->findById($input['habilidade1']);
            $habilidade2 = $this->habilidadeRepository->findById($input['habilidade2']);
            $habilidade3 = $this->habilidadeRepository->findById($input['habilidade3']);
            $habilidade4 = $this->habilidadeRepository->findById($input['habilidade4']);
            if ($pokedex && $habilidade1 && (isset($input['habilidade2']) ? $habilidade2 : true) && (isset($input['habilidade3']) ? $habilidade3 : true) && (isset($input['habilidade4']) ? $habilidade4 : true)){
                $pokemon = new Pokemon($pokedex, $input['nome'], $habilidade1, $habilidade2, $habilidade3, $habilidade4, $input['level_min'], $input['level_max'], $input['hp_min'], $input['hp_max'], $input['attack_min'], $input['attack_max'], $input['defense_min'], $input['defense_max'], $input['sp_attack_min'], $input['sp_attack_max'], $input['sp_defense_min'], $input['sp_defense_max'], $input['velocidade_min'], $input['velocidade_max'], $input['sexo'], $input['altura'], $input['peso'], $input['pokemonIMG']);
                if($this->pokemonRepository->update($id, $pokemon)){
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pokemon atualizado com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao atualizar pokemon'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Pokedex ou habilidades não encontradas'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Dados incompletos'
            ]);
        }
    }

    public function delete($id){
        $pokemon = $this->pokemonRepository->findById($id);
        if ($pokemon){
            $this->pokemonRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Pokemon deletado com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Pokemon não encontrado'
            ]);
        }
    }

    public function respondMethodNotAllowed() {
        http_response_code(405);
        echo json_encode([
            "status" => "error",
            "message" => "Método não permitido."
        ]);
    }
}

?>