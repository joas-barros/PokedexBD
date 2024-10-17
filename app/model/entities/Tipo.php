<?php 
class Tipo implements JsonSerializable {
    private int $id;
    private string $nome;

    public function __construct(int $id = 0, string $nome){
        $this->id = $id;
        $this->nome = $nome;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }


    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
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