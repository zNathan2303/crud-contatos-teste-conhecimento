<?php

require_once('./autoload.php');

use App\Repositories\ContatoRepository;

$repo = new ContatoRepository();

$contatos = $repo->listar();
$contato = $repo->buscarPorId(1);

var_dump($contato);
