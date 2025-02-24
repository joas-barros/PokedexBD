<?php 
require_once 'app/model/repository/impl/TipoRepository.php';
require_once 'app/model/entities/Tipo.php';
require_once 'app/controllers/services/AbstractService.php';

class TipoService extends AbstractService {
    private TipoRepository $tipoRepository;

    public function __construct(){
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(){
        $tipos = $this->tipoRepository->findAll();
        echo json_encode($tipos);
    }

    public function findById($id){
        $tipo = $this->tipoRepository->findById($id);
        if ($tipo){
            echo json_encode($tipo);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipo não encontrado'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['id'])){
            $novoTipo = new Tipo($input['id'], $input['nome']);
            if($novoTipo){
                $this->tipoRepository->save($novoTipo);
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Tipo criado com sucesso'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao criar tipo'
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

        if (isset($input['nome'])){
            $tipo = new Tipo($id, $input['nome']);
            if($tipo){
                $tipoAtualizado = $this->tipoRepository->update($id, $tipo);
                if (!$tipoAtualizado){
                    http_response_code(404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tipo não encontrado'
                    ]);
                } else {
                http_response_code(200);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Tipo atualizado com sucesso'
                ]);
                }
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao atualizar tipo'
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
        $tipo = $this->tipoRepository->findById($id);
        if ($tipo){
            $this->tipoRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Tipo deletado com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Tipo não encontrado'
            ]);
        }
    }
    
}
?>