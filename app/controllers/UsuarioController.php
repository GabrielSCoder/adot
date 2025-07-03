<?php


class UsuarioController
{
    function index ()
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

        if (UsuarioModel::login($usuario)) 
        {
            header("Location: ?pagina=contato")/
            exit;
        } else 
        {
            $message = "Usuário e/ou senha incorretos.";
            $action = "?pagina=usuario&action=logar";
            $title = "Login";
            $viewPath = __DIR__ . "/../views/usuario/loginView.php";
            require __DIR__ . "/../views/home_template.php";
        }

    }
}