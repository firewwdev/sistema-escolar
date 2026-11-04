<?php

namespace App\Controllers;

use App\Config\Database;
use App\Services\UsuarioService;
use Error;
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

    // Método index() -> Trata possíveis erro com try/catch, retorna json 
    public function index()
    {

        try{

            return $this -> service -> listar();
            
            
        }catch(Throwable $e){
            $e -> getMessage();
        }

    }

    public function show(int $id)
    {

        try{



        }catch(Throwable $e){
            $e -> getMessage();
        }

    }

}