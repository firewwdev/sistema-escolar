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

    public function show(): mixed
    {

        try{

            return $this -> service -> listar();
            
            
        }catch(Error $e){
            return $e -> getMessage();
        }

    }

}