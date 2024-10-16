<?php 

require_once 'app/controllers/services/EvolucaoService.php';

class EvolucaoResource{
    private EvolucaoService $evolucaoService;

    public function __construct(){
        $this->evolucaoService = new EvolucaoService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    $input = json_decode(file_get_contents('php://input'), true);
                    if($input){
                        $this->evolucaoService->findById($input);
                    } else {
                        $this->evolucaoService->findAll();
                    }
                    break;
                case 'POST':
                    $this->evolucaoService->save();
                    break;
                case 'DELETE':
                    $input = json_decode(file_get_contents('php://input'), true);
                    if ($input){
                        $this->evolucaoService->delete($input);
                    } else {
                        $this->evolucaoService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->evolucaoService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
            $this->evolucaoService->respondInternalServerError($e);
        }
    }
}
?>