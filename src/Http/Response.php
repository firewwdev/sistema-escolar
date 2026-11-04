<?php

namespace App\Http;

class Response
{

    public static function json(mixed $body, int $status = 200): void
    {

        http_response_code($status); // -> Status da resposta
        header('Content-Type: application/json; charset=utf-8'); // -> Avisa que o conteúdo retornado pro front será json
        echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); // -> Converte $body em json
        exit();

    } 

}