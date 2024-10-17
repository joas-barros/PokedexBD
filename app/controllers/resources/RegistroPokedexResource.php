<?php 

require_once 'app/controllers/services/RegistroPokedexService.php';

class RegistroPokedexResource{
    private RegistroPokedexService $registroPokedexService;

    public function __construct(){
        $this->registroPokedexService = new RegistroPokedexService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    if($id){
                        $this->registroPokedexService->findById($id);
                    } else {
                        $this->registroPokedexService->findAll();
                    }
                    break;
                case 'POST':
                    $this->registroPokedexService->save();
                    break;
                case 'PUT':
                    if ($id){
                        $this->registroPokedexService->update($id);
                    } else {
                        $this->registroPokedexService->respondMethodNotAllowed();
                    }
                    break;
                case 'DELETE':
                    if ($id){
                        $this->registroPokedexService->delete($id);
                    } else {
                        $this->registroPokedexService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->registroPokedexService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
            $this->registroPokedexService->respondInternalServerError($e);
        }
    }
}
?>