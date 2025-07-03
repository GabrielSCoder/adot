<?php

class ImagemPet
{
    public $id;
    public $caminho;
    public $animal_id;

    public function __construct($params= [])
    {
        $this->id = $params['id'] ?? null;
        $this->caminho = $params['caminho'] ?? null;
        $this->animal_id = $params['animal_id'] ?? null;
    }
}