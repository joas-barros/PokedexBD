<?php 

class Capturados implements JsonSerializable{
    private Pokedex $pokedex;
    private string $nome;
    private Habilidade $habilidade;
    private int $hp;
    private int $ataque;
    private int $defesa;
    private int $sp_ataque;
    private int $sp_defesa;
    private int $velocidade;
    private int $nivel;
    private string $sexo;
    private float $altura;
    private float $peso_em_kg;
    private string $peso_em_libras;
    private DateTime $data_captura;


    public function __construct(Pokedex $pokedex, string $nome, Habilidade $habilidade, int $hp, int $ataque, int $defesa, int $sp_ataque, int $sp_defesa, int $velocidade, int $nivel, string $sexo, float $altura, float $peso_em_kg, string $peso_em_libras, DateTime $data_captura){
        $this->pokedex = $pokedex;
        $this->nome = $nome;
        $this->habilidade = $habilidade;
        $this->hp = $hp;
        $this->ataque = $ataque;
        $this->defesa = $defesa;
        $this->sp_ataque = $sp_ataque;
        $this->sp_defesa = $sp_defesa;
        $this->velocidade = $velocidade;
        $this->nivel = $nivel;
        $this->sexo = $sexo;
        $this->altura = $altura;
        $this->peso_em_kg = $peso_em_kg;
        $this->peso_em_libras = $peso_em_libras;
        $this->data_captura = $data_captura;
    }

    public function getPokedex(): Pokedex{
        return $this->pokedex;
    }

    public function setPokedex(Pokedex $pokedex): void{
        $this->pokedex = $pokedex;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }

    public function getHabilidade(): Habilidade{
        return $this->habilidade;
    }

    public function setHabilidade(Habilidade $habilidade): void{
        $this->habilidade = $habilidade;
    }

    public function getHp(): int{
        return $this->hp;
    }

    public function setHp(int $hp): void{
        $this->hp = $hp;
    }

    public function getAtaque(): int{
        return $this->ataque;
    }

    public function setAtaque(int $ataque): void{
        $this->ataque = $ataque;
    }

    public function getDefesa(): int{
        return $this->defesa;
    }

    public function setDefesa(int $defesa): void{
        $this->defesa = $defesa;
    }

    public function getSpAtaque(): int{
        return $this->sp_ataque;
    }

    public function setSpAtaque(int $sp_ataque): void{
        $this->sp_ataque = $sp_ataque;
    }

    public function getSpDefesa(): int{
        return $this->sp_defesa;
    }

    public function setSpDefesa(int $sp_defesa): void{
        $this->sp_defesa = $sp_defesa;
    }

    public function getVelocidade(): int{
        return $this->velocidade;
    }

    public function setVelocidade(int $velocidade): void{
        $this->velocidade = $velocidade;
    }

    public function getNivel(): int{
        return $this->nivel;
    }

    public function setNivel(int $nivel): void{
        $this->nivel = $nivel;
    }

    public function getSexo(): string{
        return $this->sexo;
    }

    public function setSexo(string $sexo): void{
        $this->sexo = $sexo;
    }

    public function getAltura(): float{
        return $this->altura;
    }

    public function setAltura(float $altura): void{
        $this->altura = $altura;
    }

    public function getPesoEmKg(): float{
        return $this->peso_em_kg;
    }

    public function setPesoEmKg(float $peso_em_kg): void{
        $this->peso_em_kg = $peso_em_kg;
    }

    public function getPesoEmLibras(): string{
        return $this->peso_em_libras;
    }

    public function setPesoEmLibras(string $peso_em_libras): void{
        $this->peso_em_libras = $peso_em_libras;
    }

    public function getDataCaptura(): DateTime{
        return $this->data_captura;
    }

    public function setDataCaptura(DateTime $data_captura): void{
        $this->data_captura = $data_captura;
    }

    public function jsonSerialize(): array{
        return [
            'pokedex' => $this->pokedex->jsonSerialize(),
            'nome' => $this->nome,
            'habilidade' => $this->habilidade->jsonSerialize(),
            'hp' => $this->hp,
            'ataque' => $this->ataque,
            'defesa' => $this->defesa,
            'sp_ataque' => $this->sp_ataque,
            'sp_defesa' => $this->sp_defesa,
            'velocidade' => $this->velocidade,
            'nivel' => $this->nivel,
            'sexo' => $this->sexo,
            'altura' => $this->altura,
            'peso_em_kg' => $this->peso_em_kg,
            'peso_em_libras' => $this->peso_em_libras,
            'data_captura' => $this->data_captura->format('Y-m-d')
        ];
    }
}

?>