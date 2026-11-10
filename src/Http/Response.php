<?php

namespace App\Http;

class Response
{

    // Envia uma resposa json quando tiver uma requisição
    public static function json(mixed $body, int $status = 200): void
    {

        http_response_code($status); // -> Status da resposta
        header('Content-Type: application/json; charset=utf-8'); // -> Avisa que o conteúdo retornado pro front será json
        echo json_encode($body, JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR); // -> Converte $body(mixed) em json
        exit();

    } 

    // Envia uma responsa 204 (No content)
    public static function noContent(): void
    {

        http_response_code(204); 
        exit();

    }

}