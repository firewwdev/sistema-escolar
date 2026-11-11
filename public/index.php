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
use App\Exceptions\ExceptionsHandler;


$pdo = Database::connect();
$rep = new UsuarioRepositorie();
$mat = new MatriculaService;
$val = new Validators;
$ser = new UsuarioService($pdo, $rep, $mat, $val);
$con = new UsuarioController($ser);

$uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$caminho = explode('/', trim($uri, '/'));

try{

    echo $uri . '</br></br>';
    var_dump($caminho);
    echo '</br></br>'. $caminho[0];
    echo '</br>'. $caminho[1];

    // $con -> store(
    //     [
    //         'nome' => 'Maria',
    //         'email' => 'maria5850523@gmail.com',
    //         'senha' => '4567',
    //         'tipo' => 'aluno'
    //     ]
    // );

    // $con -> atualizarPerfil(
    //     1,
    //     [
    //         "nome" => 'joãozin',
    //         "email" => 'amaaaral@gmail.com'
    //     ]
    // );

    //$con -> destroy(3);

}catch(Throwable $e){
    ExceptionsHandler::handle($e);
}