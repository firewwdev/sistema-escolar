<?php

namespace App\Services;

use App\Repositories\UsuarioRepositorie;

class UsuarioService
{
    
    private UsuarioRepositorie $rep;

    public function __construct(UsuarioRepositorie $rep)
    {
        $this -> rep = $rep;
    }

    public function listar(): array
    {

        return $this -> rep -> all();

    }


    public function listarPorId(int $id)
    {
        return $this -> rep -> find($id);
    }
}