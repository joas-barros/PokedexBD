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
        $stmt = $this->pdo->prepare(" SELECT * FROM " . self::TABLE);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $treinadores = [];
        foreach($result as $row){
            $treinadores[] = new Treinador($row['treinador_id'], $row['treinador_nome']);
        }
        return $treinadores;
    }

    public function findById(int $id): ?Treinador {
        $stmt = $this->pdo->prepare(" SELECT * FROM " . self::TABLE . " WHERE treinador_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result === false){
            return null;
        }
        return new Treinador($result['treinador_id'], $result['treinador_nome']);
    }

    public function save($treinador): void{
        $treinadorNome = $treinador->getNome();
        $stmt = $this->pdo->prepare(" INSERT INTO " . self::TABLE . " (treinador_nome) VALUES (:nome)");
        $stmt->bindParam(':nome', $treinadorNome);
        $stmt->execute();
    }

    public function update(int $id, $treinador): ?Treinador {
        $treinadorNovo = $this->findById($id);
        if($treinadorNovo === null){
            return null;
        }

        $novoNome = $treinador->getNome();

        $treinadorNovo->setNome($novoNome);
        
        $stmt = $this->pdo->prepare(" UPDATE " . self::TABLE . " SET treinador_nome = :nome WHERE treinador_id = :id");
        $stmt->bindParam(':nome', $novoNome);
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