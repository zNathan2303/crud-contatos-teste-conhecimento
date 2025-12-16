<?php

namespace App\Controllers;

use App\Services\ContatoService;

class ContatoController
{
    private ContatoService $contatoService;

    public function __construct(ContatoService $contatoService)
    {
        $this->contatoService = $contatoService;
    }

    public function pegarRequisicao(string $metodo, ?string $id): void
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

            case 'PUT':
                $this->atualizarContato($id);
                break;

            case 'DELETE':
                $this->excluirContatoPorId($id);
                break;

            default:
                http_response_code(405);
                echo json_encode(['erro' => 'Método não permitido']);
        }
    }

    private function listarContatos(): void
    {
        $contatos = $this->contatoService->listarContatos();
        http_response_code(200);
        echo json_encode($contatos);
        exit;
    }

    private function obterContatoPorId(string $id): void
    {
        $contato = $this->contatoService->obterContatoPorId($id);
        http_response_code(200);
        echo json_encode($contato);
        exit;
    }

    private function criarContato(): void
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $contato = $this->contatoService->criarContato($dados);
        http_response_code(201);
        echo json_encode($contato);
        exit;
    }

    private function atualizarContato(string $id): void
    {
        $dados = json_decode(file_get_contents('php://input'), true);
        $contato = $this->contatoService->atualizarContato($dados, $id);
        http_response_code(200);
        echo json_encode($contato);
        exit;
    }

    private function excluirContatoPorId(string $id): void
    {
        $this->contatoService->excluirContatoPorId($id);
        http_response_code(204);
        exit;
    }
}
