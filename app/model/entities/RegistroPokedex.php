<?php 

class RegistroPokedex implements JsonSerializable {
    private Pokedex $pokemon;
    private Treinador $treinador;
    private DateTime $dataCaptura;
    private int $hp;
    private int $ataque;
    private int $defesa;
    private int $ataqueEspecial;
    private int $defesaEspecial;
    private int $velocidade;
    private int $nivel;

    public function __construct(Pokedex $pokemon, Treinador $treinador, DateTime $dataCaptura = null, int $hp= null, int $ataque= null, int $defesa= null, int $ataqueEspecial= null, int $defesaEspecial= null, int $velocidade= null, int $nivel= null) {
        $this->pokemon = $pokemon;
        $this->treinador = $treinador;
        $this->dataCaptura = $dataCaptura;
        $this->hp = $hp;
        $this->ataque = $ataque;
        $this->defesa = $defesa;
        $this->ataqueEspecial = $ataqueEspecial;
        $this->defesaEspecial = $defesaEspecial;
        $this->velocidade = $velocidade;
        $this->nivel = $nivel;
    }

    public function getPokemon(): Pokedex {
        return $this->pokemon;
    }

    public function getTreinador(): Treinador {
        return $this->treinador;
    }

    public function getDataCaptura(): DateTime {
        return $this->dataCaptura;
    }

    public function getHp(): int {
        return $this->hp;
    }

    public function getAtaque(): int {
        return $this->ataque;
    }

    public function getDefesa(): int {
        return $this->defesa;
    }

    public function getAtaqueEspecial(): int {
        return $this->ataqueEspecial;
    }

    public function getDefesaEspecial(): int {
        return $this->defesaEspecial;
    }

    public function getVelocidade(): int {
        return $this->velocidade;
    }

    public function getNivel(): int {
        return $this->nivel;
    }

    public function setPokemon(Pokedex $pokemon): void {
        $this->pokemon = $pokemon;
    }

    public function setTreinador(Treinador $treinador): void {
        $this->treinador = $treinador;
    }

    public function setDataCaptura(DateTime $dataCaptura): void {
        $this->dataCaptura = $dataCaptura;
    }

    public function setHp(int $hp): void {
        $this->hp = $hp;
    }

    public function setAtaque(int $ataque): void {
        $this->ataque = $ataque;
    }

    public function setDefesa(int $defesa): void {
        $this->defesa = $defesa;
    }

    public function setAtaqueEspecial(int $ataqueEspecial): void {
        $this->ataqueEspecial = $ataqueEspecial;
    }

    public function setDefesaEspecial(int $defesaEspecial): void {
        $this->defesaEspecial = $defesaEspecial;
    }

    public function setVelocidade(int $velocidade): void {
        $this->velocidade = $velocidade;
    }

    public function setNivel(int $nivel): void {
        $this->nivel = $nivel;
    }

    public function jsonSerialize(): array {
        return [
            'pokemon' => $this->pokemon->jsonSerialize(),
            'treinador' => $this->treinador->jsonSerialize(),
            'dataCaptura' => $this->dataCaptura->format('Y-m-d'),
            'hp' => $this->hp,
            'ataque' => $this->ataque,
            'defesa' => $this->defesa,
            'ataqueEspecial' => $this->ataqueEspecial,
            'defesaEspecial' => $this->defesaEspecial,
            'velocidade' => $this->velocidade,
            'nivel' => $this->nivel
        ];
    }
}

?>