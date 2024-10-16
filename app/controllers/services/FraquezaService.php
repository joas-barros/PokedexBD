<?php 

require_once 'app/model/repository/impl/FraquezaRepository.php';
require_once 'app/model/entities/Fraqueza.php';
require_once 'app/model/entities/Tipo.php';
require_once 'app/model/repository/impl/TipoRepository.php';

class FraquezaService extends AbstractService {

    private FraquezaRepository $fraquezaRepository;
    private TipoRepository $tipoRepository;

    public function __construct(){
        $this->fraquezaRepository = new FraquezaRepository();
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(){
        $fraquezas = $this->fraquezaRepository->findAll();
        echo json_encode($fraquezas);
    }

    public function findById($id){
        $fraqueza = $this->fraquezaRepository->findById($id);
        if ($fraqueza){
            echo json_encode($fraqueza);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Fraqueza não encontrada'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['tipo']) && isset($input['fraqueza1'])){
            $tipo = $this->tipoRepository->findById($input['tipo']);
            $fraqueza1 = $this->tipoRepository->findById($input['fraqueza1']);
            $fraqueza2 = $this->tipoRepository->findById($input['fraqueza2']);
            $fraqueza3 = $this->tipoRepository->findById($input['fraqueza3']);
            $fraqueza4 = $this->tipoRepository->findById($input['fraqueza4']);
            $fraqueza5 = $this->tipoRepository->findById($input['fraqueza5']);
            
            if ($tipo && $fraqueza1 && (isset($input['fraqueza2']) ? $fraqueza2 : true) && (isset($input['fraqueza3']) ? $fraqueza3 : true) && (isset($input['fraqueza4']) ? $fraqueza4 : true) && (isset($input['fraqueza5']) ? $fraqueza5 : true)){

                $novaFraqueza = new Fraqueza($tipo, $fraqueza1, $fraqueza2, $fraqueza3, $fraqueza4, $fraqueza5);
                if($novaFraqueza){
                    $this->fraquezaRepository->save($novaFraqueza);
                    http_response_code(201);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Fraqueza criada com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao criar fraqueza'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tipo ou fraquezas não encontrados'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipo e fraquezas são obrigatórios'
            ]);
        }
    }

    public function update(int $id){
        $input = json_decode(file_get_contents('php://input'), true);

        if ( isset($input['fraqueza1']) ){
            $tipo = $this->tipoRepository->findById($id);
            $fraqueza1 = $this->tipoRepository->findById($input['fraqueza1']);
            $fraqueza2 = $this->tipoRepository->findById($input['fraqueza2']);
            $fraqueza3 = $this->tipoRepository->findById($input['fraqueza3']);
            $fraqueza4 = $this->tipoRepository->findById($input['fraqueza4']);
            $fraqueza5 = $this->tipoRepository->findById($input['fraqueza5']);
            if ($fraqueza1 && (isset($input['fraqueza2']) ? $fraqueza2 : true) && (isset($input['fraqueza3']) ? $fraqueza3 : true) && (isset($input['fraqueza4']) ? $fraqueza4 : true) && (isset($input['fraqueza5']) ? $fraqueza5 : true)){
                $fraquezaAtualizada = new Fraqueza($tipo, $fraqueza1, $fraqueza2, $fraqueza3, $fraqueza4, $fraqueza5);
                $fraqueza = $this->fraquezaRepository->update($id, $fraquezaAtualizada);
                if($fraqueza){
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Fraqueza atualizada com sucesso'
                    ]);
                } else {
                    http_response_code(500);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Erro ao atualizar fraqueza'
                    ]);
                }
            } else {
                http_response_code(404);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Tipo ou fraquezas não encontrados'
                ]);
            }
        } else {
            http_response_code(400);
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipo e fraquezas são obrigatórios'
            ]);
        }
    }

    public function delete($id){
        $fraqueza = $this->fraquezaRepository->findById($id);
        if ($fraqueza){
            $this->fraquezaRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Fraqueza deletada com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Fraqueza não encontrada'
            ]);
        }
    }

}

?>