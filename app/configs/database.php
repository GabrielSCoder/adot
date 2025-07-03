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
            'host'   => 'seu_host_de_producao',
            'dbname' => 'nome_prod',
            'user'   => 'usuario_prod',
            'pass'   => 'senha_prod',
        ];
    }
}