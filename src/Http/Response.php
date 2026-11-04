<?php

namespace App\Http;

class Response
{

    public static function json(string $body, int $status = 200): void
    {

        http_response_code($status);
        echo json_encode($body, JSON_UNESCAPED_UNICODE);
        exit();

    } 

}