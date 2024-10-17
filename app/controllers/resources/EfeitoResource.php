<?php 
require_once 'app/model/repository/impl/EfeitoRepository.php';
require_once 'app/controllers/services/EfeitoService.php';

class EfeitoResource{
    private EfeitoService $efeitoService;

    public function __construct(){
        $this->efeitoService = new EfeitoService();
    }

    public function handleRequest($method, $id = null){
        try {
            switch($method){
                case 'GET':
                    if($id){
                        $this->efeitoService->findById($id);
                    } else {
                        $this->efeitoService->findAll();
                    }
                    break;
                case 'POST':
                    $this->efeitoService->save();
                    break;
                case 'PUT':
                    if ($id){
                        $this->efeitoService->update($id);
                    } else {
                        $this->efeitoService->respondMethodNotAllowed();
                    }
                    break;
                case 'DELETE':
                    if ($id){
                        $this->efeitoService->delete($id);
                    } else {
                        $this->efeitoService->respondMethodNotAllowed();
                    }
                    break;
                default:
                    $this->efeitoService->respondMethodNotAllowed();
            }
        } catch ( PDOException $e){
        $this->efeitoService->respondInternalServerError($e);
        }
    }
}
?>