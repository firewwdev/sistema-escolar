<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv -> load();

use App\Config\Database;
use App\Repositories\UsuarioRepositorie;
use App\Services\UsuarioService;
use App\Services\MatriculaService;
use App\Controllers\UsuarioController;
use App\Validators\Validators;


$pdo = Database::connect();
$rep = new UsuarioRepositorie();
$mat = new MatriculaService;
$val = new Validators;
$ser = new UsuarioService($rep, $mat, $val);
$con = new UsuarioController($ser);

// $con -> store(
//     [s
//         'nome' => 'Gabriel',
//         'email' => 'gg5850523@gmail.com',
//         'senha' => '1234',
//         'tipo' => 'aluno'
//     ]
// );

