<?php

use App\Exceptions\ContatoNotFoundException;
use App\Exceptions\ValidationException;

set_exception_handler(function ($e) {
    header('Content-Type: application/json');

    if ($e instanceof ValidationException) {
        http_response_code($e->getStatusCode());
        echo json_encode(['mensagem' => $e->getMessage()]);
    } else if ($e instanceof ContatoNotFoundException) {
        http_response_code($e->getStatusCode());
        echo json_encode(['mensagem' => $e->getMessage()]);
    } else {
        http_response_code(500);
        echo json_encode(['mensagem' => 'Erro interno do servidor']);
    }

    exit;
});
