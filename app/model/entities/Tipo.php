<?php 
class Tipo implements JsonSerializable {
    private int $id;
    private string $nome;
    private string $cor;

    public function __construct(int $id = 0, string $nome, string $cor){
        $this->id = $id;
        $this->nome = $nome;
        $this->cor = $cor;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getCor(): string {
        return $this->cor;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setCor(string $cor): void {
        $this->cor = $cor;
    }

    public function jsonSerialize(): array{
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'cor' => $this->cor
        ];
    }
}
?>