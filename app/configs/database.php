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
            'host'   => 'sql311.infinityfree.com',
            'dbname' => 'if0_39416642_adot_dev',
            'user'   => 'if0_39416642',
            'pass'   => 'AzHaTsOJ609',
        ];
    }
}