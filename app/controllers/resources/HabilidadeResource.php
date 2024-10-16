<?php 

require_once 'app/controllers/services/HabilidadeService.php';

class HabilidadeResource{
    private HabilidadeService $habilidadeService;

    public function __construct(){
        $this->habilidadeService = new HabilidadeService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    if($id){
                        $this->habilidadeService->findById($id);
                    } else {
                        $this->habilidadeService->findAll();
                    }
                    break;
                case 'POST':
                    $this->habilidadeService->save();
                    break;
                case 'PUT':
                    if ($id){
                        $this->habilidadeService->update($id);
                    } else {
                        $this->habilidadeService->respondMethodNotAllowed();
                    }
                    break;
                case 'DELETE':
                    if ($id){
                        $this->habilidadeService->delete($id);
                    } else {
                        $this->habilidadeService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->habilidadeService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
            $this->habilidadeService->respondInternalServerError($e);
        }
    }
}

?>