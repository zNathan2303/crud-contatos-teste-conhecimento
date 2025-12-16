<?php

namespace App\Repositories;

use App\Entities\Contato;
use PDO;
use DateTime;

class ContatoRepository
{
    private function conectar(): PDO
    {
        $pdo = new PDO(
            'mysql:host=localhost;dbname=db_cadastro_contatos',
            'root',
            'bcd127'
        );
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

    public function listar(): array
    {
        $pdo = $this->conectar();
        $preparacao = $pdo->prepare("SELECT * FROM tb_contato");
        $preparacao->execute();
        $consulta = $preparacao->fetchAll(PDO::FETCH_ASSOC);

        $listar = [];
        foreach ($consulta as $linha) {
            $lista[] = new Contato(
                (int) $linha['id'],
                $linha['nome'],
                new DateTime($linha['data_nascimento']),
                $linha['email'],
                $linha['celular'],
                $linha['profissao'],
                $linha['telefone'],
                (bool) $linha['celular_com_whatsapp'],
                (bool) $linha['notificacao_por_email'],
                (bool) $linha['notificacao_por_sms']
            );
        }
        $pdo = null;
        $preparacao = null;
        return $lista;
    }

    public function buscarPorId(int $id): Contato
    {
        $pdo = $this->conectar();
        $preparacao = $pdo->prepare("SELECT * FROM tb_contato WHERE id = :id");
        $preparacao->bindParam('id', $id);
        $preparacao->execute();
        $consulta = $preparacao->fetch(PDO::FETCH_ASSOC);
        $pdo = null;
        $preparacao = null;

        return new Contato(
            (int) $consulta['id'],
            $consulta['nome'],
            new DateTime($consulta['data_nascimento']),
            $consulta['email'],
            $consulta['celular'],
            $consulta['profissao'],
            $consulta['telefone'],
            (bool) $consulta['celular_com_whatsapp'],
            (bool) $consulta['notificacao_por_email'],
            (bool) $consulta['notificacao_por_sms']
        );
    }

    public function inserir(Contato $contato): Contato
    {
        $pdo = $this->conectar();
        $preparacao = $pdo->prepare(
            "INSERT INTO tb_contato (
                nome, data_nascimento, email, profissao, telefone, celular,
                celular_com_whatsapp, notificacao_por_email, notificacao_por_sms
            ) VALUES (
                ?, ?, ?, ?, ?, ?, ?, ?, ?
            );"
        );
        $preparacao->execute([
            $contato->getNome(),
            $contato->getDataNascimento()->format('Y-m-d'),
            $contato->getEmail(),
            $contato->getProfissao(),
            $contato->getTelefone(),
            $contato->getCelular(),
            $contato->getCelularComWhatsapp() ? 1 : 0,
            $contato->getNotificacaoPorEmail() ? 1 : 0,
            $contato->getNotificacaoPorSms() ? 1 : 0
        ]);
        $contato->setId((int) $pdo->lastInsertId());

        $pdo = null;
        $preparacao = null;

        return $contato;
    }

    public function atualizar(Contato $contato): Contato
    {
        $pdo = $this->conectar();
        $preparacao = $pdo->prepare(
            "UPDATE
                tb_contato
            SET
                nome = ?, data_nascimento = ?, email = ?, profissao = ?, telefone = ?, celular = ?,
                celular_com_whatsapp = ?, notificacao_por_email = ?, notificacao_por_sms = ?
            WHERE
                id = ?"
        );
        $preparacao->execute([
            $contato->getNome(),
            $contato->getDataNascimento()->format('Y-m-d'),
            $contato->getEmail(),
            $contato->getProfissao(),
            $contato->getTelefone(),
            $contato->getCelular(),
            $contato->getCelularComWhatsapp() ? 1 : 0,
            $contato->getNotificacaoPorEmail() ? 1 : 0,
            $contato->getNotificacaoPorSms() ? 1 : 0,
            $contato->getId()
        ]);

        $pdo = null;
        $preparacao = null;

        return $contato;
    }

    public function excluir(int $id): void
    {
        $pdo = $this->conectar();
        $preparacao = $pdo->prepare("DELETE FROM tb_contato WHERE id = :id");
        $preparacao->bindParam('id', $id);
        $preparacao->execute();
        $pdo = null;
        $preparacao = null;
    }
}
