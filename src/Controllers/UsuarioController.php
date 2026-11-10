<?php

namespace App\Controllers;

use App\Config\Database;
use App\Http\Response;
use App\Http\Request;
use App\Services\UsuarioService;
use App\DTO\DTOAtualizarPerfil;

use InvalidArgumentException;
use PDO;
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

        try{

            $response = $this -> service -> listar();

            Response::json(
                body: [
                    'message' => 'Lista de usuários buscado com sucesso.',
                    'data' => $response
                ],
                status: 200
            );
            
        }catch(Throwable $e){
            $e -> getMessage();
        }

    }

    // Método index() -> Retorna uma lista json com os dados de um usuário
    public function show(int $id): void
    {

        try{
    
            $response = $this -> service -> listarPorId(id: $id);

            Response::json(
                body: [
                    'message' => 'Usuário buscado com sucesso.',
                    'data' => $response,
                ],
                status: 200
            );

        }catch(Throwable $e){

            Response::json(
                body: ['error' => 'Erro interno do servidor.'],
                status: 500
            );

        }

    }

    // -> Recebe os dados do front-end e inicia o fluxo de cadastro de um usuário
    public function store(mixed $body): void
    {

        try{

            $dados = $body;

            $this -> service -> cadastrar(dados: $dados);

            Response::json(
                body: [
                    'message' => 'Usuário criado com sucesso.',
                    'data' => ''
                ],
                status: 201
            );

        }catch(InvalidArgumentException $e){
            
            Response::json(
                body: ['error' => $e -> getMessage()],
                status: 422
            );

        }catch(Throwable $e){

            Response::json(
                body: ['error' => 'Erro interno do servidor.'],
                status: 500
            );
        }
        
    }

    public function atualizarPerfil(int $id, mixed $body): void
    {

        $dados = $body;

        $dadosDTO = new DTOAtualizarPerfil(
            nome: $dados['nome'],
            email: $dados['email']
        );

        try{

            $response = $this -> service -> atualizarPerfil(id: $id, dadosDTO: $dadosDTO);
            
            Response::json(
                body: [
                    'message' => 'Usuário atualizado com sucesso.',
                    'data' => $response
                ],
                status: 200
            );

        }catch(InvalidArgumentException $e){

            Response::json(
                body: ['error' => $e -> getMessage()],
                status: 422
            );

        }catch(Throwable $e){

            Response::json(
                body: ['error' => $e -> getMessage()],
                status: 500
            );

        }

    }


}