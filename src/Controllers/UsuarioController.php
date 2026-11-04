<?php

namespace App\Controllers;

use App\Config\Database;
use App\Http\Response;
use App\Services\UsuarioService;
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
    public function index()
    {

        try{

            return $this -> service -> listar();
            
        }catch(Throwable $e){
            $e -> getMessage();
        }

    }

    // Método index() -> Retorna uma lista json com os dados de um usuário
    public function show(int $id): void
    {

        try{
    
            $usuario = $this -> service -> listarPorId($id);

            Response::json(
                body: [
                    'message' => 'Usuário buscado com sucesso.',
                    'data' => $usuario,
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

}