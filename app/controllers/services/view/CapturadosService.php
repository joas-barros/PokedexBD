<?php 

require_once 'app/model/repository/view/CapturadosRepository.php';

class CapturadosService{
    private CapturadosRepository $capturadosRepository;

    public function __construct(){
        $this->capturadosRepository = new CapturadosRepository();
    }

    public function findAll(){
        $capturados = $this->capturadosRepository->findAll();
        echo json_encode($capturados);
    }

    public function findById($id){
        $capturado = $this->capturadosRepository->findById($id);
        if ($capturado){
            echo json_encode($capturado);
        } else {
            http_response_code(404);
            echo json_encode([
                'status' => 'error',
                'message' => 'Capturado não encontrado'
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