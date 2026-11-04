<?php

namespace App\Config;

use PDO;
use PDOException;
use RuntimeException;

class Database
{

    private static ?PDO $connection = null;

    public static function connect()
    {


        if(self::$connection !== null){
            return self::$connection;
        }
           
        try{

            $db_host = $_ENV['DB_HOST'];
            $db_name = $_ENV['DB_NAME'];
            $db_user = $_ENV['DB_USER'];
            $db_pass = $_ENV['DB_PASS'];

            self::$connection = new PDO(
                dsn: "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4",
                username: $db_user,
                password: $db_pass,
                options: [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );          

           //echo 'Banco conectado com sucesso.';

        }catch(PDOException $e){
            throw new RuntimeException(
                message: 'Não foi possível conectar no banco de dados.',
                previous: $e
            );
        }

    }

}