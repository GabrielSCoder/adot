<?php

class AuthController 
{
    public static function logged()
    {
        return isset($_SESSION['usuario_id']);
    }

    public static function usuario()
    {
        return  $_SESSION['usuario'] ?? null;
    }

    public static function verificar()
    {
        if (!isset($_SESSION['usuario_id']))
        {
            header("Location: ?pagina=usuario");
            exit;
        }
    }

    public static function logout()
    {
        session_destroy();
        header("Location: ?pagina=home");
        exit;
    }
}