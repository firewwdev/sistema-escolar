<?php

namespace App\Router;

use App\Controllers\UsuarioController;
use App\Validators\Validators;
use App\Exceptions\RotaInvalidaException;

class Router
{

    public function __construct(
        private Validators $validator
    )
    {}

    // rota -> Ex: /usuarios
    // action -> Ex: [UsuarioController, 'show']
    //
    // Ex: get('/usuarios', [UsuarioController, 'index'])
    // Ex: get('/usuarios/{$id}, [UsuarioController, 'show($id)'])

    public function get(string $rota, array $action): void
    {

        if($this -> getMethod() !== 'GET'){
            return;
        }

        $uri = $this -> getUri();

        // Ex: se a URI for '/usuarios/1' devolve um array
        // {
        //   0 => "usuarios",
        //   1 => "1"
        // }
        $caminho_uri = $this -> formatarUri($uri);
        $caminho_rota = $this -> formatarUri($rota);

        if(!$this -> validator -> validarRota($caminho_uri, $caminho_rota)){
            return;
        } 

    }

    private function getMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function getUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    private function formatarUri(string $uri): array
    {
        return explode('/', trim($uri, '/'));
    }

}