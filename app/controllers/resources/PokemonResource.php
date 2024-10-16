<?php 

require_once 'app/controllers/services/PokemonService.php';

class PokemonResource{
    private PokemonService $pokemonService;

    public function __construct(){
        $this->pokemonService = new PokemonService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    if($id){
                        $this->pokemonService->findById($id);
                    } else {
                        $this->pokemonService->findAll();
                    }
                    break;
                case 'POST':
                    $this->pokemonService->save();
                    break;
                case 'PUT':
                    if ($id){
                        $this->pokemonService->update($id);
                    } else {
                        $this->pokemonService->respondMethodNotAllowed();
                    }
                    break;
                case 'DELETE':
                    if ($id){
                        $this->pokemonService->delete($id);
                    } else {
                        $this->pokemonService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->pokemonService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
            $this->pokemonService->respondInternalServerError($e);
        }
    }
}

?>