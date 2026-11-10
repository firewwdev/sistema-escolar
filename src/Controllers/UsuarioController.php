<?php

namespace App\Controllers;

use App\Config\Database;
use App\Http\Response;
use App\Http\Request;
use App\Services\UsuarioService;
use App\DTO\DTOAtualizarPerfil;

use InvalidArgumentException;
use PDO;
use RuntimeException;
use Throwable;

class UsuarioController
{

    private ?PDO $db;
    private UsuarioService $service;

    public function __construct(UsuarioService $service)
    {
        $this -> service = $service;
        $this -> db = Database::connect();
    }

    // Método index() -> Retorna uma lista json de todos na tabela Usuário
    // GET /usuarios
    public function index(): void
    {

        $response = $this -> service -> listar(); // -> Service

        Response::json(
            body: [
                'message' => 'Lista de usuários buscado com sucesso.',
                'data' => $response
            ],
            status: 200
        );

    }

    // Método index() -> Retorna uma lista json com os dados de um usuário
    public function show(int $id): void
    {
 
        $response = $this -> service -> listarPorId(id: $id); // -> Service

        Response::json(
            body: [
                'message' => 'Usuário buscado com sucesso.',
                'data' => $response,
            ],
            status: 200
        );

    }

    // -> Recebe os dados do front-end e inicia o fluxo de cadastro de um usuário
    public function store(mixed $body): void
    {

        $dados = $body;

        $response = $this -> service -> cadastrar(dados: $dados); // -> Service

        Response::json(
            body: [
                'message' => 'Usuário criado com sucesso.',
                'data' => $response
            ],
            status: 201
        );
        
    }

    public function atualizarPerfil(int $id, mixed $body): void
    {

        $dados = $body;

        $dadosDTO = new DTOAtualizarPerfil(
            nome: $dados['nome'],
            email: $dados['email']
        );

        $response = $this -> service -> atualizarPerfil(id: $id, dadosDTO: $dadosDTO); // -> Services
            
        Response::json(
            body: [
                'message' => 'Usuário atualizado com sucesso.',
                'data' => $response
            ],
            status: 200
        );

    }

    public function destroy(int $id)
    {

        $this -> service -> deletar($id);

        Response::noContent();

    }


}