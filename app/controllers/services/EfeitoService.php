<?php 

class EfeitoService{
    private EfeitoRepository $efeitoRepository;

    public function __construct(){
        $this->efeitoRepository = new EfeitoRepository();
    }

    public function findAll(){
        $efeitos = $this->efeitoRepository->findAll();
        echo json_encode($efeitos);
    }

    public function findById($id){
        $efeito = $this->efeitoRepository->findById($id);
        if ($efeito){
            echo json_encode($efeito);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Efeito não encontrado'
            ]);
        }
    }

    public function save(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['nome']) && isset($input['informacao'])){
            $novoEfeito = new Efeito(0, $input['nome'], $input['informacao']);
            if($novoEfeito){
                $this->efeitoRepository->save($novoEfeito);
                http_response_code(201);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Efeito criado com sucesso'
                ]);
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao criar efeito'
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

    public function update(){
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['id']) && isset($input['nome']) && isset($input['informacao'])){
            $efeito = new Efeito($input['id'], $input['nome'], $input['informacao']);
            if($efeito){
                $efeitoAtualizado = $this->efeitoRepository->update($efeito);
                if ($efeitoAtualizado){
                    http_response_code(200);
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Efeito atualizado com sucesso'
                    ]);
                } else {
                    http_response_code(404);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Efeito nao encontrado'
                    ]);
                }
            } else {
                http_response_code(500);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Erro ao atualizar efeito'
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
        $efeito = $this->efeitoRepository->findById($id);
        if ($efeito){
            $this->efeitoRepository->delete($id);
            http_response_code(200);
            echo json_encode([
                'status' => 'success',
                'message' => 'Efeito deletado com sucesso'
            ]);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Efeito não encontrado'
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