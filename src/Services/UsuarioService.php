<?php

namespace App\Services;

use App\Models\Usuario;
use App\Enums\TipoUsuario;
use App\Repositories\UsuarioRepositorie;
use App\Services\MatriculaService;
use App\Validators\Validators;
use InvalidArgumentException;

class UsuarioService
{

    public function __construct(
        private UsuarioRepositorie $repository,
        private MatriculaService $matricula,
        private Validators $validator
    )
    {}

    public function listar(?TipoUsuario $tipo = null): array
    {
        return $this -> repository -> all(tipo: $tipo);
    }


    public function listarPorId(int $id)
    {
        return $this -> repository -> find(id: $id);
    }

    public function cadastrar(array $dados)
    {

        $nome = $dados['nome'] ?? null;
        $matricula = $this -> matricula -> gerarMatricula() ?? null;
        $email = $dados['email'] ?? null;
        $senha = $dados['senha'] ?? null;
        $tipo = $dados['tipo'] ?? null;

        if(!$this -> validator -> validarCamposVazios(
            dados: $dados,
            campos: ['nome', 'email', 'senha', 'tipo']
        )){
            throw new InvalidArgumentException('Preencha todos os campos.');
        }

        if(!$this -> validator -> validarEmail($email)){
            throw new InvalidArgumentException('E-mail inválido.');
        }
        
        $tipo = TipoUsuario::from($tipo);

        $usuario = new Usuario(
            nome: $nome,
            matricula: $matricula,
            email: $email,
            senha: $senha,
            tipo: $tipo
        );

        $this -> repository -> create(usuario: $usuario);

    }


}