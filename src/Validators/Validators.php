<?php

namespace App\Validators;

class Validators
{

    public function validarCamposVazios(array $dados, array $campos)
    {

        foreach($dados as $chave => $dado){
            
            if($dado === null || $dado === ''){
                echo 'erro';
                return false;
            }

        }

    }

}

$v = new Validators;

echo $v -> validarCamposVazios(
    [
        'email' => '',
        'senha' => ''
    ],
    [
        'email',
        'senha'
    ]
);