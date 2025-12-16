<?php

namespace App\Entities;

use DateTime;
use JsonSerializable;

class Contato implements JsonSerializable
{
    private int $id;
    private string $nome;
    private DateTime $dataNascimento;
    private string $email;
    private ?string $profissao;
    private ?string $telefone;
    private string $celular;
    private bool $celularComWhatsapp;
    private bool $notificacaoPorEmail;
    private bool $notificacaoPorSms;

    public function __construct(
        int $id,
        string $nome,
        DateTime $dataNascimento,
        string $email,
        string $celular,
        ?string $profissao = null,
        ?string $telefone = null,
        bool $celularComWhatsapp = false,
        bool $notificacaoPorEmail = false,
        bool $notificacaoPorSms = false
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->dataNascimento = $dataNascimento;
        $this->email = $email;
        $this->profissao = $profissao;
        $this->telefone = $telefone;
        $this->celular = $celular;
        $this->celularComWhatsapp = $celularComWhatsapp;
        $this->notificacaoPorEmail = $notificacaoPorEmail;
        $this->notificacaoPorSms = $notificacaoPorSms;
    }

    public function jsonSerialize(): mixed
    {
        return [
            $this->id,
            $this->nome,
            $this->dataNascimento,
            $this->email,
            $this->profissao,
            $this->telefone,
            $this->celular,
            $this->celularComWhatsapp,
            $this->notificacaoPorEmail,
            $this->notificacaoPorSms
        ];
    }
}
