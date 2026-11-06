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
        $this -> nome = $nome;
        $this -> matricula = $matricula;
        $this -> email = $email;
        $this -> senha = $senha;
        $this -> tipo = $tipo;
    }

}