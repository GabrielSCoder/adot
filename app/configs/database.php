<?php

require __DIR__ . '/../../vendor/autoload.php';

class DBConfig
{
    public static function getDevConfig()
    {
        return (object)[
            'host'   => 'localhost',
            'dbname' => 'adot_dev',
            'user'   => 'root',
            'pass'   => '',
        ];
    }

    public static function getProdConfig()
    {
        return (object)[
            'host'   => $_ENV['DB_HOST'],
            'dbname' => $_ENV['DB_NAME'],
            'user'   => $_ENV['DB_USER'],
            'pass'   => $_ENV['DB_PASS'],
        ];
    }

}