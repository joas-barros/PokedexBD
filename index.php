<?php 
require_once 'app/controllers/resources/TipoResource.php';
// criando os endpoints

// Obter a URL requisitada
$request_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$script_name = $_SERVER['SCRIPT_NAME'];

// Remover o caminho do script
$route  = substr($request_uri, strlen($script_name));

// Remover barras no início e no final
$route = trim($route, '/');

// Separar a URL em partes
$uri_parts = explode('/', $route);

// Dividir a rota por /
$uri_parts = explode('/', $route);

// determinar o recurso e o id (se houver)
$resource = isset($uri_parts[0]) && $uri_parts[0] !== '' ? $uri_parts[0] : null;

$id = isset($uri_parts[1]) ? $uri_parts[1] : null;

// Definir o metodo HTTP
$method = $_SERVER['REQUEST_METHOD'];
$id = $_GET['id'] ?? null;

// Instanciar o controller
$controller = new TipoResource();
$controller->handleRequest($method, $id);


?>