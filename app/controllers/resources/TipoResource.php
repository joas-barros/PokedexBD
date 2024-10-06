<?php 

require_once 'app/controllers/services/TipoService.php';
require_once 'app/model/entities/Tipo.php';

// deve monstar as rotas de acesso para o service

class TipoResource {
    // Definindo rotas de acesso para os services
    private TipoService $tipoService;

    public function __construct(){
        $this->tipoService = new TipoService();
    }

    // função que chama o finaAll do service e retorna um json com os dados
    public function findAll(){
        $tipos = $this->tipoService->findAll();
        $tiposArray = [];
        foreach($tipos as $tipo){
            $tiposArray[] = $tipo->jsonSerialize();
        }
        echo json_encode($tiposArray, JSON_PRETTY_PRINT);
    }
}
?>