<?php 

require_once 'app/model/repository/impl/EvolucaoRepository.php';
require_once 'app/model/repository/impl/PokedexRepository.php';

require_once 'app/model/entities/Evolucao.php';

class EvolucaoService {

    private EvolucaoRepository $evolucaoRepository;
    private PokedexRepository $pokedexRepository;

    public function __construct(){
        $this->evolucaoRepository = new EvolucaoRepository();
        $this->pokedexRepository = new PokedexRepository();
    }

    public function findAll(){
        $evolucoes = $this->evolucaoRepository->findAll();
        echo json_encode($evolucoes);
    }

    public function findById($input){

        if (isset($input['anterior']) && isset($input['sucessor'])){
            $evolucao = $this->evolucaoRepository->findById($input['anterior'], $input['sucessor']);
            if ($evolucao){
                echo json_encode($evolucao);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Evolução não encontrada'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Parâmetros inválidos'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['anterior']) && isset($input['sucessor'])){
            $anterior = $this->pokedexRepository->findById($input['anterior']);
            $sucessor = $this->pokedexRepository->findById($input['sucessor']);
            if ($anterior && $sucessor){
                $evolucao = new Evolucao($anterior, $sucessor);
                $this->evolucaoRepository->save($evolucao);
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Evolução criada com sucesso'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Pokémon não encontrado'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Parâmetros inválidos'
            ]);
        }
    }

    public function delete($input){
        if (isset($input['anterior']) && isset($input['sucessor'])){
            $evolucao = $this->evolucaoRepository->findById($input['anterior'], $input['sucessor']);
            if ($evolucao){
                $this->evolucaoRepository->delete($input['anterior'], $input['sucessor']);
                http_response_code(200);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Evolução deletada com sucesso'
                ]);
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Evolução não encontrada'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Parâmetros inválidos'
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