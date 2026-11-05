<?php

namespace App\Http;
class Request
{
    public static function json(string $body): array
    {

        $body = json_decode($body, true);

        return $body;

    } 

}