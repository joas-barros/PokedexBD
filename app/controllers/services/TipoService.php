<?php 

require_once 'app/model/entities/Tipo.php';
require_once 'app/model/repository/impl/TipoRepository.php';

// Descrição a classe deve receber os metodos do repository e retornar json nos métodos de get, ja nos métodos de post, put e delete deve retornar um status code
// sendo que nos de post e put deve receber um json e transformar em objeto para ser salvo no banco


class TipoService{
    private TipoRepository $tipoRepository;

    public function __construct(){
        $this->tipoRepository = new TipoRepository();
    }

    public function findAll(): array {
        return $this->tipoRepository->findAll();
    }

    public function findById(int $id): ?Tipo {
        return $this->tipoRepository->findById($id);
    }

    public function save($obj): void {
        $this->tipoRepository->save($obj);
    }

    public function update($obj): void {
        $this->tipoRepository->update($obj);
    }

    public function delete(int $id): void {
        $this->tipoRepository->delete($id);
    }
}

?>