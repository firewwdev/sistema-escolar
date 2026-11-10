<?php

namespace App\Services;

use App\Config;
use PDO;
use App\Config\Database;
use App\Models\Usuario;
use App\Enums\TipoUsuario;
use App\Repositories\UsuarioRepositorie;
use App\Services\MatriculaService;
use App\Validators\Validators;
use App\DTO\DTOAtualizarPerfil;

// Exceptions
use App\Exceptions\UsuarioNaoEncontradoException;
use App\Exceptions\EmailInvalidoException;
use App\Exceptions\CamposNaoPreenchidosException;

class UsuarioService
{

    public function __construct(
        private PDO $db,
        private UsuarioRepositorie $repository,
        private MatriculaService $matricula,
        private Validators $validator
    )
    {
        $this -> db = Database::connect();
    }

    public function listar(?TipoUsuario $tipo = null): array
    {
        return $this -> repository -> all(tipo: $tipo);
    }


    public function listarPorId(int $id): array
    {
    
        $usuario = $this -> repository -> find(id: $id);

        if($usuario === null){
            throw new UsuarioNaoEncontradoException();
        }

        return $usuario;
    }

    public function cadastrar(array $dados): array
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
            throw new CamposNaoPreenchidosException();
        }

        if(!$this -> validator -> validarEmail($email)){
            throw new EmailInvalidoException();
        }
        
        $tipo = TipoUsuario::from($tipo);

        $usuario = new Usuario(
            nome: $nome,
            matricula: $matricula,
            email: $email,
            senha: $senha,
            tipo: $tipo
        );

        $usuario_id = $this -> repository -> create(usuario: $usuario);

        return $this -> repository -> findAll(id: $usuario_id);

    }

    public function atualizarPerfil(int $id, DTOAtualizarPerfil $dadosDTO): array
    {

        $usuario = $this -> repository -> find(id: $id);

        if($usuario === false){
            throw new UsuarioNaoEncontradoException();
        }

        if(!$this -> validator -> validarCamposVazios(
            dados: $dadosDTO -> toArray(),
            campos: ['nome', 'email']
        )){
            throw new CamposNaoPreenchidosException();
        }

        if(!$this -> validator -> validarEmail($dadosDTO -> getEmail())){
            throw new EmailInvalidoException();
        }
        
        $dados = $dadosDTO -> toArray();

        $this -> repository -> atualizarPerfil(id: $id, dados: $dados);

        return $this -> repository -> find(id: $id);
        
    }

    public function alterarSenha(){}

    public function deletar(int $id)
    {

        $usuario = $this -> repository -> find(id: $id);

        if($usuario === null){
            throw new UsuarioNaoEncontradoException();
        }

        $this -> repository -> delete($id);

    }


}