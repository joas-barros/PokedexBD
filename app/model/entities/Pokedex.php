<?php 
require_once 'app/model/entities/Tipo.php';

class Pokedex implements JsonSerializable {
    private int $id;
    private string $name;
    private Tipo $tipo1;
    private ?Tipo $tipo2;
    private float $taxaDeCaptura;
    private int $geracao;
    private string $informacao;
    private bool $capturado;

    public function __construct(int $id, string $name, Tipo $tipo1, ?Tipo $tipo2, float $taxaDeCaptura, int $geracao, string $informacao, bool $capturado = false) {
        $this->id = $id;
        $this->name = $name;
        $this->tipo1 = $tipo1;
        $this->tipo2 = $tipo2;
        $this->taxaDeCaptura = $taxaDeCaptura;
        $this->geracao = $geracao;
        $this->informacao = $informacao;
        $this->capturado = $capturado;
    }

    // getters e setters
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void {
        $this->id = $id;
    }

    public function getNome(): string {
        return $this->name;
    }

    public function setNome(string $name): void {
        $this->name = $name;
    }

    public function getTipo1(): Tipo {
        return $this->tipo1;
    }

    public function setTipo1(Tipo $tipo1): void {
        $this->tipo1 = $tipo1;
    }

    public function getTipo2(): ?Tipo {
        return $this->tipo2;
    }

    public function setTipo2(?Tipo $tipo2): void {
        $this->tipo2 = $tipo2;
    }

    public function getTaxaDeCaptura(): float {
        return $this->taxaDeCaptura;
    }

    public function setTaxaDeCaptura(float $taxaDeCaptura): void {
        $this->taxaDeCaptura = $taxaDeCaptura;
    }

    public function getGeracao(): int {
        return $this->geracao;
    }

    public function setGeracao(int $geracao): void {
        $this->geracao = $geracao;
    }

    public function getInformacao(): string {
        return $this->informacao;
    }

    public function setInformacao(string $informacao): void {
        $this->informacao = $informacao;
    }

    public function getCapturado(): bool {
        return $this->capturado;
    }

    public function setCapturado(bool $capturado): void {
        $this->capturado = $capturado;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'nome' => $this->name,
            'tipo1' => $this->tipo1,
            'tipo2' => $this->tipo2,
            'taxaDeCaptura' => $this->taxaDeCaptura,
            'geracao' => $this->geracao,
            'informacao' => $this->informacao,
            'capturado' => $this->capturado
        ];
    }
}

?>