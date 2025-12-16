<?php

namespace App\Controllers;

use App\Repositories\ContatoRepository;

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
}
