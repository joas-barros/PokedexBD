<?php 

require_once 'app/model/entities/Tipo.php';
require_once 'app/model/entities/Pokedex.php';
require_once 'app/model/repository/impl/PokedexRepository.php';

class PokedexService extends AbstractService {
    private PokedexRepository $pokedexRepository;
    private TipoRepository $tipoRepository;

    public function __construct(){
        $this->pokedexRepository = new PokedexRepository();
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(){
        $pokemons = $this->pokedexRepository->findAll();
        echo json_encode($pokemons);
    }

    public function findById($id){
        $pokemon = $this->pokedexRepository->findById($id);
        if ($pokemon){
            echo json_encode($pokemon);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Pokedex não encontrada'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['id']) && isset($input['nome']) && isset($input['tipo1']) && isset($input['taxaDeCaptura']) && isset($input['geracao']) && isset($input['informacao'])){
            $tipo1 = $this->tipoRepository->findById($input['tipo1']);
            $tipo2 = $this->tipoRepository->findById($input['tipo2']);
            if ($tipo1 && (isset($input['tipo2']) ? $tipo2 : true)){
                $novoPokemon = new Pokedex($input['id'], $input['nome'], $tipo1, $tipo2, $input['taxaDeCaptura'], $input['geracao'], $input['informacao']);
                if($novoPokemon){
                    $this->pokedexRepository->save($novoPokemon);
                    http_response_code(201);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pokedex criada com sucesso'
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
                    'message' => 'Tipo não encontrado'
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


    public function update(int $id){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['tipo1']) && isset($input['taxaDeCaptura']) && isset($input['geracao']) && isset($input['informacao'])){
            $tipo1 = $this->tipoRepository->findById($input['tipo1']);
            $tipo2 = $this->tipoRepository->findById($input['tipo2']);
            if ($tipo1 && (isset($input['tipo2']) ? $tipo2 : true)){
                $pokemon = new Pokedex($id, $input['nome'], $tipo1, $tipo2, $input['taxaDeCaptura'], $input['geracao'], $input['informacao']);
                $pokemonAtualizado = $this->pokedexRepository->update($id, $pokemon);
                if($pokemonAtualizado){
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Pokedex atualizada com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao atualizar Pokedex'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tipo não encontrado'
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

    public function delete(int $id){
        $pokemon = $this->pokedexRepository->findById($id);
        if($pokemon){
            $this->pokedexRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Pokedex deletada com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Pokedex não encontrada'
            ]);
        }
    }

}

?>