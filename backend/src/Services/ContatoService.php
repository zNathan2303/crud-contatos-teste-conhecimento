<?php

namespace App\Services;

use App\Repositories\ContatoRepository;
use App\Entities\Contato;
use App\Utils\Validation;

class ContatoService
{
    private ContatoRepository $contatoRepository;

    public function __construct(ContatoRepository $contatoRepository)
    {
        $this->contatoRepository = $contatoRepository;
    }

    public function listarContatos(): array
    {
        return $this->contatoRepository->listar();
    }

    public function obterContatoPorId(string $idString): Contato
    {
        $id = Validation::id($idString);
        return $this->contatoRepository->buscarPorId($id);
    }

    public function criarContato(array $dados): Contato
    {
        $nome = Validation::string($dados['nome'] ?? null, 'Nome', 100);
        $dataNascimento = Validation::data($dados['data_nascimento'] ?? null, 'data de nascimento');
        $email = Validation::string($dados['email'] ?? null, 'Email', 255);
        $celular = Validation::string($dados['celular'] ?? null, 'Celular', 11);
        $profissao = Validation::string($dados['profissao'] ?? null, 'Profissão', 100, true);
        $telefone = Validation::string($dados['telefone'] ?? null, 'Telefone', 10, true);
        $celularComWhatsapp = Validation::bool($dados['celular_com_whatsapp'] ?? null, 'celular com whatsapp');
        $notificacaoPorEmail = Validation::bool($dados['notificacao_por_email'] ?? null, 'notificação por email');
        $notificacaoPorSms = Validation::bool($dados['notificacao_por_sms'] ?? null, 'notificação por SMS');

        $contato = $this->contatoRepository->inserir(new Contato(
            null,
            $nome,
            $dataNascimento,
            $email,
            $celular,
            $profissao,
            $telefone,
            $celularComWhatsapp,
            $notificacaoPorEmail,
            $notificacaoPorSms
        ));

        return $contato;
    }

    public function atualizarContato(array $dados, string $idString): Contato
    {
        $id = Validation::id($idString);
        $nome = Validation::string($dados['nome'] ?? null, 'Nome', 100);
        $dataNascimento = Validation::data($dados['data_nascimento'] ?? null, 'data de nascimento');
        $email = Validation::string($dados['email'] ?? null, 'Email', 255);
        $celular = Validation::string($dados['celular'] ?? null, 'Celular', 11);
        $profissao = Validation::string($dados['profissao'] ?? null, 'Profissão', 100, true);
        $telefone = Validation::string($dados['telefone'] ?? null, 'Telefone', 10, true);
        $celularComWhatsapp = Validation::bool($dados['celular_com_whatsapp'] ?? null, 'celular com whatsapp');
        $notificacaoPorEmail = Validation::bool($dados['notificacao_por_email'] ?? null, 'notificação por email');
        $notificacaoPorSms = Validation::bool($dados['notificacao_por_sms'] ?? null, 'notificação por SMS');

        $contato = $this->contatoRepository->atualizar(new Contato(
            $id,
            $nome,
            $dataNascimento,
            $email,
            $celular,
            $profissao,
            $telefone,
            $celularComWhatsapp,
            $notificacaoPorEmail,
            $notificacaoPorSms
        ));

        return $contato;
    }

    public function excluirContatoPorId(string $idString): void
    {
        $id = Validation::id($idString);
        $this->contatoRepository->excluir($id);
    }
}
