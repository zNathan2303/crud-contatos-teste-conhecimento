<?php

namespace App\Services;

use App\Repositories\ContatoRepository;
use App\Entities\Contato;
use DateTime;
use Exception;

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
        $id = $this->validarId($idString);
        return $this->contatoRepository->buscarPorId($id);
    }

    public function criarContato(array $dados): Contato
    {
        $nome = $this->validarString($dados['nome'] ?? null, 'Nome', 100);
        $dataNascimento = $this->validarData($dados['data_nascimento'] ?? null, 'data de nascimento');
        $email = $this->validarString($dados['email'] ?? null, 'Email', 255);
        $celular = $this->validarString($dados['celular'] ?? null, 'Celular', 11);
        $profissao = $this->validarString($dados['profissao'] ?? null, 'Profissão', 100, true);
        $telefone = $this->validarString($dados['telefone'] ?? null, 'Telefone', 10, true);
        $celularComWhatsapp = $this->validarBool($dados['celular_com_whatsapp'] ?? null, 'celular com whatsapp');
        $notificacaoPorEmail = $this->validarBool($dados['notificacao_por_email'] ?? null, 'notificação por email');
        $notificacaoPorSms = $this->validarBool($dados['notificacao_por_sms'] ?? null, 'notificação por SMS');

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

    private function validarString(
        ?string $campo,
        string $nomeDoCampo,
        int $tamanhoMaximo,
        bool $podeSerNulo = false
    ): ?string {

        if ($campo === null) {
            if ($podeSerNulo) {
                return null;
            }
            throw new Exception("O campo $nomeDoCampo é obrigatório");
        }

        $campo = trim($campo);

        if ($campo === '') {
            if ($podeSerNulo) {
                return null;
            }
            throw new Exception("$nomeDoCampo não pode ser vazio");
        }

        if (mb_strlen($campo, 'UTF-8') > $tamanhoMaximo) {
            throw new Exception("$nomeDoCampo deve ter no máximo $tamanhoMaximo caracteres");
        }

        return $campo;
    }

    private function validarBool(?string $valor, string $nomeDoCampo): bool
    {
        $bool = filter_var($valor, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if ($bool === null) {
            throw new Exception("Campo $nomeDoCampo inválido");
        }

        return $bool;
    }

    private function validarId(?string $valor): int
    {
        if ($valor === null) {
            throw new Exception("Id é obrigatório");
        }

        if (!is_numeric($valor)) {
            throw new Exception("Id deve ser um número");
        }

        $id = (int) $valor;

        if ($id <= 0) {
            throw new Exception("Id deve ser um número maior que zero");
        }

        return $id;
    }

    private function validarData(
        ?string $valor,
        string $nomeDoCampo,
        bool $podeSerNulo = false
    ): ?DateTime {

        if ($valor === null) {
            if ($podeSerNulo) {
                return null;
            }

            throw new Exception("O campo $nomeDoCampo é obrigatório");
        }

        $valor = trim($valor);

        if ($valor === '') {
            throw new Exception("O campo $nomeDoCampo não pode ser vazio");
        }

        $data = DateTime::createFromFormat('Y-m-d', $valor);

        $erros = DateTime::getLastErrors();

        if ($data === false || $erros['warning_count'] > 0 || $erros['error_count'] > 0) {
            throw new Exception("O campo $nomeDoCampo deve seguir o formato ANO-MÊS-DIA");
        }

        return $data;
    }
}
