<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(dirname(__DIR__, 2));
$dotenv -> load();

use App\Config\Database;
use App\Enums\TipoUsuario;
use App\Repositories\UsuarioRepositorie;
use App\Services\UsuarioService;
use App\Controllers\UsuarioController;


$pdo = Database::connect();
$rep = new UsuarioRepositorie();
$ser = new UsuarioService($rep);
$con = new UsuarioController($ser);

echo '<br>';

$con -> show(1);

