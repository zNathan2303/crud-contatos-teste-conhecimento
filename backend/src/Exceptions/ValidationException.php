<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    private int $statusCode;

    public function __construct(string $mensagem, int $statusCode = 400)
    {
        parent::__construct($mensagem);
        $this->statusCode = $statusCode;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
