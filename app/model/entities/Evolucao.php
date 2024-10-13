<?php 

class Evolucao implements JsonSerializable {
    private Pokedex $anterior;
    private Pokedex $sucessor;

    public function __construct(Pokedex $anterior, Pokedex $sucessor) {
        $this->anterior = $anterior;
        $this->sucessor = $sucessor;
    }

    public function getAnterior(): Pokedex {
        return $this->anterior;
    }

    public function getSucessor(): Pokedex {
        return $this->sucessor;
    }

    public function setAnterior(Pokedex $anterior): void {
        $this->anterior = $anterior;
    }

    public function setSucessor(Pokedex $sucessor): void {
        $this->sucessor = $sucessor;
    }

    public function jsonSerialize(): array {
        return [
            'anterior' => $this->anterior->jsonSerialize(),
            'sucessor' => $this->sucessor->jsonSerialize()
        ];
    }
}

?>