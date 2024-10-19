<?php

namespace Test\DatabaseAbstraction;
use Exception;
use Test\DatabaseAbstraction\DatabaseContract;
use PDO;
use PDOException;
use Dotenv\Dotenv;

class DatabaseFactory {

    public static function Create( string $type = DatabaseContract::TYPE_PDO ): DatabaseContract {

        $dbConfig = Self::GetDbConfig();

        if ( $type === DatabaseContract::TYPE_PDO ) 
            return self::CreateWithPDO( $dbConfig );
        

        if ( $type === DatabaseContract::TYPE_MySQLi ) {
            return self::CreateWithMySQLi( $dbConfig );
        }
            
        throw new Exception("Not implemented");
        
    }

    private static function CreateWithPDO( $dbConfig ): MyPDO {

        try {
            
            $pdo = new MyPDO($dbConfig);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            return  $pdo;

        } catch (PDOException $e) {

            throw new PDOException("Database connection failed: ". $e->getMessage() . PHP_EOL);
            
        }

    }

    private static function CreateWithMySQLi( $dbConfig ): MySQLi {

        try {
            
            $mysqli = new MySqli($dbConfig);

            return  $mysqli;

        } catch ( Exception $e) {

            throw new Exception("Database connection failed: ". $e->getMessage() . PHP_EOL);
            
        }

    }

    // questo metodo viene usato da chi ha bisogno delle DbConfig
    private static function GetDbConfig(): DbConfig {

        // per risolvere il problema del path dell'.env usiamo questo ma dovrebbe esserci un metodo migliore. Potremmo anche evitare il file .env e dichiarare le EV qui dentro. 
        $path = $_SERVER["DOCUMENT_ROOT"];

        $dotenv = Dotenv::createImmutable($path);
        $dotenv->load();
        $dotenv->required(["DB_HOST","DB_NAME", "DB_PORT", "DB_USER", "DB_PASS"]);

        $host = $_ENV["DB_HOST"];
        $dbname = $_ENV["DB_NAME"];
        $port = $_ENV["DB_PORT"];
        $user = $_ENV["DB_USER"];
        $pass = $_ENV["DB_PASS"];

        return new DbConfig(
            $host, 
            $dbname,
            $port,
            $user,
            $pass
        );

    }

}
