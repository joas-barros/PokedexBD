<?php 

require_once 'app/controllers/services/FraquezaService.php';

class FraquezaResource {
    private FraquezaService $fraquezaService;

    public function __construct(){
        $this->fraquezaService = new FraquezaService();
    }

    public function handleRequest($method, $id){
        switch ($method) {
            case 'GET':
                if($id){
                    $this->fraquezaService->findById($id);
                } else {
                    $this->fraquezaService->findAll();
                }
                break;
            case 'POST':
                $this->fraquezaService->save();
                break;
            case 'PUT':
                if ($id){
                    $this->fraquezaService->update($id);
                } else {
                    $this->fraquezaService->respondMethodNotAllowed();
                }
                break;
            case 'DELETE':
                if ($id){
                    $this->fraquezaService->delete($id);
                } else {
                    $this->fraquezaService->respondMethodNotAllowed();
                }
                break;
            default:
                $this->fraquezaService->respondMethodNotAllowed();
        }
    }
}

?>