<?php


class UsuarioController
{
    function login ()
    {
        $title = "Login";
        $action = "?pagina=usuario&action=logar";
        $viewPath = __DIR__ . "/../views/Usuario/loginView.php";
        require __DIR__ . "/../views/home_template.php";
    }

    function criar () 
    {
        $user = new Usuario([
            'usuario' => 'gabriel',
            'senha' => '1999'
        ]);

        $user->criptografar();
        UsuarioModel::create($user);
    }

    function logar()
    {
        $usuario = new Usuario($_POST);

        try {
            UsuarioModel::login($usuario);
        } catch (Exception $e)
        {
            echo $e->getMessage();
        }

    }
}