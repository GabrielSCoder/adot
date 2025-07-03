<?php

session_start();

spl_autoload_register(function ($class)
{
    $folders = [
        __DIR__ . '/../app/controllers/',
        __DIR__ . '/../app/core/',
        __DIR__ . '/../app/models/',
        __DIR__ . '/../app/configs/',
    ];

    foreach ($folders as $folder)
    {
        $file = $folder . $class . '.php';
        if (file_exists($file))
        {
            require_once $file;
            return;
        }
    }
});


require_once '../app/core/core.php';

$core = new Router();

$core->start($_GET);