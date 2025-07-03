<?php

class ContatoController
{
    public function index()
    {
        $title = "contato";
        $message = "Entre em contato comigo para seu pet ser cadastrado!";
        $viewPath = __DIR__ . "/../views/contatoView.php";
        require __DIR__ . "/../views/home_template.php";
    }
}