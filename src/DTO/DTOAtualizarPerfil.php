<?php

namespace App\DTO;

class DTOAtualizarPerfil
{

    public function __construct(
        public readonly ?string $nome,
        public readonly ?string $email
    )
    {}

    public function toArray(): array
    {

        return [
            'nome' => $this -> nome,
            'email' => $this -> email
        ];

    }   

    public function getEmail(): string
    {
        return $this -> email;
    }

}