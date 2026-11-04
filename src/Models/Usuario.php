<?php

namespace App\Models;

use App\Enums\TipoUsuario;

class Usuario
{

    public int $id;
    public string $nome;
    public string $matricula;
    public string $email;
    public string $senha;
    public TipoUsuario $tipo;

    public function __construct(
        string $nome,
        string $matricula,
        string $email,
        string $senha,
        TipoUsuario $tipo
    )
    {
        $id = $this -> id;
        $nome = $this -> nome;
        $matricula = $this -> matricula;
        $email = $this -> email;
        $senha = $this -> senha;
        $tipo = $this -> tipo;
    }

}