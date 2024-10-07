<?php 

class Efeito implements JsonSerializable {
    private int $id;
    private string $nome;
    private string $informacao;

    public function __construct(int $id = 0, string $nome, string $informacao){
        $this->id = $id;
        $this->nome = $nome;
        $this->informacao = $informacao;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getInformacao(): string {
        return $this->informacao;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setInformacao(string $informacao): void {
        $this->informacao = $informacao;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'informacao' => $this->informacao
        ];
    }
}
?>