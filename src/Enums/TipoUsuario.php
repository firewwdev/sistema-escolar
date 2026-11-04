<?php

namespace App\Enums;

enum TipoUsuario: string
{

    case ALUNO = 'aluno';
    case PROFESSOR = 'professor';
    case ADMIN = 'admin';

}