<?php

use App\Controllers\ContatoController;
use App\Repositories\ContatoRepository;
use App\Services\ContatoService;

require_once('./autoload.php');
require_once('./exception_handler.php');

header('Content-Type: application/json; charset=UTF-8');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

$metodo = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$partes = explode('/', trim($uri, '/'));
$recurso = $partes[0] ?? null;
$id = $partes[1] ?? null;

if ($recurso === 'contatos') {
    $controller = new ContatoController(new ContatoService(new ContatoRepository()));
    $controller->pegarRequisicao($metodo, $id);
} else {
    http_response_code(404);
    echo json_encode(['erro' => 'Rota não encontrada']);
}
