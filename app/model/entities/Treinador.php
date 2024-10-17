<?php 

class Treinador implements JsonSerializable{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private DateTime $dataNascimento;

    public function __construct(int $id, string $nome, string $email, string $senha, DateTime $dataNascimento){
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->dataNascimento = $dataNascimento;
    }

    // getters e setters
    public function getId(): int{
        return $this->id;
    }

    public function setId(int $id){
        $this->id = $id;
    }

    public function getNome(): string{
        return $this->nome;
    }

    public function setNome(string $nome): void{
        $this->nome = $nome;
    }

    // getters e setters
    public function getEmail(): string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getSenha(): string{
        return $this->senha;
    }

    public function setSenha(string $senha): void{
        $this->senha = $senha;
    }

    public function getDataNascimento(): DateTime{
        return $this->dataNascimento;
    }

    public function setDataNascimento(DateTime $dataNascimento): void{
        $this->dataNascimento = $dataNascimento;
    }

    public function jsonSerialize(): array{
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'dataNascimento' => $this->dataNascimento->format('Y-m-d')
        ];
    }
}

?>