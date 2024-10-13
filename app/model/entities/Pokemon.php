<?php 

class Pokemon implements JsonSerializable {

    private Pokedex $pokedex;
    private string $nome;
    private Habilidade $habilidade1;
    private Habilidade $habilidade2;
    private Habilidade $habilidade3;
    private Habilidade $habilidade4;
    private int $level_min;
    private int $level_max;
    private int $hp_min;
    private int $hp_max;
    private int $attack_min;
    private int $attack_max;
    private int $defense_min;
    private int $defense_max;
    private int $sp_attack_min;
    private int $sp_attack_max;
    private int $sp_defense_min;
    private int $sp_defense_max;
    private int $velocidade_min;
    private int $velocidade_max;
    private string $sexo;
    private float $altura;
    private float $peso;
    private string $pokemonIMG;

    public function __construct(Pokedex $pokedex, string $nome, Habilidade $habilidade1, Habilidade $habilidade2, Habilidade $habilidade3, Habilidade $habilidade4, int $level_min=1, int $level_max=100, int $hp_min, int $hp_max, int $attack_min, int $attack_max, int $defense_min, int $defense_max, int $sp_attack_min, int $sp_attack_max, int $sp_defense_min, int $sp_defense_max, int $velocidade_min, int $velocidade_max, string $sexo, float $altura, float $peso, string $pokemonIMG) {
        $this->pokedex = $pokedex;
        $this->nome = $nome;
        $this->habilidade1 = $habilidade1;
        $this->habilidade2 = $habilidade2;
        $this->habilidade3 = $habilidade3;
        $this->habilidade4 = $habilidade4;
        $this->level_min = $level_min;
        $this->level_max = $level_max;
        $this->hp_min = $hp_min;
        $this->hp_max = $hp_max;
        $this->attack_min = $attack_min;
        $this->attack_max = $attack_max;
        $this->defense_min = $defense_min;
        $this->defense_max = $defense_max;
        $this->sp_attack_min = $sp_attack_min;
        $this->sp_attack_max = $sp_attack_max;
        $this->sp_defense_min = $sp_defense_min;
        $this->sp_defense_max = $sp_defense_max;
        $this->velocidade_min = $velocidade_min;
        $this->velocidade_max = $velocidade_max;
        $this->sexo = $sexo;
        $this->altura = $altura;
        $this->peso = $peso;
        $this->pokemonIMG = $pokemonIMG;
    }

    // getters e setters
    public function getPokedex(): Pokedex {
        return $this->pokedex;
    }

