<?php

class AdocaoController
{
    public function index()
    {
        $title = "Adoção";
        $message = "Adote um pet com responsabilidade!";
        $viewPath = __DIR__ . "/../views/homeView.php";
        
        include __DIR__ . "/../views/home_template.php";
    }
}