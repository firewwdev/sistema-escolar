<?php

namespace App\Services;

use App\Config;
use App\Config\Database;
use App\Models\Usuario;
use App\Enums\TipoUsuario;
use App\Repositories\UsuarioRepositorie;
use App\Services\MatriculaService;
use App\Validators\Validators;
use App\DTO\DTOAtualizarPerfil;

use InvalidArgumentException;
use PDO;
use RuntimeException;

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
            throw new RuntimeException('Usuário não encontrado.');
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

        $usuario_id = $this -> repository -> create(usuario: $usuario);

        return $this -> repository -> findAll(id: $usuario_id);

    }

    public function atualizarPerfil(int $id, DTOAtualizarPerfil $dadosDTO): array
    {

        $usuario = $this -> repository -> find(id: $id);

        if($usuario === false){
            throw new RuntimeException('Usuário não encontrado.');
        }

        if(!$this -> validator -> validarCamposVazios(
            dados: $dadosDTO -> toArray(),
            campos: ['nome', 'email']
        )){
            throw new InvalidArgumentException('Preencha todos os campos.');
        }

        if(!$this -> validator -> validarEmail($dadosDTO -> getEmail())){
            throw new InvalidArgumentException('E-mail inválido.');
        }
        
        $dados = $dadosDTO -> toArray();

        $this -> repository -> atualizarPerfil(id: $id, dados: $dados);

        return $this -> repository -> find(id: $id);
        
    }

    public function alterarSenha(){}


}