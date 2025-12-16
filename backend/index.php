<?php

require_once('./autoload.php');

use App\Repositories\ContatoRepository;

$repo = new ContatoRepository();

$contatos = $repo->listar();
$contato = $repo->buscarPorId(1);

echo json_encode($contatos);
