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
}
