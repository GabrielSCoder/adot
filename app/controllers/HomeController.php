<?php

class HomeController
{
    public function index()
    {
        $title = "Home";
        $message = "Página inicial";        
        $viewPath = __DIR__ . "/../views/homeView.php";
        
        include __DIR__ . "/../views/home_template.php";
    }
}