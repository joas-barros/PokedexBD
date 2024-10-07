<?php 

require_once 'app/model/repository/impl/TipoRepository.php';
require_once 'app/controllers/services/TipoService.php';

class TipoResource{
    private TipoService $tipoService;

    public function __construct(){
        $this->tipoService = new TipoService();
    }

    public function handleRequest($method, $id = null){
        switch($method){
            case 'GET':
                if($id){
                    $this->tipoService->findById($id);
                } else {
                    $this->tipoService->findAll();
                }
                break;
            case 'POST':
                $this->tipoService->save();
                break;
            case 'PUT':
                $this->tipoService->update($id);
                break;
            case 'DELETE':
                if ($id){
                    $this->tipoService->delete($id);
                } else {
                    $this->tipoService->respondMethodNotAllowed();
                }
                break;
            default:
                $this->tipoService->respondMethodNotAllowed();
        }
    }
}
?>