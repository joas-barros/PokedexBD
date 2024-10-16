<?php 

class Fraqueza implements JsonSerializable {
    private Tipo $tipo;
    private Tipo $fraqueza1;
    private ?Tipo $fraqueza2;
    private ?Tipo $fraqueza3;
    private ?Tipo $fraqueza4;
    private ?Tipo $fraqueza5;

    public function __construct(Tipo $tipo, Tipo $fraqueza1 , Tipo $fraqueza2= null, Tipo $fraqueza3= null, Tipo $fraqueza4= null, Tipo $fraqueza5= null) {
        $this->tipo = $tipo;
        $this->fraqueza1 = $fraqueza1;
        $this->fraqueza2 = $fraqueza2;
        $this->fraqueza3 = $fraqueza3;
        $this->fraqueza4 = $fraqueza4;
        $this->fraqueza5 = $fraqueza5;
    }

    public function getTipo(): Tipo {
        return $this->tipo;
    }

    public function getFraqueza1(): Tipo {
        return $this->fraqueza1;
    }

    public function getFraqueza2(): ?Tipo {
        return $this->fraqueza2;
    }

    public function getFraqueza3(): ?Tipo {
        return $this->fraqueza3;
    }

    public function getFraqueza4(): ?Tipo {
        return $this->fraqueza4;
    }

    public function getFraqueza5(): ?Tipo {
        return $this->fraqueza5;
    }

    // setters
    public function setTipo(Tipo $tipo): void {
        $this->tipo = $tipo;
    }

    public function setFraqueza1(Tipo $fraqueza1): void {
        $this->fraqueza1 = $fraqueza1;
    }

    public function setFraqueza2(?Tipo $fraqueza2): void {
        $this->fraqueza2 = $fraqueza2;
    }

    public function setFraqueza3(?Tipo $fraqueza3): void {
        $this->fraqueza3 = $fraqueza3;
    }

    public function setFraqueza4(?Tipo $fraqueza4): void {
        $this->fraqueza4 = $fraqueza4;
    }

    public function setFraqueza5(?Tipo $fraqueza5): void {
        $this->fraqueza5 = $fraqueza5;
    }

    public function jsonSerialize(): array {
        return [
            'tipo' => $this->tipo,
            'fraqueza1' => $this->fraqueza1,
            'fraqueza2' => $this->fraqueza2,
            'fraqueza3' => $this->fraqueza3,
            'fraqueza4' => $this->fraqueza4,
            'fraqueza5' => $this->fraqueza5
        ];
    }
}
?>