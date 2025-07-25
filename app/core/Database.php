<?php

require_once __DIR__ . '/../configs/database.php';

class Database
{
    private static $pdo;

   public static function connect($env = null)
    {
        if (!isset(self::$pdo))
        {
            if ($env === null) {
                $env = ($_SERVER['HTTP_HOST'] === 'localhost') ? 'dev' : 'prod';
            }

            $config = $env === 'prod'
                ? DBConfig::getProdConfig()
                : DBConfig::getDevConfig();

            try {
                self::$pdo = new PDO(
                    "mysql:host={$config->host};dbname={$config->dbname};charset=utf8",
                    $config->user,
                    $config->pass
                );
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erro ao conectar: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }

}