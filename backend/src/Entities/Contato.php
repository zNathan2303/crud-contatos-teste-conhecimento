<?php

namespace App\Entities;

use DateTime;
use JsonSerializable;

class Contato implements JsonSerializable
{
    private ?int $id;
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
        ?int $id,
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
            'id' => $this->id,
            'nome' => $this->nome,
            'data_nascimento' => $this->dataNascimento instanceof DateTime
                ? $this->dataNascimento->format('Y-m-d')
                : $this->dataNascimento,
            'email' => $this->email,
            'profissao' => $this->profissao,
            'telefone' => $this->telefone,
            'celular' => $this->celular,
            'celular_com_whatsapp' => $this->celularComWhatsapp,
            'notificacao_por_email' => $this->notificacaoPorEmail,
            'notificacao_por_sms' => $this->notificacaoPorSms
        ];
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getDataNascimento(): DateTime
    {
        return $this->dataNascimento;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getProfissao(): ?string
    {
        return $this->profissao;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function getCelular(): string
    {
        return $this->celular;
    }

    public function getCelularComWhatsapp(): bool
    {
        return $this->celularComWhatsapp;
    }

    public function getNotificacaoPorEmail(): bool
    {
        return $this->notificacaoPorEmail;
    }

    public function getNotificacaoPorSms(): bool
    {
        return $this->notificacaoPorSms;
    }
}
