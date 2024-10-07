<?php 

class Habilidade implements JsonSerializable {
    private int $id;
    private string $nome;
    private string $descricao;
    private Efeito $efeito;
    private Tipo $tipo;

    public function __construct(int $id, string $nome, string $descricao, Efeito $efeito, Tipo $tipo){
        $this->id = $id;
        $this->nome = $nome;
        $this->descricao = $descricao;
        $this->efeito = $efeito;
        $this->tipo = $tipo;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function getEfeito(): Efeito {
        return $this->efeito;
    }

    public function getTipo(): Tipo {
        return $this->tipo;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    public function setEfeito(Efeito $efeito): void {
        $this->efeito = $efeito;
    }

    public function setTipo(Tipo $tipo): void {
        $this->tipo = $tipo;
    }

    public function jsonSerialize(){
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'descricao' => $this->descricao,
            'efeito' => $this->efeito->jsonSerialize(),
            'tipo' => $this->tipo->jsonSerialize()
        ];
    }
}

?>