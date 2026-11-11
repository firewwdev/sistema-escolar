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

    public function validarEmail(string $email): bool
    {

        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;

    }

    public function validarRota(array $uri_formatada, array $rota_formatada): bool
    {

        $caminho_uri = $uri_formatada;
        $caminho_rota = $rota_formatada;

        // Verifica se os arrays contém a mesma quantidade de indices
        if(count($caminho_uri) !== count($caminho_rota)){
            return false;
        }
        
        foreach($caminho_uri as $indice_uri => $valor_uri){
            
            $valor_rota = $caminho_rota[$indice_uri];

            // -> Verifica se for parâmetro, ex: {id}, irá retornar true; se for (id) retorna false.
            $temParemetro = str_starts_with($valor_rota, '{') && str_ends_with($valor_rota, '}');
          
            // -> Verifica se o valor dos indices são diferentes.
            if(!$temParemetro && $valor_rota !== $valor_uri){
                return false;
            }

        }

        return true;

    }

}