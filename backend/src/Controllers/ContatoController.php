<?php

namespace App\Controllers;

use App\Entities\Contato;
use App\Repositories\ContatoRepository;
use DateTime;

class ContatoController
{
    public function pegarRequisicao(string $metodo, ?string $id)
    {
        switch ($metodo) {
            case 'GET':
                if ($id) {
                    $this->obterContatoPorId($id);
                } else {
                    $this->listarContatos();
                }
                break;

            case 'POST':
                $this->criarContato();
                break;
            default:
                http_response_code(405);
                echo json_encode(['erro' => 'Método não permitido']);
        }
    }

    private function listarContatos()
    {
        $repo = new ContatoRepository();
        $contatos = $repo->listar();
        http_response_code(200);
        echo json_encode($contatos);
    }

    private function obterContatoPorId(int $id)
    {
        $repo = new ContatoRepository();
        $contato = $repo->buscarPorId($id);
        http_response_code(200);
        echo json_encode($contato);
    }

    private function criarContato()
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $repo = new ContatoRepository();
        $contato = $repo->inserir(new Contato(
            null,
            $dados['nome'],
            new DateTime($dados['dataNascimento']),
            $dados['email'],
            $dados['celular'],
            $dados['profissao'] ?? null,
            $dados['telefone'] ?? null,
            $dados['celularComWhatsapp'],
            $dados['notificacaoPorEmail'],
            $dados['notificacaoPorSms']
        ));
        http_response_code(201);
        echo json_encode($contato);
    }
}
