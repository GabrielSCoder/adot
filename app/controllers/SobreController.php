<?php

class SobreController
{
    public function index()
    {
        $title    = "Sobre";
        $message  = "Sou um programador que gosta de proscrastinar";
        $viewPath = __DIR__ . "/../views/sobreView.php";
        require __DIR__ . "/../views/home_template.php";
    }
}