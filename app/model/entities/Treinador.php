<?php 

class Treinador implements JsonSerializable{
    private int $id;
    private string $nome;

    public function __construct(int $id, string $nome){
        $this->id = $id;
        $this->nome = $nome;
    }

    // getters e setters
    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }

    public function jsonSerialize(): array{
        return [
            'id' => $this->id,
            'nome' => $this->nome
        ];
    }
}

?>