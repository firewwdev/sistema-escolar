<?php

namespace App\Validators;

class Validators
{

    // Valida se os campos definidos estão vazios de acordo com os campos definidos em $campos
    public function validarCamposVazios(array $dados, array $campos): bool
    {

        $val_count = 0;

        foreach($campos as $campo){

            if(
                !array_key_exists($campo, $dados) || // -> Verifica se tem uma chave com o mesmo nome de $campo em $dadis
                $dados[$campo] === null || // -> Verifica se alguma chave selecionada, em $dados seja null
                trim((string) $dados[$campo]) === '' // Verifica se alguma chave selecionada, em $dados seja ' '
            ){
                return false;
            } 

            $val_count++;

        }

        // -> Verifica se a quantidade de $campos válidos é igual à quantidade de campos selecionados
        if($val_count === count($campos)){
            return true; 
        }else{
            return false;
        }

    }

}