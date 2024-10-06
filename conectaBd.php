<?php 
// endereco
// nome do bd 
// usuario
// senha

// $endereco = "localhost";
// $nomebd = "pokedexbd";
// $usuario = "postgres";
// $senha = "002045";

// try{
//     $conn = new PDO("pgsql:host=$endereco;dbname=$nomebd", $usuario, $senha);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//     echo "Conectado com sucesso";
// } catch(PDOException $e){
//     echo "Erro: " . $e->getMessage();
// }

// testando o TipoResource
require_once 'app/controllers/resources/TipoResource.php';

$tipoResource = new TipoResource();
$tipoResource->findAll();

?>