<?php

namespace App\Exceptions;

use App\Http\Response;

use App\Exceptions\UsuarioNaoEncontradoException;
use App\Exceptions\CamposNaoPreenchidosException;
use App\Exceptions\EmailInvalidoException;

use Throwable;

class ExceptionsHandler
{

    public static function handle(Throwable $e): void
    {

        if($e instanceof UsuarioNaoEncontradoException){
            Response::json(
                body: ['error' => 'Usuário não encotrado.'],
                status: 404
            );
        }

        if($e instanceof CamposNaoPreenchidosException){
            Response::json(
                body: ['error' => 'Preencha todos os campos.'],
                status: 422
            );
        }

        if($e instanceof EmailInvalidoException){
            Response::json(
                body: ['error' => 'Email inválido.'],
                status: 422
            );
        }

        Response::json(
            body: ['error' => 'Erro interno do servidor.'],
            status: 500
        );

    }

}