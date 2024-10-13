<?php 

require_once 'app/controllers/services/TreinadorService.php';

class TreinadorResource {
    private TreinadorService $treinadorService;

    public function __construct(){
        $this->treinadorService = new TreinadorService();
    }

    public function handleRequest($method, $id){
        switch ($method) {
            case 'GET':
                if($id){
                    $this->treinadorService->findById($id);
                } else {
                    $this->treinadorService->findAll();
                }
                break;
            case 'POST':
                $this->treinadorService->save();
                break;
            case 'PUT':
                if($id){
                    $this->treinadorService->update($id);
                } else {
                    $this->treinadorService->respondMethodNotAllowed();
                }
                break;
            case 'DELETE':
                if($id){
                    $this->treinadorService->delete($id);
                } else {
                    $this->treinadorService->respondMethodNotAllowed();
                }
                break;
            default:
                $this->treinadorService->respondMethodNotAllowed();
        }
    }
}
?>