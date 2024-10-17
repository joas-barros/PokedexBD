<?php 

interface RepositoryInterface {
    public function findAll();
    public function findById(int $id);
    public function save(object $obj);
    public function update(int $id, $obj);
    public function delete(int $id);
}

?>