<?php 

require_once 'app/model/repository/impl/TreinadorRepository.php';

class TreinadorService extends AbstractService {
    private TreinadorRepository $treinadorRepository;

    public function __construct(){
        $this->treinadorRepository = new TreinadorRepository();
    }

    public function findAll(){
        $treinadores = $this->treinadorRepository->findAll();
        echo json_encode($treinadores);
    }

    public function findById($id){
        $treinador = $this->treinadorRepository->findById($id);
        if ($treinador){
            echo json_encode($treinador);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Treinador não encontrado'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['email']) && isset($input['senha']) && isset($input['dataNascimento'])){
            $novoTreinador = new Treinador(0, $input['nome'], $input['email'], $input['senha'], new DateTime($input['dataNascimento']));
            if($novoTreinador){
                $this->treinadorRepository->save($novoTreinador);
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Treinador criado com sucesso'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao criar treinador'
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

        if (isset($input['nome']) && isset($input['email']) && isset($input['senha']) && isset($input['dataNascimento'])){
            $treinador = new Treinador($id, $input['nome'], $input['email'], $input['senha'], new DateTime($input['dataNascimento']));
            
            if($treinador){
                $treinadorAtualizado = $this->treinadorRepository->update($id, $treinador);
                if (!$treinadorAtualizado){
                    http_response_code(404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Treinador não encontrado'
                    ]);
                } else {
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Treinador atualizado com sucesso'
                    ]);
                }
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao atualizar treinador'
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
        $treinador = $this->treinadorRepository->findById($id);
        if ($treinador){
            $this->treinadorRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Treinador deletado com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Treinador não encontrado'
            ]);
        }
    }

}
?>