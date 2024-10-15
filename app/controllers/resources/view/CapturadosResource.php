<?php 

require_once 'app/controllers/services/view/CapturadosService.php';

class CapturadosResource {
    private CapturadosService $capturadosService;

    public function __construct(){
        $this->capturadosService = new CapturadosService();
    }

    public function handleRequest($method, $id){
        switch ($method) {
            case 'GET':
                if($id){
                    $this->capturadosService->findById($id);
                } else {
                    $this->capturadosService->findAll();
                }
                break;
            default:
                $this->capturadosService->respondMethodNotAllowed();
        }
    }
}
?>