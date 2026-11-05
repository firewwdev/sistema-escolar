<?php

namespace App\Services;

class MatriculaService
{

    public function gerarMatricula(): string
    {

        return date('Y') . random_int(100000, 999999);

    }

}
