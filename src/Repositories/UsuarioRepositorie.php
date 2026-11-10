<?php

namespace App\Repositories;

use App\Config\Database;
use App\Models\Usuario;
use App\Enums\TipoUsuario;

use PDO;

class UsuarioRepositorie
{

    private ?PDO $db;

    public function __construct()
    {
        $this -> db = Database::connect();
    }

    public function all(?TipoUsuario $tipo = null): ?array 
    {
        
        $parametro = [];

        $sql = 'SELECT * FROM usuario';

        if($tipo !== null){
            $sql .= ' WHERE tipo = :tipo';
            $parametro[':tipo'] = $tipo -> value;
        }

        $stmt = $this -> db -> prepare($sql);
        $stmt -> execute($parametro);

        return $stmt -> fetchAll() ?: null;

    }

    public function find(int $id): ?array
    {

        $sql = 'SELECT nome, email FROM usuario
            WHERE id = :id';

        $stmt = $this -> db -> prepare($sql);

        $stmt -> execute([":id" => $id]);

        return $stmt -> fetch() ?: null;

    }

    public function findAll(int $id): ?array
    {

        $sql = 'SELECT nome, email, matricula, tipo FROM usuario
            WHERE id = :id';

        $stmt = $this -> db -> prepare($sql);

        $stmt -> execute([":id" => $id]);

        return $stmt -> fetch() ?: null;

    }

    public function create(Usuario $usuario): int
    {


        $sql = 'INSERT INTO usuario(nome, matricula, email, senha, tipo)
            VALUES(:nome, :matricula, :email, :senha, :tipo)';

        $stmt = $this -> db -> prepare($sql);

        $stmt -> execute([
            ":nome" => $usuario -> nome,
            ":matricula" => $usuario -> matricula,
            ":email" => $usuario -> email,
            ":senha" => $usuario -> senha,
            ":tipo" => $usuario -> tipo -> value
        ]);

        return (int) $this -> db -> lastInsertId();

    }

    public function update(Usuario $usuario)
    {

        $sql = 'UPDATE usuario
            SET
                nome = :nome,
                matricula = :matricula,
                email = :email,
                senha = :senha,
                tipo = :tipo
            WHERE id = :id';
        
        $stmt = $this -> db -> prepare($sql);

        $stmt -> execute([
            ":id" => $usuario -> id,
            ":nome" => $usuario -> nome,
            ":matricula" => $usuario -> matricula,
            ":email" => $usuario -> email,
            ":senha" => $usuario -> senha,
            ":tipo" => $usuario -> tipo -> value
        ]);

    }

    public function atualizarPerfil(int $id, array $dados): void
    {

        $sql = 'UPDATE usuario
            SET 
                nome = :nome,
                email = :email
            WHERE id = :id';

        $stmt = $this -> db -> prepare($sql);

        $stmt -> execute([
            ":nome" => $dados['nome'],
            ":email" => $dados['email'],
            ":id" => $id
        ]);
    }

}