    public function setPokedex(Pokedex $pokedex): void {
        $this->pokedex = $pokedex;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getHabilidade1(): Habilidade {
        return $this->habilidade1;
    }

    public function setHabilidade1(Habilidade $habilidade1): void {
        $this->habilidade1 = $habilidade1;
    }

    public function getHabilidade2(): Habilidade {
        return $this->habilidade2;
    }

    public function setHabilidade2(Habilidade $habilidade2): void {
        $this->habilidade2 = $habilidade2;
    }

    public function getHabilidade3(): Habilidade {
        return $this->habilidade3;
    }

    public function setHabilidade3(Habilidade $habilidade3): void {
        $this->habilidade3 = $habilidade3;
    }

    public function getHabilidade4(): Habilidade {
        return $this->habilidade4;
    }

    public function setHabilidade4(Habilidade $habilidade4): void {
        $this->habilidade4 = $habilidade4;
    }

    public function getLevelMin(): int {
        return $this->level_min;
    }

    public function setLevelMin(int $level_min): void {
        $this->level_min = $level_min;
    }

    public function getLevelMax(): int {
        return $this->level_max;
    }

    public function setLevelMax(int $level_max): void {
        $this->level_max = $level_max;
    }

    public function getHpMin(): int {
        return $this->hp_min;
    }

    public function setHpMin(int $hp_min): void {
        $this->hp_min = $hp_min;
    }

    public function getHpMax(): int {
        return $this->hp_max;
    }

    public function setHpMax(int $hp_max): void {
        $this->hp_max = $hp_max;
    }

    public function getAttackMin(): int {
        return $this->attack_min;
    }

    public function setAttackMin(int $attack_min): void {
        $this->attack_min = $attack_min;
    }

    public function getAttackMax(): int {
        return $this->attack_max;
    }

    public function setAttackMax(int $attack_max): void {
        $this->attack_max = $attack_max;
    }

    public function getDefenseMin(): int {
        return $this->defense_min;
    }

    public function setDefenseMin(int $defense_min): void {
        $this->defense_min = $defense_min;
    }

    public function getDefenseMax(): int {
        return $this->defense_max;
    }

    public function setDefenseMax(int $defense_max): void {
        $this->defense_max = $defense_max;
    }

    public function getSpAttackMin(): int {
        return $this->sp_attack_min;
    }

    public function setSpAttackMin(int $sp_attack_min): void {
        $this->sp_attack_min = $sp_attack_min;
    }

    public function getSpAttackMax(): int {
        return $this->sp_attack_max;
    }

    public function setSpAttackMax(int $sp_attack_max): void {
        $this->sp_attack_max = $sp_attack_max;
    }

    public function getSpDefenseMin(): int {
        return $this->sp_defense_min;
    }

    public function setSpDefenseMin(int $sp_defense_min): void {
        $this->sp_defense_min = $sp_defense_min;
    }

    public function getSpDefenseMax(): int {
        return $this->sp_defense_max;
    }

    public function setSpDefenseMax(int $sp_defense_max): void {
        $this->sp_defense_max = $sp_defense_max;
    }

    public function getVelocidadeMin(): int {
        return $this->velocidade_min;
    }

    public function setVelocidadeMin(int $velocidade_min): void {
        $this->velocidade_min = $velocidade_min;
    }

    public function getVelocidadeMax(): int {
        return $this->velocidade_max;
    }

    public function setVelocidadeMax(int $velocidade_max): void {
        $this->velocidade_max = $velocidade_max;
    }

    public function getSexo(): string {
        return $this->sexo;
    }

    public function setSexo(string $sexo): void {
        $this->sexo = $sexo;
    }

    public function getAltura(): float {
        return $this->altura;
    }

    public function setAltura(float $altura): void {
        $this->altura = $altura;
    }

    public function getPeso(): float {
        return $this->peso;
    }

    public function setPeso(float $peso): void {
        $this->peso = $peso;
    }

    public function getPokemonIMG(): string {
        return $this->pokemonIMG;
    }

    public function setPokemonIMG(string $pokemonIMG): void {
        $this->pokemonIMG = $pokemonIMG;
    }

    public function jsonSerialize(): array {
        return [
            'pokedex' => $this->pokedex->jsonSerialize(),
            'nome' => $this->nome,
            'habilidade1' => $this->habilidade1->jsonSerialize(),
            'habilidade2' => $this->habilidade2->jsonSerialize(),
            'habilidade3' => $this->habilidade3->jsonSerialize(),
            'habilidade4' => $this->habilidade4->jsonSerialize(),
            'level_min' => $this->level_min,
            'level_max' => $this->level_max,
            'hp_min' => $this->hp_min,
            'hp_max' => $this->hp_max,
            'attack_min' => $this->attack_min,
            'attack_max' => $this->attack_max,
            'defense_min' => $this->defense_min,
            'defense_max' => $this->defense_max,
            'sp_attack_min' => $this->sp_attack_min,
            'sp_attack_max' => $this->sp_attack_max,
            'sp_defense_min' => $this->sp_defense_min,
            'sp_defense_max' => $this->sp_defense_max,
            'velocidade_min' => $this->velocidade_min,
            'velocidade_max' => $this->velocidade_max,
            'sexo' => $this->sexo,
            'altura' => $this->altura,
            'peso' => $this->peso,
            'pokemonIMG' => $this->pokemonIMG
        ];
    }

}

?>