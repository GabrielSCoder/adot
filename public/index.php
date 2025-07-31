<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../app/core/Core.php';

use Dotenv\Dotenv;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

session_start();
date_default_timezone_set("America/Fortaleza");

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$core = new Router();

$core->start($_GET);