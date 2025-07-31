<?php


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
            'host'   => getenv('host'),
            'dbname' => getenv('dbname'),
            'user'   => getenv('user'),
            'pass'   => getenv('pass'),
        ];
    }

}