<?php 
header("Content-Type: application/json; charset=UTF-8");

require_once 'app/controllers/resources/TipoResource.php';
require_once 'app/controllers/resources/EfeitoResource.php';
require_once 'app/controllers/resources/HabilidadeResource.php';
require_once 'app/controllers/resources/PokedexResource.php';
require_once 'app/controllers/resources/PokemonResource.php';
require_once 'app/controllers/resources/TreinadorResource.php';
require_once 'app/controllers/resources/RegistroPokedexResource.php';
require_once 'app/controllers/resources/EvolucaoResource.php';
require_once 'app/controllers/resources/FraquezaResource.php';
require_once 'app/controllers/resources/view/CapturadosResource.php';
require_once 'app/util/PDF.php';
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

// switch ($resource) {
//     case 'tipos':
//         $controller = new TipoResource();
//         $controller->handleRequest($method, $id);
//         break;
//     default:
//         http_response_code(404);
//         echo json_encode([
//             'status' => 'error',
//             'message' => 'Recurso não encontrado'
//         ]);
//         break;
// }

// Instanciar o controller
  $controller = new CapturadosResource();
  $controller->handleRequest($method, $id);

//PDF::generateAdmLogPDF();


?>