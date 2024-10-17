<?php 
require_once 'app/controllers/services/PokedexService.php';

class PokedexResource{
    private PokedexService $pokedexService;

    public function __construct(){
        $this->pokedexService = new PokedexService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    if($id){
                        $this->pokedexService->findById($id);
                    } else {
                        $this->pokedexService->findAll();
                    }
                    break;
                case 'POST':
                    $this->pokedexService->save();
                    break;
                case 'PUT':
                    if ($id){
                        $this->pokedexService->update($id);
                    } else {
                        $this->pokedexService->respondMethodNotAllowed();
                    }
                    break;
                case 'DELETE':
                    if ($id){
                        $this->pokedexService->delete($id);
                    } else {
                        $this->pokedexService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->pokedexService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
            $this->pokedexService->respondInternalServerError($e);
        }
    }
}
?>