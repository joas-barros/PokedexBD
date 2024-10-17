<?php

require_once 'app/connection/DBConnection.php';
require_once 'app/model/entities/Treinador.php';

class TreinadorRepository implements RepositoryInterface {
    private PDO $pdo;
    public const TABLE = 'treinador';

    public function __construct(){
        $this->pdo = DBConnection::getInstance()->getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->prepare(" SELECT * FROM " . self::TABLE . " ORDER BY treinador_id ASC");
        $stmt->execute();
        $result = $stmt->fetchAll();
        $treinadores = [];
        foreach($result as $row){
            $treinadores[] = new Treinador($row['treinador_id'], $row['treinador_nome'], $row['treinador_email'], $row['treinador_senha'], new DateTime($row['treinador_data_nascimento']));
        }
        return $treinadores;
    }

    public function findById(?int $id): ?Treinador {
        
        if ($id === null){
            return null;
        }

        $stmt = $this->pdo->prepare(" SELECT * FROM " . self::TABLE . " WHERE treinador_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result === false){
            return null;
        }
        return new Treinador($result['treinador_id'], $result['treinador_nome'], $result['treinador_email'], $result['treinador_senha'], new DateTime($result['treinador_data_nascimento']));
    }

    public function save($treinador): void{
        $treinadorNome = $treinador->getNome();
        $treinadorEmail = $treinador->getEmail();
        $treinadorSenha = $treinador->getSenha();
        $treinadorDataNascimento = $treinador->getDataNascimento()->format('Y-m-d');
        $stmt = $this->pdo->prepare(" INSERT INTO " . self::TABLE . " (treinador_nome, treinador_email, treinador_senha, treinador_data_nascimento) VALUES (:nome, :email, :senha, :dataNascimento)");
        $stmt->bindParam(':nome', $treinadorNome);
        $stmt->bindParam(':email', $treinadorEmail);
        $stmt->bindParam(':senha', $treinadorSenha);
        $stmt->bindParam(':dataNascimento', $treinadorDataNascimento);
        $stmt->execute();
    }

    public function update(int $id, $treinador): ?Treinador {
        $treinadorNovo = $this->findById($id);
        if($treinadorNovo === null){
            return null;
        }

        $novoNome = $treinador->getNome();
        $novoEmail = $treinador->getEmail();
        $novaSenha = $treinador->getSenha();
        $novaDataNascimento = $treinador->getDataNascimento()->format('Y-m-d');

        $treinadorNovo->setNome($novoNome);
        $treinadorNovo->setEmail($novoEmail);
        $treinadorNovo->setSenha($novaSenha);
        $treinadorNovo->setDataNascimento(new DateTime($novaDataNascimento));
        
        $stmt = $this->pdo->prepare(" UPDATE " . self::TABLE . " 
            SET 
            treinador_nome = :nome, 
            treinador_email = :email,
            treinador_senha = :senha,
            treinador_data_nascimento = :dataNascimento
            WHERE treinador_id = :id");
        $stmt->bindParam(':nome', $novoNome);
        $stmt->bindParam(':email', $novoEmail);
        $stmt->bindParam(':senha', $novaSenha);
        $stmt->bindParam(':dataNascimento', $novaDataNascimento);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $treinadorNovo;
    }

    public function delete(int $id): void {
        $stmt = $this->pdo->prepare(" DELETE FROM " . self::TABLE . " WHERE treinador_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}

?>