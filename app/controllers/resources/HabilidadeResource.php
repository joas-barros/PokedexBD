<?php 

require_once 'app/controllers/services/HabilidadeService.php';

class HabilidadeResource{
    private HabilidadeService $habilidadeService;

    public function __construct(){
        $this->habilidadeService = new HabilidadeService();
    }

    public function handleRequest($method, $id = null){
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
                $this->habilidadeService->update($id);
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
    }
}

?>