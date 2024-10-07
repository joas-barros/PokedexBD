<?php 
final class DBConnection {
    private static $instance;
    private $conn;
    private $endereco = "localhost";
    private $nomebd = "pokedexbd";
    private $usuario = "postgres";
    private $senha = "002045";
    
    private function __construct(){
        try{
            $this->conn = new PDO("pgsql:host=$this->endereco;dbname=$this->nomebd", $this->usuario, $this->senha);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "Erro: " . $e->getMessage();
        }
    }
    
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }
    
    public function getConnection(){
        return $this->conn;
    }
}
?>