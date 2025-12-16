<?php

namespace App\Utils;

use App\Exceptions\ValidationException;
use Exception;
use DateTime;

class Validation
{
    public static function string(
        ?string $campo,
        string $nomeDoCampo,
        int $tamanhoMaximo,
        bool $podeSerNulo = false
    ): ?string {

        if ($campo === null) {
            if ($podeSerNulo) {
                return null;
            }
            throw new ValidationException("O campo $nomeDoCampo é obrigatório");
        }

        $campo = trim($campo);

        if ($campo === '') {
            if ($podeSerNulo) {
                return null;
            }
            throw new ValidationException("$nomeDoCampo não pode ser vazio");
        }

        if (mb_strlen($campo, 'UTF-8') > $tamanhoMaximo) {
            throw new ValidationException("$nomeDoCampo deve ter no máximo $tamanhoMaximo caracteres");
        }

        return $campo;
    }

    public static function bool(?string $valor, string $nomeDoCampo): bool
    {
        $bool = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($bool === null) {
            throw new ValidationException("Campo $nomeDoCampo inválido");
        }

        return $bool;
    }

    public static function id(?string $valor): int
    {
        if ($valor === null) {
            throw new ValidationException("Id é obrigatório");
        }

        if (!is_numeric($valor)) {
            throw new ValidationException("Id deve ser um número");
        }

        $id = (int) $valor;

        if ($id <= 0) {
            throw new ValidationException("Id deve ser um número maior que zero");
        }

        return $id;
    }

    public static function data(
        ?string $valor,
        string $nomeDoCampo,
        bool $podeSerNulo = false
    ): ?DateTime {

        if ($valor === null) {
            if ($podeSerNulo) {
                return null;
            }

            throw new ValidationException("O campo $nomeDoCampo é obrigatório");
        }

        $valor = trim($valor);

        if ($valor === '') {
            throw new ValidationException("O campo $nomeDoCampo não pode ser vazio");
        }

        $data = DateTime::createFromFormat('Y-m-d', $valor);

        $erros = DateTime::getLastErrors();

        if ($data === false || $erros['warning_count'] > 0 || $erros['error_count'] > 0) {
            throw new ValidationException("O campo $nomeDoCampo deve seguir o formato ANO-MÊS-DIA");
        }

        return $data;
    }
}
