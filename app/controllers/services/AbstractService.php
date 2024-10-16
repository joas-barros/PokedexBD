<?php 

abstract class AbstractService {
    public function respondMethodNotAllowed(){
        http_response_code(405);
        echo json_encode([
            'status' => 'error',
            'message' => 'Método não permitido'
        ]);
    }

    public function respondInternalServerError(PDOException $e){
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Erro interno no servidor',
            "error" => $e->getMessage()
        ]);
    }
}
?>