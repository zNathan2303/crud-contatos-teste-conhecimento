<?php

require_once('./autoload.php');

use App\Repositories\ContatoRepository;

$repo = new ContatoRepository();

$contatos = $repo->listar();

print_r($contatos);
